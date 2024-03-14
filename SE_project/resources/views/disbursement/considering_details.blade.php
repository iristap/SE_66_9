@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <h2>Disbursement details</h2>
                        </div>


                        <?php

                        if ($dbmItem) {
                            echo "ID การยืม: {$dbmUser->disbursement_id}<br>";
                            echo "ID ผู้ขอยืมครุภัณฑ์: {$dbmUser->user_id}<br>";
                            echo "ชื่อผู้ขอยืมครุภัณฑ์: {$dbmUser->users_name}<br>";
                            echo "วันที่ทำรายการ: {$dbmUser->date_disbursement}<br>";
                            echo "หมายเหตุการยืมครุภัณฑ์: {$dbmUser->note_disbursement}<br>";
                            echo "สถานะการทำรายการ: {$dbmUser->status}<br>";
                        } else {
                            echo 'ไม่พบข้อมูลการยืมที่มี ID นี้';
                        }
                        ?>
                        <div class="pull-right ">
                            <br><h4>รายการเบิกอุปกรณ์</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>ชื่อ</td>
                                        <td>จำนวน</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($dbmMat as $d) {
                                        echo '<tr>';
                                        echo "<td>{$d->material_id}</td>";
                                        echo "<td>{$d->name}</td>";
                                        echo "<td>{$d->amount}</td>";
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>

                            </table>


                            <br>วันที่อนุมัติ
                            <input type="date">

                            <br>หมายเหตุกรณีไม่อนุมัติ
                            <input type="text"><br>

                            <br>
                            <br><button class="btn btn-success my-2">approved</button>
                            <button class="btn btn-danger my-2">not approved</button>

                            <a href='/disbursement/considering'><button class='btn btn-secondary my-2'>back</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
