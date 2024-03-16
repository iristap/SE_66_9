@extends('layouts.app')
@section('content')
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ประวัติการยืมครุภัณฑ์') }}</div>
                    <div class="card-body">
                        <div>
                            <a class="btn btn-dark" href="{{ route('withdraw.history.considering') }}">รอการอนุมัติ</a>
                            <a class="btn btn-secondary"
                                href="{{ route('withdraw.history.considered') }}">พิจารณาแล้ว</a><br><br>
                        </div>
                        @if ($borrowings->isEmpty())
                            ไม่มีประวัติการเบิกวัสดุ
                        @else
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>วันที่เบิก</td>
                                    <td>รายการ</td>
                                    <td>จำนวน</td>
                                    <td>ผู้อนุมัติ</td>
                                    <td>สถานะ</td>
                                    <td>รายละเอียด</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($disbursement as $item)
                                <tr>
                                    <td>{{ $item->disbursement_id }}</td>
                                    <td>
                                        @if ($item->due_date == null)
                                            -
                                        @else
                                            {{ $item->due_date }}
                                        @endif
                                    </td>

                                    <td></td>

                                    <td>
                                        @if ($item->id_approver == null)
                                            -
                                        @else
                                            {{ $item->approver_name }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->id_checker == null)
                                            -
                                        @else
                                            {{ $item->checker_name }}
                                        @endif
                                    </td>

                                    <td><span class="badge btn btn-success">{{ $item->status }}</span></td>
                                    <td><span class="btn btn-secondary">ดูรายละเอียด</span></td>

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
