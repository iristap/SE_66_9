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
                            <h4>อนุมัติการยืม</h4>
                        </div>

                        <div class="pull-right ">
                            <div class="card-body">
                                <?php
                                var_dump($br);
                                ?>
                                <form method="POST" action="{{ route('borrowing.update', $borrowingId) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class=form-group>
                                        <label class="col-md-4 col-form-label text-md">ผู้อนุมัติ</label>
                                        <input class="col-md-4 col-form-label text-md" type="text" name="approver"
                                            value="{{ $apper ? $apper->apper : '' }}">
                                    </div>



                                    <div class="d-flex flex-row-reverse">
                                        <a href="/borrowing" class="btn btn-secondary p-2 ml-4">ยกเลิก</a>
                                        <button class="btn btn-primary p-2 ml-4" type="submit">อัปเดต</button>

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
