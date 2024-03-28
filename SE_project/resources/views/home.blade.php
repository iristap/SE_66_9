@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-2">
                <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('Dashboard') }}</div>

                <div class="card-body" style=" font-size: 18px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <p>welcome to the home page คุณ {{ Auth::user()->name }}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
