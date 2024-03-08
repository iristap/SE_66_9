@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: #f9ffc2;">

</body>
</html>
@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #dda0dd;">{{ __('รายการส่งซ่อมครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">รหัสครุภัณฑ์</th>
                            <th scope="col">ครุภัณฑ์</th>
                            <th scope="col">ผู้ตรวจคืน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php 
                            foreach ($repair as $repairItem){
                                echo "<tr>
                                <td> $repairItem->no </td>
                                <td> $repairItem->durable_articles_id </td>
                                <td> $repairItem->durable_articles_name </td>
                                <td> $repairItem->inspector_name </td>
                                <td> $repairItem->status </td>
                                <td> $repairItem->detail </td>
                                </tr>";
                            }
                    echo   "</tbody>";
                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection