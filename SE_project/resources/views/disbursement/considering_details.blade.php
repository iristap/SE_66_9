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
                        
                        if ($dbmUser) {
                            echo "ID การเบิก: {$dbmUser->disbursement_id}<br>";
                            echo "ID ผู้ขอเบิกวัสดุ: {$dbmUser->user_id}<br>";
                            echo "ชื่อผู้ขอเบิกวัสดุ: {$dbmUser->users_name}<br>";
                            echo "วันที่ทำรายการ: {$dbmUser->date_disbursement}<br>";
                            echo "หมายเหตุการเบิกวัสดุ: {$dbmUser->note_disbursement}<br>";
                            echo "สถานะการทำรายการ: {$dbmUser->status}<br>";
                        } else {
                            echo 'ไม่พบข้อมูลเบิกวัสดุที่มี ID นี้';
                        }
                        ?>
                        </div>
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
                            <?php
                                // echo "<a class='btn btn-success ml-4' href='#' onclick=\"confirmApprove('{$dbmUser->disbursement_id}')\">อนุมัติ</a>
                                //             <form id='{$dbmUser->disbursement_id}_{$mat->mid}' method='POST' action='".route('disbursement.a_update', [$dbmUser->disbursement_id, $mat->mid ])."' style='display: none;'>
                                //                 " . csrf_field() . "
                                //                 " . method_field('PUT') . "
                                //             </form>";
                                //<a href="{{ route('disbursement.approved', $dbmUser->disbursement_id) }}" class='btn btn-success'>อนุมัติ</a>
                            ?>
                           
                            <a class='btn btn-success ' href='#' onclick="confirmApprove('{{ $dbmUser->disbursement_id }}')">อนุมัติ</a>
                            
                                <form id='{{ $dbmUser->disbursement_id }}' method='POST' action='{{ route('disbursement.a_update', $dbmUser->disbursement_id) }}' style='display: none;'>
                                    @csrf
                                    @method('PUT')
                                </form>

                            <a href="{{ route('disbursement.not_approved', $dbmUser->disbursement_id) }}"
                                class='btn btn-danger ml-2'>ไม่อนุมัติ</a>
                            <a href='/disbursement/considering'><button class='btn btn-secondary ml-2'>กลับ</button></a>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmApprove(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณต้องการอนุมัติการเบิก ' + id + ' ใช่หรือไม่?',
            icon: "question",
            showCancelButton: true,
            confirmButtonText: 'ยืนยันการอนุมัติ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById(id).submit();
            }
        });
    }
    function confirmNotApprove(name, id1, id2) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณต้องการไม่อนุมัติ ' + name + ' ใช่หรือไม่?',
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'ยืนยันการไม่อนุมัติ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById(id1 + '_' + id2).submit();
            }
        });
    }
  </script>


