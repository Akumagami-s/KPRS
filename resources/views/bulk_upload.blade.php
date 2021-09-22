@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <form action="{{ route('store_bulk') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile" name="file">
            </div>

            <center><button type="submit" class="btn btn-success">Submit !</button></center>
        </form>
    </div>
@endsection
