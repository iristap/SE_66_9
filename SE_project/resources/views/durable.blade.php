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
                <div class="card-header" style="background-color: #dda0dd;">{{ __('ครุภัณฑ์') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">หมายเลขครุภัณฑ์</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">สถานะ</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php 
                            foreach ($durable as $durableItem){
                                echo "<tr>
                                <td> $durableItem->durable_articles_id </td>
                                <td> $durableItem->durable_articles_code </td>
                                <td> $durableItem->name </td>
                                <td>$durableItem->status </td>
                                </tr>";
                            }
                        
                            

                    echo   "</tbody>";
                    echo "</table>";
                    ?>
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->
                    <!-- <button align="right" >SUBMIT</button> -->


                    <!-- <div style="width:100%;text-align:right;"><input type="button" value="BACK" class="btn btn-info"></div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection