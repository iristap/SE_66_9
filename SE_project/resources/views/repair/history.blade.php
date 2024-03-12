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
                <div class="card-header" style="background-color: #dda0dd;">{{ __('ประวัติการซ่อม') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ลำดับ</th>
                                <th scope="col" class="text-center">รหัสครุภัณฑ์</th>
                                <th scope="col" class="text-center">ครุภัณฑ์</th>
                                <th scope="col" class="text-center">ผู้ทำการซ่อม</th>
                                <th scope="col" class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection