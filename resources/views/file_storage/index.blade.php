@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('store-file') }}" class="btn btn-primary">Загрузить файл</a>
        <br>
        <br>
        @foreach($files as $file)
        <div class="list-group" >
            <span class="list-group-item list-group-item-action">
                Файл № {{ $file->id }}
                <img src=" {{ asset('/files/' . $file->file) }}" alt="{{ $file->id }}" title="{{ $file->id }}" style="float: right"  width="140">
            </span>
            <br>
            <a href="{{ route('download_file', $file->id) }}" class="btn btn-primary">Скачать файл</a>
            <br>
            <a href="{{ route('delete_file', $file->id) }}" class="btn btn-primary">Удалить файл</a>
            <br>
        </div>
        @endforeach
    </div>
@endsection
