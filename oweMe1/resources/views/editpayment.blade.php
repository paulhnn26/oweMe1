<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert"> {{Session::get('success')}}</div>
                @endif
                <h2>Rechnung bearbeiten</h2>
                <form method="POST" action="{{url('updatepayment')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="md-3">
                        <label class="form-label" > amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Betrag eingeben" value="{{$data->amount}}">
                        @error('amount')
                        <div class="alert alert-danger"> {{$message}}</div>
                        @enderror

                    </div>
                    <div class="md-3">
                        <label class="form-label" > message</label>
                        <input type="text" class="form-control" name="message" placeholder="Nachricht" value="{{$data->message}}">

                    </div>
                    <div class="md-3">
                        <label class="form-label" > debtorID</label>
                        <input type="text" class="form-control" name="debtorID" placeholder="Wer soll zahlen" value="{{$data->debtorID}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Updaten</button>
                    <a href="{{url('paymentlist')}}" class="btn btn-danger"> Back</a>
                </form>
</x-app-layout>