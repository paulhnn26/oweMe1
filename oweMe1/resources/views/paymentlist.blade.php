<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Paymentliste</h2>
                @if(Session::has('success'))
                <div class="alert"> {{Session::get('success')}}</div>
                @endif
                <div>
                    <a href="{{url('addpayment')}}">Neue Rechnung</a>
                </div>
                	<table class="table"> 
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>user </th>
                                <th>debtor </th>
                                <th>message </th>
                                <th>amount </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->userID}}</td>
                                <td>{{$payment->debtorID}}</td>
                                <td>{{$payment->message}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{url('editpayment/'.$payment->id)}}">Edit</a>
                                    <a class="btn btn-danger" href="{{url('deletepayment/'.$payment->id)}}"> Delete</a>
                                   </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
            </div>
        </div>
    </div>

</x-app-layout>