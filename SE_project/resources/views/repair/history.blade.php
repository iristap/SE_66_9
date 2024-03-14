@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair</title>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #EE82EE;">{{ __('ประวัติการซ่อม') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รหัสครุภัณฑ์</th>
                                <th scope="col">ครุภัณฑ์</th>
                                <th scope="col">ผู้ทำการซ่อม</th>
                                <th scope="col">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($repairs->isEmpty())
                                 <tr>
                                    <td colspan="6" class="text-center">ไม่มีข้อมูล</td>
                                </tr>
                         @else
                            @foreach($repairs as $index => $repair)
                            <tr class="text-center">
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $repair->durable_articles_code }}</td>
                                <td>{{ $repair->name }}</td>
                                <td>{{ $repair->inspector_name }}</td>
                                <td>
                                @if($repair->status == 'ปกติ')
                                    <span class="badge badge-success">ปกติ</span>
                                @elseif($repair->status == 'ไม่สามารถซ่อมได้')
                                    <span class="badge badge-danger">ไม่สามารถซ่อมได้</span>
                                @endif
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