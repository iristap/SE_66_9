@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FC6736; font-size: 20px;">{{ __('พิจารณาการยืมครุภัณฑ์') }}</div>
                <div class="card-body">
                <!-- <div class="row"> -->
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <!-- <br>
                            <h2>พิจารณาการยืมครุภัณฑ์</h2> -->
                        </div>

                        <div class="pull-right ">
                            <?php
                            if ($brlItem) {
                                echo "ID การยืม: {$brlItem->borrowing_id}<br>";
                                echo "ID ผู้ขอยืมครุภัณฑ์: {$br_user->users_id}<br>";
                                echo "ชื่อผู้ขอยืมครุภัณฑ์: {$br_user->users_name}<br>";
                                echo "วันที่ทำรายการ: {$br_user->borrow_date}<br>";
                                 // เพิ่ม 14 วันให้กับ borrow_date
                                echo "วันกำหนดคืน: " . (new DateTime($br_user->borrow_date))->add(new DateInterval('P14D'))->format('Y-m-d') . "<br>";
                                //echo "หมายเหตุการยืมครุภัณฑ์: {$br_user->borrowing_note}<br>";
                                echo "สถานะการทำรายการ: {$br_user->status}<br>";
                            } else {
                                echo 'ไม่พบข้อมูลการยืมที่มี ID นี้';
                            }
                            ?>

                            <br>
                            <h4>รายการยืมครุภัณฑ์</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>code</td>
                                        <td>name</td>
                                        <td>เหตุผลการยืม</td>
                                        <td>สถานะ</td>
                                        <td>พิจารณา</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($br_da as $b) {
                                    echo "<tr>";
                                    echo "<td>{$b->da_id}</td>";
                                    echo "<td>{$b->da_code}</td>";
                                    echo "<td>{$b->da_name}</td>";
                                    echo "<td>{$b->note}</td>";
                                    echo "<td>{$b->status}</td>";
                                    if($b->status=='รอการอนุมัติ'){
                                        echo "<td>
                                            <a class='btn btn-success ml-2' href='#' onclick=\"confirmApprove('{$b->da_name}', '{$brlItem->borrowing_id}', '{$b->da_id}')\">อนุมัติ</a>
                                            <form id='{$brlItem->borrowing_id}_{$b->da_id}' method='POST' action='".route('borrowing.a_update', [$brlItem->borrowing_id, $b->da_id ])."' style='display: none;'>
                                                " . csrf_field() . "
                                                " . method_field('PUT') . "
                                            </form>

                                            <a href=".route('borrowing.not_approved', [$brlItem->borrowing_id, $b->da_id])." class='btn btn-danger ml-2'>ไม่อนุมัติ</a>

                                            </td>";
                                    }
                                    elseif($b->status=='ไม่อนุมัติ'){
                                        echo "<td>หมายเหตุ: {$brlItem->not_approved_note}</td>";

                                    }
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                            <a href='/borrowing'><button class="btn btn-secondary">กลับ</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
  function confirmApprove(name, id1, id2) {
      Swal.fire({
          title: 'คุณแน่ใจหรือไม่?',
          text: 'คุณต้องการอนุมัติ ' + name + ' ใช่หรือไม่?',
          icon: "question",
          showCancelButton: true,
          confirmButtonText: 'ยืนยันการอนุมัติ',
          cancelButtonText: 'ยกเลิก'
      }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById(id1 + '_' + id2).submit();
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
