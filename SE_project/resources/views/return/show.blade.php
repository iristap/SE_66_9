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
    function toggleReasonBox(index) {
        var status = document.getElementById("status-" + index).value;
        var reasonBox = document.getElementById("reasonBox-" + index);
        var detailInput = reasonBox.querySelector('input[name="detail"]');
        if (status === "ชำรุด") {
            reasonBox.style.display = "block";
            detailInput.setAttribute("required", "required");
        } else {
            reasonBox.style.display = "none";
            detailInput.removeAttribute("required");
        }
    }
    function confirmAction() {
        var confirmation = confirm("คุณแน่ใจหรือไม่ที่ต้องการดำเนินการนี้?");
        return confirmation;
    }
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
                @if($borrowingLists->isEmpty())
                        <p class="col-xs-12 col-sm-12 col-md-12">ไม่มีข้อมูล</p>
                    @else
                    <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ลำดับการซ่อม</strong> 
                                {{ $borrowings->borrowing_id }}
                            </div>                
                        </div>
                    @foreach($borrowingLists as $key => $borrowingList)
                    <form method="POST" action="{{ route('return.update', $borrowingList->borrowing_list_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>รหัสครุภัณฑ์</strong>
                                <li>{{ $borrowingList->durable->durable_articles_code }}</li>
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ชื่อครุภัณฑ์</strong>
                                <li>{{ $borrowingList->durable->name }}</li>
                            </div>                
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>สถานะ</strong>
                                <select class="form-select" style="width: 200px;" name="status" id="status-{{ $key }}" onchange="toggleReasonBox({{ $key }})">
                                    <option value="ปกติ">ปกติ</option>
                                    <option value="ชำรุด">ชำรุด</option>
                                    <option value="หาย">หาย</option>
                                </select>
                            </div>
                        </div>
                        <div id="reasonBox-{{ $key }}" class="col-xs-12 col-sm-12 col-md-12" style="display: none;">
                            <div class="form-group">
                                <strong>เหตุผลที่ชำรุด</strong>
                                <input type="text" name="detail">
                            </div>
                        </div>

                        <div class="card-footer d-flex flex-row-reverse">
                            <button class="btn btn-outline-success p-2 ml-4" type="submit" onclick="return confirmAction()">ยืนยัน</button>
                        </div>
                    </form>
                        @endforeach
                    @endif
                    <div class="card-footer d-flex flex-row-reverse">
                        <a href="{{ route('return.index') }}" class="btn btn-outline-primary p-2 ml-4">ย้อนกลับ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
