@extends('layouts.app')
@section('content')
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FC6736; font-size: 20px;">{{ __('ประวัติการยืมครุภัณฑ์') }}</div>
                    <div class="card-body">
                        <div>
                            <a class="btn btn-secondary" href="{{ route('borrowing.history.considering') }}">รอการอนุมัติ</a>
                            <a class="btn btn-success" href="{{ route('borrowing.history.considered') }}">พิจารณาแล้ว</a><br><br>
                        </div>
                        @if ($borrowings->isEmpty())
                            ไม่มีประวัติการยืมครุภัณฑ์
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>กำหนดการคืน</td>
                                        <td>ผู้อนุมัติ</td>
                                        <td>วันที่ทำรายการ</td>
                                        <td>สถานะ</td>
                                        <td>รายละเอียด</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($borrowings as $item)
                                        <tr>
                                            <td>{{ $item->borrowing_id }}</td>
                                            <td>
                                                @if ($item->due_date == null)
                                                    -
                                                @else
                                                    {{ $item->due_date }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->id_approver == null)
                                                    -
                                                @else
                                                    {{ $item->approver_name }}
                                                @endif
                                            </td>
                                            <td>{{ $item->borrow_date }}</td>
                                            <td><span class="badge btn btn-success">{{ $item->status }}</span></td>
                                            <td><a href="{{ route('borrowing.considered.detail', $item->borrowing_id) }}" class="btn btn-secondary">อ่าน</a></td>
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
