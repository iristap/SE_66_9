@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing</title>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class ="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #FF6699;">{{__('การยืม') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('borrowing.confirm') }}">
                        @csrf
                        @method('POST')
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รหัสครุภัณฑ์</th>
                                    <th scope="col">ครุภัณฑ์</th>
                                    <th scope="col">เลือก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($durables as $index => $durable)
                                <tr class="text-center">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td>{{ $durable->durable_articles_code }}</td>
                                    <td>{{ $durable->name }}</td>
                                    <td><input type="checkbox" class="form-check-input checkbox-center" name="durable_articles_id[]" value="{{ $durable->durable_articles_id }}"></td>
                                </tr>           
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-outline-success p-2 ml-4">ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection