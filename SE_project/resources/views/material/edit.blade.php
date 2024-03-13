@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material</title>
</head>
<!-- <body style="background-color: #f9ffc2;"> -->
<body>
</body>
</html>
@section('title','แก้ไขวัสดุ')
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #FB88B4; font-size: 20px;">{{ __('แก้ไขวัสดุ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('material.edit',$material->material_id) }}">
                        @csrf
                        
                        @method('PUT')
                        

                        <div class=form-group>
                            <label class="col-md-4 col-form-label text-md">ชื่อ</label>
                            <input class="col-md-4 col-form-label text-md" type="text" name="name" value="{{ $material->name }}">
                        </div>
                        @error('name')
                        <div>
                            <span class="text-danger  d-flex justify-content-center ">{{$message}}</span>
                        </div>
                        @enderror

                        <div class=form-group>
                            <label class="col-md-4 col-form-label text-md">จำนวน</label>
                            <input class="col-md-4 col-form-label text-md" type="text" name="amount" value="{{ $material->amount}}">
                        </div>
                        @error('amount')
                        <div>
                            <span class="text-danger  d-flex justify-content-center ">{{$message}}</span>
                        </div>
                        @enderror

                        <div class=form-group>
                            <label class="col-md-4 col-form-label text-md">หน่วยนับ</label>
                            <input class="col-md-4 col-form-label text-md" type="text" name="unit" value="{{ $material->unit }}">
                        </div>
                        @error('unit')
                        <div>
                            <span class="text-danger  d-flex justify-content-center ">{{$message}}</span>
                        </div>
                        @enderror
                            
                        <div class="d-flex flex-row-reverse">
                            <a href="/material" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                            <button class="btn btn-primary p-2 ml-4" type="submit">อัปเดต</button>
                            
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection