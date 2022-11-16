<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h2 m-2 p-2">Paymentliste</h2>
                @if(Session::has('success'))
                <div class="alert"> {{Session::get('success')}}</div>
                @endif
                <div class="container">
                    <div class="search"> 
                        <input type="search" name="search" id="search" placeholder="Suche" class="form-control">
                    </div>
                </div>
                <div>
                    <a class="btn btn-primary m-2 p-2" href="{{url('addpayment')}}">Neue Rechnung</a>
                </div>
                	<table class="table table-striped table-dark"> 
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
                        <tbody id="Content">
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
        <table class="table table-striped table-dark"> 
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
    <script type="text/javascript">
    $('#search').on('keyup', function(){

        $value =$(this).val();
        $.ajax({
            type:'get',
            url: '{{URL::to('search')}}', 
            data:{'search':$value},
            success:function(data){
                console.log(data);
                $('#Content').html(data);
            }
        });
    })
    </script>

</x-app-layout>