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
                            <!-- <br>
                            <h2>การอนุมัติการเบิกอุปกรณ์</h2> -->
                        </div>
                        <div>
                            <?php
                            if ($dbmUser->status == 'อนุมัติแล้ว') {
                                // echo "<button class='btn btn-success my-2'>พิจารณาอนุมัติแล้ว</button>";
                                echo "<span style='font-size: 18px;' class='badge badge-success'>พิจารณาอนุมัติแล้ว</span>";
                            } elseif ($dbmUser->status == 'ไม่อนุมัติ') {
                                // echo "<button class='btn btn-danger my-2'>พิจารณาไม่อนุมัติ</button>";
                                echo "<span style='font-size: 18px;' class='badge badge-danger'>พิจารณาไม่อนุมัติ</span>";
                            }
                            ?>
                        </div>


                        <div class="pull-right mt-3">
                            <?php
                            if ($dbmUser) {
                                echo "ID การยืม: {$dbmUser->disbursement_id}<br>";
                                echo "ID ผู้ขอยืมครุภัณฑ์: {$dbmUser->user_id}<br>";
                                echo "ชื่อผู้ขอยืมครุภัณฑ์: {$dbmUser->users_name}<br>";
                                echo "วันที่ทำรายการ: {$dbmUser->date_disbursement}<br>";
                                echo "หมายเหตุการยืมครุภัณฑ์: {$dbmUser->note_disbursement}<br>";
                                echo "สถานะการทำรายการ: {$dbmUser->status}<br>";
                                echo "วันที่พิจารณารายการ: {$dbmUser->date_approved}<br>";
                                echo "ผู้พิจารณารายการ: {$app->name}<br><br>";
                                if ($dbmUser->status == 'ไม่อนุมัติ') {
                                    echo "เหตุผลการไม่อนุมัติ: {$dbmUser->note_approved}<br>";
                                }
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
                                <a href='/disbursement/considered'><button class='btn btn-secondary my-2'>กลับ</button></a>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endsection
