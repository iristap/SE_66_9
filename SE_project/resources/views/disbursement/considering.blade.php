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
                            <a class="btn btn-secondary" href="/disbursement/considered">พิจารณาแล้ว</a><br><br>


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>ผู้ขอเบิก</td>
                                        <td>วันที่ขอเบิก</td>
                                        <td>see the details</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($dbm_ring as $d) {
                                        echo '<tr>';
                                        echo "<td>{$d->disbursement_id}</td>";
                                        echo "<td>{$d->uname}</td>";
                                        echo "<td>{$d->date_disbursement}</td>";
                                        echo "<td><a href='".route('disbursement.considering_details', ['id' => $d->disbursement_id])."' class='btn btn-secondary'>details</a></td>";
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
@endsection
