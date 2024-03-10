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
<div class="container">
    <a class="btn btn-primary" href="{{ route('stocks.create') }}">Add</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Stock List</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>id stock</th>
                                <th>วันที่</th>
                                <th>คนสต็อก</th>
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->id }}</td>
                                    <td>{{ $stock->date_stock }}</td>
                                    <td>{{ $stock->stocker->name }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('stocks.show',$stock->id) }}">Show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-secondary" href="{{ route('material.index') }}">Back</a>
</div>

@endsection