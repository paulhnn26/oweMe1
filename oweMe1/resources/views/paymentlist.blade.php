<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h2 m-2 p-2">Paymentliste</h2>
                @if(Session::has('success'))
                <div class="alert"> {{Session::get('success')}}</div>
                @endif
                <div>
                    <a class="btn btn-primary m-2 p-2" href="{{url('addpayment')}}">Neue Rechnung</a>
                </div>
                	<table class="table"> 
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>user </th>
                                <th>debtor </th>
                                <th>debtorName </th>
                                <th>message </th>
                                <th>amount </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->UserID}}</td>
                                <td>{{$payment->debtorID}}</td>
                                <td>{{$payment->debtorName}}</td>
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
    <div class="container pt-2 mt-4">
        <h2 class="h2 m-2 p-2">Deine Schulden</h2>
        <div class="row">
        <div class="col-md-12">
        <table class="table"> 
            <thead>
                <tr>
                    <th>ID </th>
                    <th>user </th>
                    <th>debtor </th>
                    <th>debtorName </th>
                    <th>message </th>
                    <th>amount </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($debtdata as $payment)
                <tr>
                    <td>{{$payment->id}}</td>
                    <td>{{$payment->UserID}}</td>
                    <td>{{$payment->debtorID}}</td>
                    <td>{{$payment->debtorName}}</td>
                    <td>{{$payment->message}}</td>
                    <td>{{$payment->amount}} €</td>
                    <td>
                        <a class="btn btn-danger" href="{{url('deletepayment/'.$payment->id)}}"> Ich habe bezahlt</a>
                       </td>
                </tr>
                @endforeach
            </tbody>

        </table>
</div>
        </div>
    </div>

</x-app-layout>