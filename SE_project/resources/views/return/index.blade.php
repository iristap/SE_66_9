@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return</title>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #99CCCC;">{{ __('คืนครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ทำรายการ</th>
                            <th scope="col">วันที่กำหนดคืน</th>
                            <th scope="col">วันที่คืน</th>
                            <th scope="col">ผู้ทำการยืม</th>
                            <th scope="col">ผู้อนุมัติ</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($returns->isEmpty())
                                 <tr>
                                    <td colspan="9" class="text-center">ไม่มีข้อมูล</td>
                                </tr>
                         @else
                        @foreach($returns as $return)
                        <tr class="text-center">
                            <td>{{ $return->borrowing_list_id }}</td> 
                            <td>{{ $return->borrowing->borrow_date }}</td>
                            <td>{{ $return->borrowing->due_date }}</td>
                            <td>{{ $return->borrowing->return_date }}</td>
                            <td>{{ optional($return->borrowing->sender)->name }}</td>
                            <td>{{ optional($return->borrowing->approver)->name }}</td>
                            <td>
                                <span class="badge badge-danger">{{ $return->durable->status }}</span>
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('return.show', ['id' => $return->borrowing_list_id]) }}">คืน</a>
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