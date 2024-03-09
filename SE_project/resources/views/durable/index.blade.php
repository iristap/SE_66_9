@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Durable Articles</title>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #dda0dd;">{{ __('ครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">หมายเลขครุภัณฑ์</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">แก้ไข</th>
                            <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                        <?php foreach ($durable as $durableItem): ?>
                            <tr>
                                <td><?php echo $durableItem->durable_articles_id ?></td>
                                <td><?php echo $durableItem->durable_articles_code ?></td>
                                <td><?php echo $durableItem->name ?></td>
                                <td><?php echo $durableItem->status ?></td>
                                <td>
                                    <button class='btn btn-outline-warning'>Edit</button>
                                </td>
                                <td>
                                    <form id="deleteForm_<?php echo $durableItem->durable_articles_id; ?>" method="POST" action="<?php echo route('durable.destroy', $durableItem->durable_articles_id) ?>" style="display:inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(<?php echo $durableItem->durable_articles_id; ?>)">Delete</button>
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
    function confirmDelete(id) {
        if (confirm("คุณต้องการลบรายการนี้หรือไม่?")) {
            document.getElementById('deleteForm_' + id).submit();
        }
    }
</script>