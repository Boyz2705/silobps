@extends('homeassets')
@section('content')
<div class="container-fluid">
    <div class="row p-5">
        <div class="col d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/qr.png') }}" class="" style="width:400px" alt="qr">
            {{-- <img src="{{ asset('storage/image/5uwNkMZU37R9jwooCJIn5A76MXc6OXaWNEYlS1Id.png') }}" alt="tes"> --}}
            {{-- <img src="{{ asset('storage/image/8PNZN5kIh4evZ8THHLidcBl5Sj7wL6kdl8QZQSAo.png') }}" alt="tes"> --}}
        </div>
        <div class="col p-5">
            <div class="mb-3">
                @foreach($apps->where('id', $id) as $app)
                <h1>Scan QR Code for Payment</h1>
                <div class="row">
                    <div class="col-lg-6 my-4 p-3 border border-secondary" style="border-radius: 20px">
                        <p>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $app->id }}</p>
                        <p>Service&nbsp;&nbsp;&nbsp;&nbsp;: {{ $app->service['services_name'] }}</p>
                        <p>Amount&nbsp;&nbsp;: ${{ $app->bill }}</p>
                    </div>
                </div>
                <form action="/receipt/{{ $app->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <label for="formFile" class="form-label">Upload Receipt</label>
                    <input class="form-control" type="file" name="image" id="formFile" required>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
                @endforeach
              </div>    
        </div>
    </div>
</div>
@endsection