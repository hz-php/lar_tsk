@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{{ route('worker_store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="first_name"  placeholder="Введите имя работника..." required>
        </div>
        <div class="form-group">
            <label for="last_name">Фамилия работника</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Введите фамилию работника..." required>
        </div>
        <div class="form-group">
            <label for="company">Компания</label>
            <input type="text" class="form-control" id="company" name="company"  placeholder="Компания..." required>
        </div>
        <div class="form-group">
            <label for="role">Специальность</label>
            <input type="text" class="form-control" id="role" name="role" placeholder="Введите специальность..." required>
        </div>
        <div class="form-group">
            <label for="number">Номер паспорта</label>
            <input type="number" class="form-control" id="number" name="number"  placeholder="Номер паспорта..." required>
        </div>
        <div class="form-group">
            <label for="series">Серия паспорта</label>
            <input type="number" class="form-control" id="series" name="series" placeholder="Серия паспорта..." required>
        </div>
        <div class="form-group">
            <label for="birthday">Дата рождения</label>
            <input type="date" class="form-control" id="birthday" name="birthday" required>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
    </div>
@endsection
