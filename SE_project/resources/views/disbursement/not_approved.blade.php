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
                                        <label class="col-md-4 col-form-label text-md">หมายเหตุการไม่อนุมัติ</label>
                                        <input class="col-md-4 col-form-label text-md" type="text" name="note_approved">
                                    </div>
                                    <div class="d-flex flex-row-reverse">
                                        <!-- <button class="btn btn-success p-2 ml-4" type="submit">ยืนยันการไม่อนุมัติ</button> -->
                                        <a href="/disbursement/considered/" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
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
<script>
    function confirmApprove(id1) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณต้องการอนุมัติ ' + id1 + ' ใช่หรือไม่?',
            icon: "question",
            showCancelButton: true,
            confirmButtonText: 'ยืนยันการอนุมัติ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById(id1 + '_' + id2).submit();
            }
        });
    }
    function confirmNotApprove(name, id1, id2) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณต้องการไม่อนุมัติ ' + name + ' ใช่หรือไม่?',
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'ยืนยันการไม่อนุมัติ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById(id1 + '_' + id2).submit();
            }
        });
    }
  </script>