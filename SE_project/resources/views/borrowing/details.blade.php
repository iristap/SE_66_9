@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <br><h2>พิจารณาการยืมครุภัณฑ์</h2>
                        </div>

                        <div class="pull-right ">
                            <?php
                            if ($brlItem) {
                                // สร้างวัตถุ DateTime จาก borrow_date
                                $borrowDate = new DateTime($br_user->borrow_date);
                                // เพิ่ม 14 วันให้กับ borrow_date
                                $dueDate = $borrowDate->add(new DateInterval('P14D'))->format('Y-m-d');

                                echo "ID การยืม: {$brlItem->borrowing_id}<br>";
                                echo "ID ผู้ขอยืมครุภัณฑ์: {$br_user->users_id}<br>";
                                echo "ชื่อผู้ขอยืมครุภัณฑ์: {$br_user->users_name}<br>";
                                echo "วันที่ทำรายการ: {$br_user->borrow_date}<br>";
                                echo "วันกำหนดคืน: {$dueDate}<br>";
                                echo "หมายเหตุการยืมครุภัณฑ์: {$br_user->borrowing_note}<br>";
                                echo "สถานะการทำรายการ: {$br_user->status}<br>";


                            } else {
                                echo 'ไม่พบข้อมูลการยืมที่มี ID นี้';
                            }
                            ?>

                            <br>
                            <h4>รายการยืมครุภัณฑ์</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>name</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($br_da as $b) {
                                        echo '<tr>';
                                        echo "<td>{$b->da_id}</td>";
                                        echo "<td>{$b->da_name}</td>";
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <br><button class="btn btn-success my-2">อนุมัติ</button>
                            <button class="btn btn-danger my-2">ไม่อนุมัติ</button>
                            <a href='/borrowing'><button class="btn btn-secondary my-2">back</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
