@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('Edit New User') }}</div>
<!-- <div class="row"> -->
        <div class="card-body">
            <div class="col-lg-12 margin-tb">
                <!-- <div class="pull-left">
                    <h2>Edit New User</h2>
                </div> -->
                <div class="pull-right">
                    <a class="btn btn-secondary" href="{{ route('users.index') }}"> Back</a>
                </div>
                <br>
            </div>
        

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ชื่อ:</strong>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="surname">นามสกุล:</label>
                            <input type="text" name="surname" value="{{ $user->surname }}" class="form-control" placeholder="Surname">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>รหัสผ่าน: <span class="text-danger">*กรณีเปลื่ยนรหัสผ่าน</span></strong> 
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>ยืนยันรหัสผ่าน:</strong>
                        <input type="password" name="passwordconfirm" class="form-control" placeholder="Confirm Password">
                    </div>
        
                    <div class="form-group">
                        <label>Roles:</label><br>
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!} --}}

