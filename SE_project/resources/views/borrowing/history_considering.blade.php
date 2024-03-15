@extends('layouts.app')
@section('content')
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ประวัติการยืมครุภัณฑ์') }}</div>
                    <div class="card-body">
                        <div>
                            <a class="btn btn-dark" href="{{ route('borrowing.history.considering') }}">รอการอนุมัติ</a>
                            <a class="btn btn-secondary"
                                href="{{ route('borrowing.history.considered') }}">พิจารณาแล้ว</a><br><br>
                        </div>
                        @if ($borrowings->isEmpty())
                            ไม่มีประวัติการยืมครุภัณฑ์
                        @else
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>กำหนดการคืน</td>
                                    <td>ผู้อนุมัติ</td>
                                    <td>ผู้ตรวจคืน</td>
                                    <td>วันที่ทำรายการ</td>
                                    <td>สถานะ</td>
                                    <td>รายละเอียด</td>
                                    <td>ลบการยืม</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowings as $item)
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->due_date }}</td>
                                <td>{{ $item->id_approver }}</td>
                                <td>{{ $item->id_checker }}</td>
                                <td>{{ $item->borrow_date }}</td>
                                <td>{{ $item->status }}</td>
                                <td><a class="btn btn-secondary">อ่าน</a></td>
                                <td><a class="btn btn-danger">ลบ</a></td>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
