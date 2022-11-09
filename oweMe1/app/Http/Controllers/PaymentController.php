<?php

namespace App\Http\Controllers;
use App\Models\Payment;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $data = Payment::get();
        return view('paymentlist', compact('data'));
    }
    public function addPayment() {
        return view('addpayment');
    }
    public function savePayment(Request $request){
        $request -> validate([
            'amount' => 'required'
        ]);
        $amount = $request-> amount;
        $message = $request-> message;
        $debtorID = $request-> debtorID;
        $pay = new Payment();
        $pay -> amount = $amount;
        $pay -> message = $message;
        $pay -> debtorID = $debtorID;
        $pay-> save();
        return redirect() -> route('/')-> with ('success', 'Rechnung erstellt');
    }
    public function editPayment($id){
        $data= Payment::where('id', '=', $id)-> first();
        return view('editpayment', compact('data'));
    }
    public function updatePayment(Request $request){
        $request -> validate([
            'amount' => 'required'
        ]);
        $id = $request-> id;
        $amount = $request-> amount;
        $message = $request-> message;
        $debtorID = $request-> debtorID;
        Payment::where('id', '=', $id)->update([
            'amount' => $amount,
            'message' => $message,
            'debtorID' => $debtorID
        ]);
        return redirect() -> route('showpaymentlist')-> with ('success', 'Rechnung verändert');
    }
    public function deletePayment($id){
        Payment::where('id', '=', $id)->delete();
        return redirect() -> route('showpaymentlist')-> with ('success', 'Rechnung gelöscht');
    }
}
