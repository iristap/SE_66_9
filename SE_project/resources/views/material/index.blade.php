@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material</title>
    <style>
    .button {
    background-color: #37B5B6; /* Green */
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.2s;
    cursor: pointer;
    }

    .button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #37B5B6;
    }

    .button1:hover {
    background-color: #37B5B6;
    color: white;
    }
    </style>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white " style="background-color: #492E87; font-size: 20px; ">{{ __('วัสดุ') }}</div>

                <div class="card-body">
                    <a class="button button1 rounded" > เติมสต๊อก </a>
                    <br>
                    <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">หน่วยนับ</th>
                            <th scope="col">แก้ไข</th>
                            <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                        <?php foreach ($material as $materialItem): ?>
                            <tr>
                                <td><?php echo $materialItem->material_id ?></td>
                                <td><?php echo $materialItem->name ?></td>
                                <td><?php echo $materialItem->amount ?></td>
                                <td><?php echo $materialItem->unit ?></td>
                                <td>
                                    <a href="#" class='btn btn-outline-warning'>Edit</a>
                                </td>
                                <td>
                                    <form id="deleteForm_<?php echo $materialItem->material_id; ?>" method="POST" action="<?php echo route('material.destroy', $materialItem->material_id) ?>" style="display:inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(<?php echo $materialItem->material_id; ?>)">Delete</button>
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