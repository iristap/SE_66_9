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
                <div class="card-header" style="background-color: #dda0dd;">{{ __('รายการส่งซ่อมครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">รหัสครุภัณฑ์</th>
                            <th scope="col">ครุภัณฑ์</th>
                            <th scope="col">ผู้ตรวจคืน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repairs as $repair)
                                <tr>
                                <td> {{$repair->no}} </td>
                                <td> {{$repair->durable_articles_id}} </td>
                                <td> {{$repair->durable->name}} </td>
                                <td> {{$repair->inspector_name}} </td>
                                <td>
                                    <span class="badge rounded-pill bg-warning">{{$repair->status}}</span>
                                </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('repair.show',$repair->no) }}">ซ่อม</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection