@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Repair Detail</title> -->
</head>
<body style="background-color: #FFFFFF;">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header  text-white " style="background-color: #7360DF; font-size: 20px; ">Repair Detail</div>
                <div>
                <div class="card-body">
                    <form method="POST" action="{{ route('repair.update', $repair->no) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ลำดับการซ่อม</strong> 
                                {{ $repair->no}}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>รหัสครุภัณฑ์</strong>
                                {{ $repair->durable->durable_articles_code }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ชื่อครุภัณฑ์</strong>
                                {{ $sender->name }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ชื่อผู้เบิก</strong>
                                {{ $repair->durable->name }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>วันที่ยืม</strong>
                                {{ $repair->borrowingList->borrowing->borrow_date }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>กำหนดคืน</strong>
                                {{ $repair->borrowingList->borrowing->due_date }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>เหตุผลในการยืม</strong>
                                {{ $repair->borrowingList->borrowing_note }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>เหตุผลในการพัง</strong>
                                {{ $repair->detail }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>สถานะ</strong>
                                <select class="form-select" style="width: 200px;" name="status">
                                    <option value="ปกติ">ปกติ</option>
                                    <option value="ไม่สามารถซ่อมได้">ไม่สามารถซ่อมได้</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer d-flex flex-row-reverse">
                            <a href="{{ route('repair.index') }}" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                            <button class="btn btn-success p-2 ml-4" type="submit">ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>
