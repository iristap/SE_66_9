@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
            <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">รายละเอียดการยืมครุภัณฑ์</div>
                    <div class="col-lg-12 margin-tb">
                        <div class="card-body">

                        <div class="pull-right ">
                            <p>ID การยืม : {{$borrowings->borrowing_id}}<br></p>
                            <p>ผู้ขอเบิก : {{$borrowings->sender_name}}<br></p>
                            <p>วันที่ยืม : {{$borrowings->borrow_date}}<br></p>
                            <p>กำหนดการคืน : {{$borrowings->due_date}}<br></p>   

                            <br>
                            <h4>รายการยืมครุภัณฑ์</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>name</td>
                                        <td>เหตุผลการยืม</td>
                                        <td>เหตุผลที่ไม่อนุมัติ</td>
                                        <td>สถานะ</td>
                                    </tr>
                                </thead>
                                @foreach ($borrowing_list as $item)
                                    <tr>
                                        <td>{{ $item->da_code }}</td>
                                        <td>{{ $item->da_name }}</td>
                                        <td>{{ $item->br_note }}</td>
                                        <td>{{ $item->br_not_note }}</td>
                                        <td>{{ $item->br_status }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <br>
                            <h4><p>หมายเหตุ : {{$borrowings->not_approved_note}}<br></p></h4>   
                            <p>ผู้อนุมัติ : {{ $borrowings->approver_name }}<br></p>
                            
                            <!-- <p>ผู้ตรวจคืน :  $borrowings->checker_name }}<br></p> -->    
                            <a href={{ route('borrowing.history.considered') }}><button class='btn btn-secondary'>ย้อนกลับ</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection