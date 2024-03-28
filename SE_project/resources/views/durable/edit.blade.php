@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Durable Articles</title> -->
</head>
<!-- <body style="background-color: #f9ffc2;"> -->
<body>
</body>
</html>
@section('title','แก้ไขครุภัณฑ์')
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white " style="background-color: #FC6736; font-size: 20px; ">{{ __('แก้ไขครุภัณฑ์') }}</div>

                <div class="card-body">
                    <!-- <div class="my-2">
                        <span class = "text-danger"></span>
                    </div> -->
                    <form method="POST" action="{{ route('durable.edit',$durable->durable_articles_id) }}">
                        @csrf
                        <!-- @method('PUT') ใช้ method PUT เพื่อระบุว่าเป็นการอัปเดตข้อมูล -->
                        @method('PUT')
                        <!-- สร้างฟิลด์ของฟอร์มสำหรับแก้ไขข้อมูล -->
                        <div class=form-group>
                            <label class="col-md-4 col-form-label text-md">หมายเลขครุภัณฑ์</label>
                            <input class="col-md-4 col-form-label text-md" type="text" name="durable_articles_code" value="{{ $durable->durable_articles_code }}">
                        </div>
                        @error('durable_articles_code')
                        <div>
                            <span class="text-danger  d-flex justify-content-center ">{{$message}}</span>
                        </div>
                        @enderror
                        <div class=form-group>
                            <label class="col-md-4 col-form-label text-md">ชื่อ</label>
                            <input class="col-md-4 col-form-label text-md" type="text" name="name" value="{{ $durable->name }}">
                        </div>
                        @error('name')
                        <div>
                            <span class="text-danger  d-flex justify-content-center ">{{$message}}</span>
                        </div>
                        @enderror
                            <!-- เพิ่มฟิลด์อื่น ๆ ตามต้องการ -->
                        <div class="card-footer d-flex flex-row-reverse">
                        <div class="d-flex flex-row-reverse">
                            <a href="/durable" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                            <!-- <button class="btn btn-danger p-2 ml-4" type="submit">ยกเลิก</button> -->
                            <button class="btn btn-primary p-2 ml-4" type="submit">อัปเดต</button>
                        </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection