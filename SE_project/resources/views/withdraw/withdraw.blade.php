@extends('layouts.app')

<head>
    <title>การเบิกวัสดุ</title>
</head>
@section('content')
    <div class ="container">
        <div class="card">
            <div class="card-body">
                <form id="withdrawForm" method="POST" action="{{ route('withdraw.listwd') }}">
                    @csrf
                    @method('POST')
                    <h4>การเบิกวัสดุ</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">จำนวนที่มี</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col">เลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($material as $item)
                                <tr>

                                    <td>{{ $item->material_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->amount }} {{ $item->unit }}</td>
                                    <td></td>
                                    <td><input type="checkbox" class="form-check-input checkbox-center"
                                            name="material_id[]" value="{{$item->material_id}}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-outline-success p-2 ml-4">ยืนยัน</button>
                        </div>
                    </form>
                @endsection
