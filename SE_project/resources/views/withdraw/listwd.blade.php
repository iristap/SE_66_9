@extends('layouts.app')

<head>
    <title>รายการเบิกวัสดุ</title>
</head>
@section('content')
    <div class ="container">
        <div class="card">
            <div class="card-body">
            <form method="POST" action="{}">
                @csrf
                @method('POST')
                <h4>รายการเบิกวัสดุ</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">จำนวน</th>

                        </tr>
                    </thead>
                    <tbody>
                         @foreach($selectedMaterials as $material)
                            <tr>

                                <td>{{ $material->material_id}}</td>
                                <td>{{ $material->name}}</td>
                                <td>{{ $material->amount}} {{ $material->unit}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer d-flex flex-row-reverse">
                    <a href="{{ route('withdraw.histwd') }}"><button type="button"
                            class="btn btn-outline-secondary">ยืนยัน</button></a>
                </div>
                </form>
            @endsection
