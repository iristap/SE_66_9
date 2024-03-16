@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <br>
                            <h2>การอนุมัติการเบิกอุปกรณ์</h2>
                        </div>
                        <?php

                        if ($dbmUser) {
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
                            <br>
                            <h4>รายการเบิกอุปกรณ์</h4>
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
                                        foreach ($mat as $m) {
                                            echo '<tr>';
                                            echo "<td>{$m->mid}</td>";
                                            echo "<td>{$m->mname}</td>";
                                            echo "<td>{$m->amount}</td>";
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <a href="{{ route('disbursement.approved', $dbmUser->disbursement_id) }}"
                                class="btn btn-success">อนุมัติ</a>
                            <a href="{{ route('disbursement.not_approved', $dbmUser->disbursement_id) }}"
                                class="btn btn-danger">ไม่อนุมัติ</a>
                            <a href='/disbursement/considering'><button class='btn btn-secondary my-2'>กลับ</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
