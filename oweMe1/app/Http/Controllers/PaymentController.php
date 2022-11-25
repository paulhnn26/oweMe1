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
        $users= DB::table('users')->whereNot('id','=', $user->id)->get();
        return view('paymentlist', compact('data', 'debtdata','users'));
    }
    // public function addPayment() {
    //     $currentUser = Auth::user();
    //     $users=DB::table('users')->whereNot('id','=', $currentUser->id)->get();
    //     return view('addpayment', compact('users'));
    // }
    public function savePayment(Request $request){
        $user = Auth::user();
        $request -> validate([
            'amount' => 'required',
            'debtorName' => 'required',
            'message' => 'required'
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
        $pay -> userName = $user -> name;
        $pay-> save();
        return redirect() -> route('showpaymentlist')-> with ('success', 'Rechnung erstellt');
    }
    public function editPayment($id){
        $user = Auth::user();
        $users= DB::table('users')->whereNot('id','=', $user->id)->whereNot('id','=', $id)->get();
        $data= Payment::where('id', '=', $id)-> first();
        return view('editpayment', compact('data', 'users'));
    }
    public function updatePayment(Request $request){
        
        $request -> validate([
            'amount' => 'required',
            'debtorName' => 'required',
            'message' => 'required'
        ]);
        $id = $request-> id;
        $amount = $request-> amount;
        $message = $request-> message;
        $debtorName = $request -> debtorName;
        Payment::where('id', '=', $id)->update([
            'amount' => $amount,
            'message' => $message,
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
            <td> '.$searchOutput->created_at.'</td>
            <td> '.$searchOutput->debtorName.'</td>
            <td> '.$searchOutput->message.'</td>
            <td> '.$searchOutput->amount.' €'. ' </td>
            <td> '.' <a class="btn btn-primary" href="/editpayment/'.$searchOutput->id.'">Bearbeiten</a>
            <a class="btn btn-danger" href="/deletepayment/'.$searchOutput->id.'"> Löschen</a>
             '.'
            </td>
            </tr> ';
           
        };
        return response($output);
    }
}
