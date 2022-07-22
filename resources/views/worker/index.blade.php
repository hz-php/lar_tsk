@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($workers as $worker)
                        @if(empty($worker['first_name']))
                            @continue
                        @endif
                        <div class="card-header">Работник</div>
                        <div class="card-body">
                           <h4 class="card-title">{{ $worker['first_name'] }}</h4>
                           <h4 class="card-title">{{ $worker['last_name'] }}</h4>
                           <h4 class="card-title">{{ $worker['role'] }}</h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
