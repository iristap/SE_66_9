@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FF5BAE; font-size: 20px;">{{ __('การอนุมัติการเบิกอุปกรณ์') }}</div>
                <!-- <div class="row"> -->
                
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <!-- <br><h2>การอนุมัติการเบิกอุปกรณ์</h2> -->
                        </div>

                        <div class="pull-right ">
                            <a class="btn btn-warning" href="/disbursement/considering">กำลังพิจารณา</a>
                            <a class="btn btn-success" href="/disbursement/considered">พิจารณาแล้ว</a><br><br>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
