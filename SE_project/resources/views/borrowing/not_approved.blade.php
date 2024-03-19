@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <br>
                            <h2>พิจารณาการยืมครุภัณฑ์</h2>
                            <h4>กรอกข้อมูลเพื่อไม่อนุมัติการยืม</h4>
                        </div>

                        <div class="pull-right ">
                            <div class="card-body">
                            <form id="not_approve_form_{{ $bid }}_{{ $da_id }}" method="POST" action="{{ route('borrowing.na_update', [$bid, $da_id]) }}">
                                <!-- <form id="not_approve_form" method="POST" action="{{ route('borrowing.na_update', [$bid, $da_id]) }}"> -->
                                    @csrf
                                    @method('PUT')
                                    <div class=form-group>
                                        <label class="col-md-4 col-form-label text-md">หมายเหตุการไม่อนุมัติ</label>
                                        <input class="col-md-4 col-form-label text-md" type="text" name="not_approved_note">
                                    </div>
                                    @error('not_approved_note')
                                    <div>
                                        <span class="text-danger  d-flex justify-content-center ">{{$message}}</span>
                                    </div>
                                    @enderror
                                    
                                    <!-- <div class="d-flex flex-row-reverse">
                                        <button class="btn btn-danger p-2 ml-4" type="submit">ยืนยันการไม่อนุมัติ</button>
                                        <a href="{{ route('borrowing.details', [$bid, $da_id]) }}" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                                    </div> -->
                                    <div class="d-flex flex-row-reverse">
                                    <button id="confirm_not_approve_{{ $bid }}_{{ $da_id }}" class="btn btn-danger" type="button">ยืนยัน</button>
                                        <!-- <button id="confirm_not_approve" class="btn btn-danger" type="button">ยืนยัน</button> -->
                                        <!-- <button class="btn btn-danger p-2 ml-4" href='#' onclick="confirmNotApprove('{{ $bid }}', '{{ $da_id }}')">ยืนยัน</button> -->
                                            <!-- <form id='{{ $bid }}_{{$da_id}}' method="POST" action="{{ route('borrowing.na_update', [$bid, $da_id]) }}">
                                                @csrf
                                                @method('PUT')
                                            </form> -->
                                        <!-- <input type="hidden" name="not_approved_note" value="{{ old('not_approved_note') }}"> -->
                                        <!-- <form id='{{$bid}}_{{$da_id}}' method='POST' action="{{ route('borrowing.na_update', [$bid, $da_id]) }}" style='display: none;'>
                                            @csrf
                                            @method('PUT')
                                        </form> -->
                                        <a href="{{ route('borrowing.details', [$bid, $da_id]) }}" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('confirm_not_approve_{{ $bid }}_{{ $da_id }}').addEventListener('click', function () {
                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: 'คุณต้องการไม่อนุมัติการยืมนี้ ใช่หรือไม่?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('not_approve_form_{{ $bid }}_{{ $da_id }}').submit();
                    }
                });
            });
        });
    </script>
@endsection

