<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use App\Models\Payment as PaymentModel;
use Illuminate\Http\Request;

class CreditController extends Controller
{

    public function verification(Request $request)
    {
        try {
            $transactionId = cache('credit-id-' . auth()->id());
            $amount = $request->amount == cache('credit-' . auth()->id()) ? $request->amount : 0;

            $isCompany = !!$request->company;

            $receipt = Payment::amount($amount)
                ->transactionId($transactionId)
                ->verify();

            PaymentModel::create([
                'user_id' => auth()->id(),
                'amount' => $amount,
                'status' => 'success',
                'company' => $isCompany,
                'factor' => $receipt->getReferenceId(),
            ]);

            if ($isCompany)
                auth()->user()->company->update([
                    'credit' => auth()->user()->company->credit + $amount,
                ]);
            else
                auth()->user()->update([
                    'credit' => auth()->user()->credit + $amount,
                ]);

            $message = 'اعتبار شما به مقدار ' . $amount . ' تومان افزایش یافت ';

            return inertia('User/Response', compact('message', 'isCompany'));
        } catch (\Exception $exception) {
            if ($exception->getCode() != 101)
                PaymentModel::create([
                    'user_id' => auth()->id(),
                    'amount' => $amount,
                    'status' => 'failed',
                    'factor' => 0,
                ]);

            return inertia('User/Response', ['message' => $exception->getMessage(), 'isCompany' => $request->company]);
        }
    }

    public function pay(Request $request)
    {
        cache(['credit-' . auth()->id() => $request->credit]);

        $invoice = new Invoice();
        $invoice->amount($request->credit);
        // $invoice->merchantId('07f37ae3-4e8f-4671-88cb-2f380ca4ad79');
        $invoice->detail(['detailName' => 'افزایش اعتبار']);

        $callback = url('/credit/verification?amount=' . $request->credit . '&company=' . (int) $request->isCompany);

        return Payment::callbackUrl($callback)
            ->purchase($invoice, function ($driver, $transactionId) {
                cache()->set('credit-id-' . auth()->id(), $transactionId);
            })
            ->pay()
            ->toJson();
    }
}
