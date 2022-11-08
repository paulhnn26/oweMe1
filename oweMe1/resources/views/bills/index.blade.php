<x-app-layout>
    <h1> Test </h1>
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('bills.create') }}"> Create New Product</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Betrag</th>
                <th>Wer soll bezahlen</th>
                <th>Wurde bezahlt</th>
                <th>Wer will Geld</th>
                <th width="280px">Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $bill)
                <tr>
                    <td>{{ $bill->amount }}</td>
                    <td>{{ $bill->debtorID }}</td>
                    <td>{{ $bill->payed }}</td>
                    <td>{{ $bill->userID }}</td>
                    <td>{{ $bill->message }}</td>
                    <td>
                        <form action="{{ route('bills.destroy', $bill->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('bills.edit', $bill->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                  
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>