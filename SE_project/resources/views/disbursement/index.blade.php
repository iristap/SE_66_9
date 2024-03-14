@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <h2>Disbursement list</h2>
                        </div>

                        <div class="pull-right ">
                            <a class="btn btn-warning" href="/disbursement/considering">รอการอนุมัติ</a>
                            <a class="btn btn-success" href="/disbursement/considered">พิจารณาแล้ว</a><br><br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
