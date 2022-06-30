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

            $receipt = Payment::amount($amount)
                ->transactionId($transactionId)
                ->verify();

            PaymentModel::create([
                'user_id' => auth()->id(),
                'amount' => $amount,
                'status' => 'success',
                'factor' => $receipt->getReferenceId(),
            ]);

            auth()->user()->update([
                'credit' => auth()->user()->credit + $amount,
            ]);

            $message = 'اعتبار شما به مقدار ' . $amount . ' تومان افزایش یافت ';

            return inertia('User/Response', compact('message'));
        } catch (\Exception $exception) {
            if ($exception->getCode() != 101)
                PaymentModel::create([
                    'user_id' => auth()->id(),
                    'amount' => $amount,
                    'status' => 'failed',
                    'factor' => 0,
                ]);

            return inertia('User/Response', ['message' => $exception->getMessage()]);
        }
    }

    public function pay(Request $request)
    {
        cache(['credit-' . auth()->id() => $request->credit]);

        $invoice = new Invoice();
        $invoice->amount($request->credit);
        // $invoice->merchantId('07f37ae3-4e8f-4671-88cb-2f380ca4ad79');
        $invoice->detail(['detailName' => 'افزایش اعتبار']);

        $callback = url('/credit/verification?amount=' . $request->credit);

        return Payment::callbackUrl($callback)
            ->purchase($invoice, function ($driver, $transactionId) {
                cache()->set('credit-id-' . auth()->id(), $transactionId);
            })
            ->pay()
            ->toJson();
    }
}
