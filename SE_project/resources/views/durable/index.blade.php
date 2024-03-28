@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Durable Articles</title> -->
</head>
<!-- <body style="background-color: #f9ffc2;"> -->
<body>
</body>
</html>
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FC6736; font-size: 20px;">{{ __('รายการครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">หมายเลขครุภัณฑ์</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">สถานะความพร้อมใช้งาน</th>
                            <th scope="col">สถานะสภาพ</th>
                            <th width="200px" style=" padding-left: 35px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                        <?php foreach ($durable as $durableItem): ?>
                            <tr>
                                <td><?php    echo $durableItem->durable_articles_id ?></td>
                                <td><?php    echo $durableItem->durable_articles_code ?></td>
                                <td><?php    echo $durableItem->name ?></td>
                                <td><span style="font-size: 13px;" class="badge {{$durableItem->availability_status == 'ไม่พร้อมใช้งาน' ? 'btn btn-danger' : ($durableItem->availability_status == 'ถูกยืม' ? 'btn btn-secondary' : 'btn btn-success')}}">{{$durableItem->availability_status}}</span></td>
                                <td><span style="font-size: 13px;" class="badge {{$durableItem->condition_status == 'ปกติ' ? 'btn btn-primary' : ($durableItem->condition_status == 'ชำรุด' ? 'btn btn-warning' : 'btn btn-secondary')}}">{{$durableItem->condition_status}}</span></td>

                                <td>
                                <a href="{{ route('durable.edit', $durableItem->durable_articles_id) }}" class='btn btn-warning ml-4'>แก้ไข</a>
                                <a class="btn btn-danger ml-4" href="#" onclick="confirmDelete('{{ $durableItem->name }}', '{{ $durableItem->durable_articles_id }}')">ลบ</a>
                                    <form id="{{ $durableItem->durable_articles_id}}" method="POST" action="{{ route('durable.destroy', $durableItem->durable_articles_id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
  function confirmDelete(name, id) {
      Swal.fire({
          title: 'คุณแน่ใจหรือไม่?',
          text: 'คุณต้องการลบ ' + name + ' ใช่หรือไม่?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'ลบข้อมูล',
          cancelButtonText: 'ยกเลิก'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById(id).submit();
          }
      });
  }
</script>