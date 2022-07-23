@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('search') }}" method="get">
                    <div class="form-group">
                        <input
                            type="text"
                            name="q"
                            class="form-control"
                            placeholder="Search..."
                            value="{{ request('q') }}"
                        />
                    </div>
                </form>
                @foreach ($workers as $worker)
                    <article class="mb-3">
                        <hr>
                        <h4>{{ $worker['first_name']}}</h4>
                        <h4>{{ $worker['last_name'] }}</h4>
                        <div>
                            <h4>{{ $worker['role']}}</h4>
                        </div>
                        <hr>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
