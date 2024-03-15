@extends('layouts.app')

<head>
    <title>รายการเบิกวัสดุ</title>
</head>
@section('content')
    <div class ="container">
        <div class="card">
            <div class="card-body">
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
                        @foreach ($disbursement_detail as $item)
                            <tr>

                                <td>{{ $item->disbursement_id}}</td>
                                <td>{{ $item->material_id}}</td>
                                <td>{{ $item->amount}} {{ $item->unit }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer d-flex flex-row-reverse">
                    <a href="{{ route('withdraw.histwd') }}"><button type="button"
                            class="btn btn-outline-secondary">ยืนยัน</button></a>
                </div>
            @endsection
