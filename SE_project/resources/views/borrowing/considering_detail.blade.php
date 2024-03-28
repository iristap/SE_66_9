@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">รายละเอียดการยืมครุภัณฑ์</div>
                    <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right ">
                            <p>ID การยืม : {{$borrowings->borrowing_id}}<br></p>
                            <p>ผู้ขอเบิก : {{$borrowings->sender_name}}<br></p>
                            <p>วันที่ยืม : {{$borrowings->borrow_date}}<br></p>

                            <br>
                            <h4>รายการยืมครุภัณฑ์</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>name</td>
                                        <td>เหตุผลการยืม</td>
                                    </tr>
                                </thead>
                                @foreach ($borrowing_list as $item)
                                    <tr>
                                        <td>{{ $item->da_code }}</td>
                                        <td>{{ $item->da_name }}</td>
                                        <td>{{ $item->bl_reason }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <a href={{ route('borrowing.history.considering') }}><button class='btn btn-secondary '>ย้อนกลับ</button></a>
                            <br>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection