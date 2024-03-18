@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <br>
                            <h2>พิจารณาการยืมครุภัณฑ์</h2>
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
                                        <td>code</td>
                                        <td>name</td>
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
                                    echo "<td>{$b->status}</td>";
                                    if($b->status=='รอการอนุมัติ'){
                                        echo "<td>
                                            <a class='btn btn-success ml-4' href='#' onclick=\"confirmApprove('{$b->da_name}', '{$brlItem->borrowing_id}', '{$b->da_id}')\">อนุมัติ</a>
                                            <form id='{$brlItem->borrowing_id}_{$b->da_id}' method='POST' action='".route('borrowing.a_update', [$brlItem->borrowing_id, $b->da_id ])."' style='display: none;'>
                                                " . csrf_field() . "
                                                " . method_field('PUT') . "
                                            </form>
                                            
                                            <a class='btn btn-danger ml-4' href='#' onclick=\"confirmNotApprove('{$b->da_name}', '{$brlItem->borrowing_id}', '{$b->da_id}')\">ไม่อนุมัติ</a>
                                            <form id='{$brlItem->borrowing_id}_{$b->da_id}' method='POST' action='".route('borrowing.na_update', [$brlItem->borrowing_id, $b->da_id ])."' style='display: none;'>
                                                " . csrf_field() . "
                                                " . method_field('PUT') . "
                                            </form>
                                            </td>";
                                    }
                                    echo "</tr>";
                                }
                                ?>



                                </tbody>
                            </table>
                            <a href='/borrowing'><button class="btn btn-info my-2">พิจารณาเสร็จสิ้น</button></a>
                            <a href='/borrowing'><button class="btn btn-secondary my-2">back</button></a>

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