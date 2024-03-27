@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียด</title>
</head>

<body>
</body>
</body>

</html>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">รายการการเบิกวัสดุที่อนุมัติแล้ว</div>
                    {{-- <span class="badge btn btn-success">{{$disbursement->status }}</span> --}}
                    {{-- <p>ID การเบิก : {{ $disbursement->status }}<br></p> --}}
                    <div>
                        <div class="pull-right ">
                            <p>ID การเบิก : {{ $disbursement->disbursement_id }}<br></p>
                            <p>รายการ :                                 
                                @foreach ($disbursement_detail as $item)
                                {{ $item->material_name }}<br> 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                @endforeach<br></p>
                            <p>ผู้ขอเบิก : {{ $disbursement->sender_name }}<br></p>
                            <p>วันที่เบิก : {{ $disbursement->date_disbursement }}<br></p>
                            <p>หมายเหตุการเบิก : {{ $disbursement->note_disbursement }}<br></p>
                                @if ($disbursement->status== 'ไม่อนุมัติ')
                                    <p>หมายเหตุไม่อนุมัติการเบิก : {{ $disbursement->note_approved }}<br></p>
                                @endif
                            
                            <br>

                            <a href={{ route('withdraw.history.considered') }}><button
                                    class='btn btn-secondary m-2'>ย้อนกลับ</button></a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
