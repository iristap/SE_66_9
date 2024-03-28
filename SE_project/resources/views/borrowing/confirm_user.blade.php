@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Details</title>
</head>
<body>
</body>
</body>
</html>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FC6736; font-size: 20px;">ยืนยันการยืมครุภัณฑ์</div>
                <div>
                <form method="POST" action="{{ route('borrowing.store_user') }}">
                @csrf
                @method('POST')
                    <br>
                    <p class="col">ผู้ขอเบิก: {{ $user->name }} </p>
                    <p class="col">วันที่ยืม: {{ date('Y-m-d') }}</p>
                    @foreach($selectedDurables as $durable)
                        <input type="hidden" name="durable_articles_id[]" value="{{ $durable->durable_articles_id }}">
                        <input type="hidden" name="status[]" value="{{ $durable->status }}">
                        <ul>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    
                                    <div class="card">
                                        <div class="card-body">
                                                {{ $durable->durable_articles_id }}
                                                {{ $durable->durable_articles_code }}
                                                {{ $durable->name }}
                                            <br><br>
                                            <p>เหตุผลในการยืม:</p>
                                            <input type="text" name="borrowing_note[]" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </ul>
                    @endforeach
                    <div class="card-footer d-flex flex-row-reverse">
                        <a href="{{ route('borrowing.index_user') }}" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                        <button class="btn btn-success p-2 ml-4" type="submit">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection