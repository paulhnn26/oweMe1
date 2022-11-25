<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert"> {{Session::get('success')}}</div>
                @endif
                <h2 class="h2">Rechnung bearbeiten</h2>
                <form method="POST" action="{{url('updatepayment')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="md-3">
                        <label class="form-label">Betrag</label>
                        <input type="text" class="form-control" name="amount" placeholder="Betrag eingeben" value="{{$data->amount}}">
                        @error('amount')
                        <div class="alert alert-danger"> {{$message}}</div>
                        @enderror

                    </div>
                    <div class="md-3">
                        <label class="form-label" >Wer schuldet dir Geld</label>
                        {{-- <input type="text" class="form-control" name="debtorName" placeholder="Name" value="{{$data->debtorName}}"> --}}
                        <select name="debtorName">
                            <option selected hidden value="{{$data->debtorName}}">{{$data->debtorName}}</option>
                            @foreach($users as $user)
                            <option value="{{$user->name}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('debtorName')
                        <div class="alert alert-danger"> {{$message}}</div>
                        @enderror

                    </div>
                    <div class="md-3">
                        <label class="form-label" >Nachricht</label>
                        <input type="text" class="form-control" name="message" placeholder="Nachricht" value="{{$data->message}}">
                        @error('message')
                        <div class="alert alert-danger"> {{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Updaten</button>
                    <a href="{{url('paymentlist')}}" class="btn btn-danger"> Back</a>
                </form>      
            </div>
        </div>
    </div>
</x-app-layout>