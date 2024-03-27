@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการเบิกวัสดุ</title>
</head>

<body>
</body>
</body>

</html>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">รายการเบิกวัสดุ</div>
                    <div>
                        <form method="POST" action="{{ route('withdraw.store_user') }}">
                            @csrf
                            @method('POST')
                            <br>
                            <p class="col">วันที่เบิก: {{ date('Y-m-d') }}</p>
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">รหัสวัสดุ</th>
                                        <th scope="col">ชื่อวัสดุ</th>
                                        <th scope="col">จำนวน</th>
                                    </tr>
                                </thead>
                                @foreach ($selectedMaterials as $index => $material)
                                    <input type="hidden" name="material_id[]" value="{{ $material->material_id }}">
                                    <input type="hidden" name="status[]" value="{{ $material->status }}">
                                    <tr class="text-center">
                                        <td>{{ $material->material_id }}</td>
                                        <td>{{ $material->name }}</td>
                                        <td>
                                            @php
                                                $selectedAmount = isset($nonZeroAmounts[$index]) ? $nonZeroAmounts[$index] : 0;
                                            @endphp
                                            {{ $selectedAmount }}
                                        </td>
                                        <td>{{ $material->unit }}</td>
                                    </tr>
                                @endforeach
                            </table>
                    <div class="container">
                        <p>เหตุผลในการเบิก:</p>
                        <input type="text" name="note_disbursement" class="form-control" required>
                    </div>
                    <div class="card-footer d-flex flex-row-reverse">
                        <a href="{{ route('withdraw.index_user') }}" class="btn btn-outline-primary p-2 ml-4">ยกเลิก</a>
                        <button onclick="validateForm()" class="btn btn-outline-success p-2 ml-4"
                            type="submit">ยืนยัน</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
