@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FC6736; font-size: 20px;">{{ __('การอนุมัติการยืมครุภัณฑ์') }}</div>
                <div class="card-body">
                <!-- <div class="row"> -->
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <br>
                            <!-- <h2>การอนุมัติการยืมครุภัณฑ์</h2> -->
                        </div>

                        <div class="pull-right ">
                            <a class="btn btn-secondary" href="/borrowing">กำลังพิจารณา</a>
                            <a class="btn btn-success" href="/borrowing/considered">พิจารณาแล้ว</a><br><br>

                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Borrower</td>
                                        <td>Borrowing Date</td>
                                        <td>Due Date</td>
                                        <td>รายละเอียด</td>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                foreach ($onlyB as $o) {
                                    if ($o->id_approver != NULL) {
                                        $borrowDate = new DateTime($o->borrow_date);
                                        $dueDate = $borrowDate->add(new DateInterval('P14D'))->format('Y-m-d');

                                        echo "<tr>
                                                <td>{$o->borrowing_id}</td>
                                                <td>{$o->uname}</td>
                                                <td>{$o->borrow_date}</td>
                                                <td>{$dueDate}</td>
                                                <td><a href='" .
                                            route('borrowing.detailsC', ['id' => $o->borrowing_id]) .
                                            "' class='btn btn-secondary'>ดูรายละเอียด</a></td>
                                        </tr>";
                                    }
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
