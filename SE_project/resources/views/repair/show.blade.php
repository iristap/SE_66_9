@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Detail</title>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #FB88B4;">Repair Detail</div>
                <div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ลำดับการซ่อม</strong> 
                            {{ $repair-> borrowing_id}}
                        </div>                
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>รหัสครุภัณฑ์</strong>
                            {{ $repair->durable_articles_code }}
                        </div>                
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ชื่อครุภัณฑ์</strong>
                            {{ $repair->name }}
                        </div>                
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ชื่อผู้เบิก</strong>
                            {{ $repair->sender_name }}
                        </div>                
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>วันที่ยืม</strong>
                            {{ $repair->borrow_date }}
                        </div>                
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>กำหนดคืน</strong>
                            {{ $repair->due_date }}
                        </div>                
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>เหตุผลในการยืม</strong>
                            {{ $repair->not_approved_note }}
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

                </div>
                <div class="card-footer d-flex flex-row-reverse">
                    <a href="{{ route('repair.index') }}" class="btn btn-outline-primary p-2 ml-4">ยกเลิก</a>
                    <button class="btn btn-outline-success p-2 ml-4" type="submit">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
