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
                                @foreach ($selectedMaterials as $maierial)
                                    <input type="hidden" name="material_id[]" value="{{ $maierial->material_id }}">
                                    <input type="hidden" name="status[]" value="{{ $maierial->status }}">
                                    <tr class="text-center">
                                        <td>{{ $maierial->material_id }}</td>
                                        <td>{{ $maierial->name }}</td>
                                        <td><span id="selectedAmount">{{ old('amount_selected', 0) }}</span></td>
                                        <td>{{ $maierial->unit }}</td>
                                    </tr>


                    </div>
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
