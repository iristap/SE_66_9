@extends('layouts.app')

@section('content')
<!-- <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Create New User</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
<div class="row justify-content-center">
    <div class="col-md-6">
    
        <div class="card">
            <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('Create New User') }}</div>
                    <!-- <div class="pull-left">
                        <h2>Create New User</h2>
                    </div> -->
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-secondary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                    <br>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name">
                        </div>
                        <div>
                            <label for="surname">Surname:</label>
                            <input type="text" name="surname" class="form-control" placeholder="Enter surname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="roles">Roles:</label><br>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}">
                                    <label class="form-check-label" for="role{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
