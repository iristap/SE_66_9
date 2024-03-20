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
                        <br>
                            <!-- <br><h2>การอนุมัติการเบิกอุปกรณ์</h2> -->
                        </div>

                        <div class="pull-right ">
                            <a class="btn btn-warning" href="/disbursement/considering">กำลังพิจารณา</a>
                            <a class="btn btn-secondary" href="/disbursement/considered">พิจารณาแล้ว</a><br><br>


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>ผู้ขอเบิก</td>
                                        <td>วันที่ขอเบิก</td>
                                        <td>รายละเอียด</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($dbm_ring as $d) {
                                        echo '<tr>';
                                        echo "<td>{$d->disbursement_id}</td>";
                                        echo "<td>{$d->uname}</td>";
                                        echo "<td>{$d->date_disbursement}</td>";
                                        echo "<td><a href='".route('disbursement.considering_details', ['id' => $d->disbursement_id])."' class='btn btn-secondary'>ดูรายละเอียด</a></td>";
                                        echo '</tr>';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
