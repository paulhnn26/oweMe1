<x-app-layout>
    <div class="container mt-2">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('bills.index') }}" enctype="multipart/form-data">
            Back</a>
    </div>
</div>
<div class="container mt-2">
<form action="{{ url('bills/update' .$data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>message</strong>
                <input type="text" name="meessage" value="{{ $data->message }}" class="form-control"
                    placeholder="message">
                @error('message')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company Email:</strong>
                <input type="text" name="email" class="form-control" placeholder="Company Email"
                    value="{{ $data->amount }}">
                @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
    </form>
</div>
</div>

</x-app-layout>