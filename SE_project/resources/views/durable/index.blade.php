@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Durable Articles</title>
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
                <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('ครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">หมายเลขครุภัณฑ์</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">สถานะความพร้อมใช้งาน</th>
                            <th scope="col">สถานะสภาพ</th>
                            <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                        <?php foreach ($durable as $durableItem): ?>
                            <tr>
                                <td><?php echo $durableItem->durable_articles_id ?></td>
                                <td><?php echo $durableItem->durable_articles_code ?></td>
                                <td><?php echo $durableItem->name ?></td>
                                
                                <!-- <td><span class="badge badge-success">{{$durableItem->availability_status}}</span></td>
                                <td><span class="badge badge-success">{{$durableItem->condition_status}}</span></td> -->
                                <td><span style= "font-size: 13px;" class="badge {{$durableItem->availability_status == 'ว่าง' ? 'badge-success' : 'badge-danger'}}">{{$durableItem->availability_status}}</span></td>
                                <td><span style= "font-size: 13px;" class="badge {{$durableItem->condition_status == 'ปกติ' ? 'badge-info' : 'badge-warning'}}">{{$durableItem->condition_status}}</span></td>

                                <td>
                                <a href="{{ route('durable.edit',$durableItem->durable_articles_id) }}" class='btn btn-warning ml-4'>Edit</a>
                                <a class="btn btn-danger ml-4" href="#" onclick="confirmDelete('{{ $durableItem->name }}', '{{ $durableItem->durable_articles_id }}')">Delete</a>
                                    <form id="{{ $durableItem->durable_articles_id}}" method="POST" action="{{ route('durable.destroy', $durableItem->durable_articles_id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                <!-- <td>
                                    <form id="deleteForm_<?php echo $durableItem->durable_articles_id; ?>" method="POST" action="<?php echo route('durable.destroy', $durableItem->durable_articles_id) ?>" style="display:inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(<?php echo $durableItem->durable_articles_id; ?>)">Delete</button>
                                    </form>
                                </td> -->
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