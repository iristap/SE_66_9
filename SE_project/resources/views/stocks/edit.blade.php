@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-white " style="background-color: #492E87; font-size: 20px;">Edit Stock</div>
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                            </tr>
                            
                            @foreach($materials as $material)
                                <tr>
                                    <td>{{ $material->name }}</td>
                                    <td>
                                        <input type="number" name="material_id[{{ $material->name }}]" value="{{ $stockLists->where('material_id', $material->material_id)->first()->quantity ?? 0 }}" min="0">
                                    </td>
                                    <td>{{ $material->unit }}</td>
                                </tr>
                            @endforeach
                            
                        </table>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('material.index') }}" class="btn btn-secondary">กลับหน้าจัดการวัสดุ</a>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">กลับหน้าประวัติการStock</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
