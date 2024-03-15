@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Detail</title>
</head>
<body style="background-color: #FFFFFF;">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('statusSelect');
        const damageReasonField = document.getElementById('damageReasonField');

        statusSelect.addEventListener('change', function() {
            if (statusSelect.value === 'ชำรุด') {
                damageReasonField.style.display = 'block';
            } else {
                damageReasonField.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #99FFCC;">รายละเอียดการคืนครุภัณฑ์</div>
                <div>
                    <form method="POST" action="{{ route('return.update', $borrowingList->borrowing_list_id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ลำดับการซ่อม</strong> 
                                {{ $borrowing->borrowing_id }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>รหัสครุภัณฑ์</strong>
                                {{ $durable->durable_articles_code }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ชื่อครุภัณฑ์</strong>
                                {{ $durable->name }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ชื่อผู้เบิก</strong>
                                {{ optional($borrowing->sender)->name }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>วันที่ยืม</strong>
                                {{ $borrowing->borrow_date }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>กำหนดคืน</strong>
                                {{ $borrowing->due_date }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>เหตุผลในการยืม</strong>
                                {{ $borrowing->borrowing_note }}
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>สถานะ</strong>
                                <select class="form-select" style="width: 200px;" name="status" id="statusSelect">
                                    <option value="ปกติ">ปกติ</option>
                                    <option value="ชำรุด">ชำรุด</option>
                                    <option value="หาย">หาย</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" id="damageReasonField" style="display: none;">
                            <div class="form-group">
                                <strong>เหตุผลที่ชำรุด</strong>
                                <input type="text" class="form-control" name="detail">
                            </div>
                        </div>

                        <div class="card-footer d-flex flex-row-reverse">
                            <a href="{{ route('return.index') }}" class="btn btn-outline-primary p-2 ml-4">ยกเลิก</a>
                            <button class="btn btn-outline-success p-2 ml-4" type="submit">ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

