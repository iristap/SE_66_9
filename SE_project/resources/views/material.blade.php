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
                <div class="card-header" style="background-color: #dda0dd;">{{ __('วัสดุ') }}</div>

                <div class="card-body">
                    <a class="btn btn-success" > เติมสต๊อก </a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">หน่วยนับ</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php 
                            foreach ($material as $materialItem){
                                echo "<tr>
                                <td> $materialItem->material_id  </td>
                                <td> $materialItem->name</td>
                                <td> $materialItem->amount </td>
                                <td> $materialItem->unit </td>
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