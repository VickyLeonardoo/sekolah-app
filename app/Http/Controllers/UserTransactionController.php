<?php

namespace App\Http\Controllers;

use App\Models\UserTransaction;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front.transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTransaction $userTransaction)
    {
        //
    }
}
