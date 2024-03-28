@extends('layouts.app')
@section('content')
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FC6736; font-size: 20px;">{{ __('ประวัติการยืมครุภัณฑ์') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card bg-warning text-black mb-4">
                                    <div class="card-body">รอการอนุมัติ {{$waitingCount}}</div>
                                    
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">อนุมัติแล้ว {{$approvedCount}}</div>
        
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">ไม่อนุมัติ {{$rejectedCount}}</div>
                                    
                                </div>
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-secondary" href="{{ route('borrowing.history.considering') }}">รอการอนุมัติ</a>
                            <a class="btn btn-secondary" href="{{ route('borrowing.history.considered') }}">พิจารณาแล้ว</a><br><br>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
