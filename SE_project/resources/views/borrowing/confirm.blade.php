@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Details</title>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class="container">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #FB88B4;">Repair Detail</div>
                <div>
    <h1>Confirmation Page</h1>
    <p>ผู้ขอเบิก {{ $user->name }}</p>
    <p>You have selected the following items for borrowing:</p>
    <ul>
        @foreach($selectedDurables as $durable)
        <td>{{ $durable->name }}</td>
        @endforeach
    </ul>
    <form method="POST" action="{{ route('borrowing.store') }}">
    <div class="card-footer d-flex flex-row-reverse">

     <a href="{{ route('repair.index') }}" class="btn btn-outline-primary p-2 ml-4">ยกเลิก</a>
        @csrf
        @method('POST')
        <button class="btn btn-outline-success p-2 ml-4" type="submit">ยืนยัน</button>
     </div>
    </form>
</div>
</div>
</div>
</div>
@endsection