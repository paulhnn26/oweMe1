<?php

namespace App\Http\Controllers;
use App\Models\Bill;

use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bill::all();
        return view ('bills.index') -> with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('bills.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'message' => 'required',
            'payed' => 'required',
            'userID' => 'required',
            'debtorID' => 'required',
        ]);
        Bill::create($request->post());
        return redirect()->route('bills.index')->with('success', 'rechnung erstellt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bill  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $data)
    {
        return view('bills.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $data)
    {
        return view('bills.edit' , compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $data, $id)
    {
        $request->validate([
            'amount' => 'required',
            'message' => 'required',
            'payed' => 'required',
            'userID' => 'required',
            'debtorID' => 'required',
            
            
        ]);
        $data-> fill($request->post())->save();
        return redirect()->route('bills.index')->with('success', 'rechnung erstellt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $data)
    {
        $data->delete();
        return redirect()-> route('bills.index')->with('success', 'gelöscht');
    }
}
