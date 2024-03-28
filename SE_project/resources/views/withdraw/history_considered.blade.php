@extends('layouts.app')
@section('content')
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FF5BAE; font-size: 20px;">{{ __('ประวัติการเบิกวัสดุ') }}</div>
                    <div class="card-body">
                        <div>
                            <a class="btn btn-secondary" href="{{ route('withdraw.history.considering') }}">รอการอนุมัติ</a>
                            <a class="btn btn-success" href="{{ route('withdraw.history.considered') }}">พิจารณาแล้ว</a><br><br>
                        </div>
                        @if ($disbursement->isEmpty())
                            ไม่มีประวัติการเบิกวัสดุที่พิจารณาแล้ว
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>วันที่เบิก</td>
                                        <td>รายการ</td>
                                        <td>ผู้อนุมัติ</td>
                                        <td>สถานะ</td>
                                        <td>รายละเอียด</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disbursement as $item)
                                    @php
                                    $disbursementId = $item->disbursement_id;
                                    if (!isset($idCounts[$disbursementId])) {
                                        $idCounts[$disbursementId] = 1;
                                    } else {
                                        $idCounts[$disbursementId]++;
                                    }
                                @endphp
                                    <tr>
                                        <td>{{ $item->disbursement_id }}</td>
                                        <td>
                                                {{ $item->date_disbursement }}

                                        <td>{{ $item->disbursement_lists_count }}</td>
                                        <td>
                                            @if ($item->approver_id == null)
                                                -
                                            @else
                                                {{ $item->approver_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 'อนุมัติแล้ว')
                                                <span class="badge btn btn-success">{{ $item->status }}</span>
                                            @elseif($item->status == 'ไม่อนุมัติ')
                                                <span class="badge btn btn-danger">{{ $item->status }}</span>
                                            @endif
                                        </td>

                                        <!-- <td><span class="badge btn btn-success">{{ $item->status }}</span></td> -->
                                        <td><a href="{{ route('withdraw.considered.detail', $item->disbursement_id) }}" 
                                            class="btn btn-secondary">ดูรายละเอียด</a></td>
    

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
