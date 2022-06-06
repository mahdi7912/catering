<?php

namespace App\Http\Controllers;

use App\Models\FoodDate;
use App\Http\Requests\StoreFoodDateRequest;
use App\Http\Requests\UpdateFoodDateRequest;

class FoodDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFoodDateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodDateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FoodDate  $foodDate
     * @return \Illuminate\Http\Response
     */
    public function show(FoodDate $foodDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FoodDate  $foodDate
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodDate $foodDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFoodDateRequest  $request
     * @param  \App\Models\FoodDate  $foodDate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFoodDateRequest $request, FoodDate $foodDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodDate  $foodDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodDate $foodDate)
    {
        //
    }
}
