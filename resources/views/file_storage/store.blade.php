@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('create_file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" id="file" name="file">
            <br>
            <br>
            <button class="btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
