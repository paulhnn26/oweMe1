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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                @if(Session::has('success'))
                                <div class="alert"> {{Session::get('success')}}</div>
                                @endif
                                <h2 class="h2">Neue Rechnung</h2>
                                <form method="POST" action="{{url('savepayment')}}" class="form-control">
                                    @csrf
                                    <div class="md-3">
                                        <label class="form-label" > amount</label>
                                        <input type="text" class="form-control" name="amount" placeholder="Betrag eingeben">
                                        @error('amount')
                                        <div class="alert alert-danger"> {{$message}}</div>
                                        @enderror
                
                                    </div>
                                    <div class="md-3">
                                        <label class="form-label">debtorName</label>
                                        <select name="debtorName" >
                                            @foreach($users as $user)
                                            <option value="{{$user->name}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control" name="debtorName" placeholder="Wer soll zahlen Name"> --}}
                                    </div>
                                    <div class="md-3">
                                        <label class="form-label" > message</label>
                                        <input type="text" class="form-control" name="message" placeholder="Nachricht">
                
                                    </div>
                                    <button type="submit" class="btn btn-primary"> Erstellen</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary m-2 p-2" href="{{url('addpayment')}}">Neue Rechnung</a>
                </div>
                	<table class="table table-striped table-dark"> 
                        <thead>
                            <tr>   
                                <th>Erstellt</th>                           
                                <th>debtorName </th>
                                <th>message </th>
                                <th>amount </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="Content">
                            @foreach($data as $payment)
                            <tr>
                                <td>{{$payment->created_at}}</td>
                                <td>{{$payment->debtorName}}</td>
                                <td>{{$payment->message}}</td>
                                <td>{{$payment->amount}} €</td>                              
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
                    <th>Erstellt </th>
                    <th>Du schuldest </th>
                    <th>message </th>
                    <th>amount </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($debtdata as $payment)
                <tr>
                    <td>{{$payment->created_at}}</td>
                    <td>{{$payment->userName}}</td>
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