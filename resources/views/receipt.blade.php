@extends('homeassets')
@section('content')
<div class="container">
    <div class="m-3">
        <label for="formFile" class="form-label mt-2">Uplaod Payment Receipt (.jpeg)</label>
        <input class="form-control" type="file" id="formFile" name="receipt">
        <button type="submit" class="btn btn-success my-3">Submit</button>
      </div>
</div>
@endsection