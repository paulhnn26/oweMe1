<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert"> {{Session::get('success')}}</div>
                @endif
                <h2 class="h2">Neue Rechnung</h2>
                <form method="POST" action="{{url('savepayment')}}">
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
                        <input type="text" class="form-control" name="debtorName" placeholder="Wer soll zahlen Name">
                    </div>
                    <div class="md-3">
                        <label class="form-label" > message</label>
                        <input type="text" class="form-control" name="message" placeholder="Nachricht">

                    </div>
                    <div class="md-3">
                        <label class="form-label" > debtorID</label>
                        <input type="text" class="form-control" name="debtorID" placeholder="Wer soll zahlen">
                    </div>
                    <button type="submit" class="btn btn-primary"> Erstellen</button>
                    <a href="{{url('paymentlist')}}" class="btn btn-danger"> Back</a>
                </form>
</x-app-layout>