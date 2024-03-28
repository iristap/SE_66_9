@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <!-- <div class="row"> -->
                <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('Show User') }}</div>
                    <div class="card-body">
                        <div class="col-lg-12 margin-tb">
                            <!-- <div class="pull-left">
                                <h2> Show User</h2>
                            </div> -->
                            <div class="pull-right">
                                <a class="btn btn-secondary" href="{{ route('users.index') }}"> Back</a>
                            </div>
                            <br>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $user->name }} {{ $user->surname }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Roles:</strong>
                                @foreach($user->roles as $role)
                                        <li>{{ $role->name }}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>

@endsection