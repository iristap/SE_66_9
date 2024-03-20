@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair</title>
</head>
<body style="background-color: #FFFFFF;">

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
                            <tr class="text-center">
                            <th scope="col">ลำดับ</th>
                            <th scope="col">รหัสครุภัณฑ์</th>
                            <th scope="col">ครุภัณฑ์</th>
                            <th scope="col">ผู้ตรวจคืน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($repairs->isEmpty())
                                 <tr>
                                    <td colspan="6" class="text-center">ไม่มีข้อมูล</td>
                                </tr>
                         @else
                            @foreach ($repairs as $repair)
                                <tr class="text-center"> 
                                <td> {{$repair->no}} </td>
                                <td> {{$repair->durable->durable_articles_code}} </td>
                                <td> {{$repair->durable->name}} </td>
                                <td>    
                                    @foreach ($repair->durable->borrowingList as $borrowingList) 
                                        {{ $borrowingList->borrowing->checker->name ?? '-' }}
                                    @endforeach     
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-warning">{{$repair->status}}</span>
                                </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('repair.show',$repair->no) }}">ซ่อม</a>
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