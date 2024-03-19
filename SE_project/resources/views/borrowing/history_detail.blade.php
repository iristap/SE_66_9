@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <br><h2>รายละเอียดการยืมครุภัณฑ์</h2>
                        </div>

                        <div class="pull-right ">
                            <p>ID การยืม : {{$borrowings->borrowing_id}}<br></p>
                            <p>ผู้ขอเบิก : {{$borrowings->sender_name}}<br></p>
                            <p>วันที่ยืม : {{$borrowings->borrow_date}}<br></p>
                            <p>กำหนดการคืน : {{$borrowings->due_date}}<br></p>   
                            <p>เหตุผลการยืม : {{$borrowings->borrowing_note}}<br></p>   

                            <br>
                            <h4>รายการยืมครุภัณฑ์</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>name</td>
                                    </tr>
                                </thead>
                                @foreach ($borrowing_list as $item)
                                    <tr>
                                        <td>{{ $item->da_code }}</td>
                                        <td>{{ $item->da_name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <br>
                            <h4><p>หมายเหตุ : {{$borrowings->not_approved_note}}<br></p></h4>   
                            <p>ผู้อนุมัติ :</p>
                            @if ($borrowings->id_approver == null)
                                -
                            @else
                                {{ $borrowings->approver_name }}<br>
                            @endif
                            <p>ผู้ตรวจคืน :</p>
                            @if ($borrowings->id_checker == null)
                                -
                            @else
                                {{ $borrowings->checker_name }}<br>
                            @endif
                            <a href={{ route('borrowing.history.considering') }}><button class='btn btn-secondary m-2'>ย้อนกลับ</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection