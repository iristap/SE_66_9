@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FF5BAE; font-size: 20px;">{{ __('การอนุมัติการเบิกอุปกรณ์') }}</div>
                <div class="card-body">
                <!-- <div class="row"> -->
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                        <br>
                            <!-- <br><h2>การอนุมัติการเบิกอุปกรณ์</h2> -->
                        </div>

                        <div class="pull-right ">
                            <a class="btn btn-secondary" href="/disbursement/considering">กำลังพิจารณา</a>
                            <a class="btn btn-success" href="/disbursement/considered">พิจารณาแล้ว</a><br><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>ผู้ขอเบิก</td>
                                        <td>วันที่ขอเบิก</td>
                                        <td>พิจารณา</td>
                                        <td>รายละเอียด</td>
                                    </tr>
                                </thead>

                                <?php
                                foreach ($dbm_red as $d) {
                                    echo "<tr>
                                    <td>{$d->disbursement_id}</td>
                                    <td>{$d->uname}</td>
                                    <td>{$d->date_disbursement}</td>
                                    <td>{$d->status}</td>
                                    <td><a href='".route('disbursement.considered_details', ['id' => $d->disbursement_id])."' class='btn btn-secondary'>ดูรายละเอียด</a></td>
                                </tr>";
                                }

                                echo '</tbody>';
                                echo '</table>';
                                ?>


                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
