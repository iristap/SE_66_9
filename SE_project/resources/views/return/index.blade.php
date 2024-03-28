@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Return</title> -->
</head>
<body style="background-color: #FFFFFF;">

</body>
</html>
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white " style="background-color: #37B5B6; font-size: 20px; ">{{ __('คืนครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ทำรายการ</th>
                            <th scope="col">วันที่กำหนดคืน</th>
                            <th scope="col">วันที่คืน</th>
                            <th scope="col">ผู้ทำการยืม</th>
                            <th scope="col">ผู้อนุมัติ</th>
                            <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($returns->isEmpty())
                                 <tr>
                                    <td colspan="9" class="text-center">ไม่มีข้อมูล</td>
                                </tr>
                         @else
                        @foreach($returns as $index => $return)
                        <tr class="text-center">
                             <td scope="row">{{ $index + 1 }}</td>
                            <td>{{ $return->borrow_date }}</td>
                            <td>{{ $return->due_date }}</td>
                            <td>{{ date('Y-m-d') }}</td>
                            <td>{{ optional($return->sender)->name }}</td>
                            <td>{{ optional($return->approver)->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('return.show', ['id' => $return->borrowing_id]) }}">ดูรายละเอียด</a>
                            </td>

                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection