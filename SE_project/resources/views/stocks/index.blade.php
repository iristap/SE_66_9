@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white " style="background-color: #492E87; font-size: 20px;">Stock List</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <table class="table">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('stocks.create') }}">Add</a>
                        </div>
                        
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
                                    @php
                                        if($stock->stocker == null)
                                        {
                                            $stock->stocker = new App\Models\User;
                                            $stock->stocker->name = "ผู้ใช้ถูกลบ";
                                        }
                                    @endphp
                                    
                                    <td>{{ $stock->stocker->name }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('stocks.show',$stock->id) }}">Show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $stocks->links("pagination::bootstrap-4") }}
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{ route('material.index') }}">กลับหน้าจัดการวัสดุ</a>
                </div>
                
            </div>
            
        </div>
    </div>
    
</div>

@endsection