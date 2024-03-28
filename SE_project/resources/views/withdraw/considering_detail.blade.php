@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>รายละเอียด</title> -->
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
                    <div class="card-header text-white" style="background-color: #FF5BAE; font-size: 20px;">รายการรออนุมัติการเบิกวัสดุ</div>
                    <div class="card-body">
                    {{-- <span class="badge btn btn-success">{{$disbursement->status }}</span> --}}
                    {{-- <p>ID การเบิก : {{ $disbursement->status }}<br></p> --}}
                    <div>
                        
                        <div class="pull-right ">
                            
                            <div class="container">
                            <p>ID การเบิก : {{ $disbursement->disbursement_id }}<br></p>
                            <p>รายการ :</p>
                            <table class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th>ชื่อวัสดุ</th>
                                        <th>จำนวน</th>
                                    </tr>
                                </thead>
                                <tbody class="table-striped">
                                    @foreach ($disbursement_detail as $item)
                                        <tr>
                                            <td>{{ $item->material_name }}</td>
                                            <td>{{ $item->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p>ผู้ขอเบิก : {{ $disbursement->sender_name }}<br></p>
                            <p>วันที่เบิก : {{ $disbursement->date_disbursement }}<br></p>
                            <p>หมายเหตุการเบิก : {{ $disbursement->note_disbursement }}<br></p>
                             </div>

                            <a href={{ route('withdraw.history.considering') }}><button
                                    class='btn btn-secondary m-2'>ย้อนกลับ</button></a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
