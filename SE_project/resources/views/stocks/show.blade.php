@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white " style="background-color: #492E87; font-size: 20px;">Stock Details</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>ID Stock</td>
                                <td>{{ $stock->id }}</td>
                            </tr>
                            <tr>
                                <td>วันที่</td>
                                <td>{{ $stock->date_stock }}</td>
                            </tr>
                            <tr>
                            @php
                                if($stock->stocker == null)
                                {
                                    $stock->stocker = new App\Models\User;
                                    $stock->stocker->name = "ผู้ใช้ถูกลบ";
                                }
                            @endphp
                                <td>คนสต็อก</td>
                                <td>{{ $stock->stocker->name }}</td>
                            </tr>
                            <tr>
                                <td>Stock Lists</td>
                                <td>
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>วัสดุ</th>
                                                <th>จำนวน</th>
                                                <th>หน่วยนับ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stockLists as $stockList)
                                                @if ($stockList->quantity > 0)
                                                    <tr>
                                                        <td>{{ $stockList->material->name }}</td>
                                                        <td>{{ $stockList->quantity }}</td>
                                                        <td>{{ $stockList->material->unit }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('stocks.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
