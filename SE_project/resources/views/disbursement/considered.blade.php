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
                            <a class="btn btn-secondary" href="/disbursement/considering">รอการอนุมัติ</a>
                            <a class="btn btn-success" href="/disbursement/considered">พิจารณาแล้ว</a><br><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>ผู้ขอเบิก</td>
                                        <td>วันที่ขอเบิก</td>
                                        <td>พิจารณา</td>
                                        <td>see the details</td>
                                    </tr>
                                </thead>

                                <?php
                                foreach ($dbm_red as $d) {
                                    echo "<tr>
                                    <td>{$d->disbursement_id}</td>
                                    <td>{$d->uname}</td>
                                    <td>{$d->date_disbursement}</td>
                                    <td>{$d->status}</td>
                                    <td><a href='".route('disbursement.considered_details', ['id' => $d->disbursement_id])."' class='btn btn-secondary'>details</a></td>
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
@endsection
