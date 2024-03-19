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
                                    <td>วันที่ทำรายการ</td>
                                    <td>สถานะ</td>
                                    <td>รายละเอียด</td>
                                    <td>ลบการยืม</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowings as $item)
                                <tr>
                                <td>{{ $item->borrowing_id }}</td>
                                <td>{{ $item->borrow_date }}</td>
                                <td><span class="badge btn btn-warning">{{ $item->status }}</span></td>
                                <td><a href="{{ route('borrowing.history.detail', $item->borrowing_id) }}" class="btn btn-secondary">อ่าน</a></td>
                                <td><span class="btn btn-danger">ลบ</span></td>
                                </tr>
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
