@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <br>
                            <h2>พิจารณาการเบิกอุปกรณ์</h2>
                            <h4>กรอกข้อมูลการไม่อนุมัติการเบิก</h4>
                        </div>

                        <div class="pull-right ">
                            <div class="card-body">
                                <form method="POST" action="{{ route('disbursement.na_update', $dbm->disbursement_id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class=form-group>
                                        <label class="col-md-4 col-form-label text-md">วันที่อนุมัติ</label>
                                        <input class="col-md-4 col-form-label text-md" type="date" name="date_approved">
                                    </div>
                                    <div class=form-group>
                                        <label class="col-md-4 col-form-label text-md">สถานะการทำรายการ</label>
                                        <input class="col-md-4 col-form-label text-md" type="text" name="status"
                                            value="ไม่อนุมัติ">
                                    </div>
                                    <div class=form-group>
                                        <label class="col-md-4 col-form-label text-md">หมายเหตุการไม่อนุมัติ</label>
                                        <input class="col-md-4 col-form-label text-md" type="text" name="note_approved">
                                    </div>
                                    <div class="d-flex flex-row-reverse">
                                        <button class="btn btn-success p-2 ml-4" type="submit">ยืนยันการไม่อนุมัติ</button>
                                        <a href="/disbursement" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
