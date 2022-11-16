<?php

namespace App\Http\Controllers;
use App\Models\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(){
        $user = Auth::user();
        $data = Payment::where('UserID', '=', $user->id)->get();
        $debtdata = Payment::where('debtorName', '=', $user->name)->get();
        return view('paymentlist', compact('data', 'debtdata'));
    }
    public function addPayment() {
        $users= DB::table('users')->get();
        return view('addpayment', compact('users'));
    }
    public function savePayment(Request $request){
        $user = Auth::user();
        $request -> validate([
            'amount' => 'required'
        ]);
        $amount = $request-> amount;
        $message = $request-> message;
        $UserID = $user->id ;
        $debtorName = $request -> debtorName;
        $pay = new Payment();
        $pay -> amount = $amount;
        $pay -> message = $message;
        $pay -> debtorID = DB::table('users')-> where('name','=', $debtorName)->value('id');
        $pay -> UserID = $UserID;
        $pay -> debtorName = $debtorName;
        $pay-> save();
        return redirect() -> route('showpaymentlist')-> with ('success', 'Rechnung erstellt');
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
        $debtorName = $request -> debtorName;
        Payment::where('id', '=', $id)->update([
            'amount' => $amount,
            'message' => $message,
            'debtorID' => $debtorID,
            'debtorName' => $debtorName,
            
        ]);
        return redirect() -> route('showpaymentlist')-> with ('success', 'Rechnung verändert');
    }
    public function deletePayment($id){
        Payment::where('id', '=', $id)->delete();
        return redirect() -> route('showpaymentlist')-> with ('success', 'Rechnung gelöscht');
    }
    public function search(Request $request){
        $user = Auth::user();
        $output='';
        $searchOutput=Payment::where('debtorName','Like','%'.$request -> search.'%')->where('UserID', '=', $user->id)->get();
        foreach($searchOutput as $searchOutput){
            $output.= 
           '<tr>
            <td> '.$searchOutput->id.'</td>
            <td> '.$searchOutput->UserID.'</td>
            <td> '.$searchOutput->debtorID.'</td>
            <td> '.$searchOutput->debtorName.'</td>
            <td> '.$searchOutput->message.'</td>
            <td> '.$searchOutput->amount. ' </td>
            <td> '.' <a class="btn btn-primary" href="/editpayment/'.$searchOutput->id.'">Edit</a>
            <a class="btn btn-danger" href="/deletepayment/'.$searchOutput->id.'"> Delete</a>
             '.'
            </td>
            </tr> ';
           
        };
        return response($output);
    }
}
