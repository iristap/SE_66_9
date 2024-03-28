@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>เบิกวัสดุ</title> -->
</head>

<body>
    <script>
        function decreaseValue(button) {
        var input = button.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > parseInt(input.min, 10)) {
            input.value = value - 1;
        }
    }

    function increaseValue(button) {
        var input = button.previousElementSibling;
        var value = parseInt(input.value, 10);
        if (value < parseInt(input.max, 10)) {
            input.value = value + 1;
        }
    }

        function validateForm() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var isChecked = false;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    isChecked = true;
                }
            });

            if (!isChecked) {
                alert('เลือกอย่างน้อย 1 ชิ้น');
                return;
            }

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var amountInput = checkbox.parentNode.previousElementSibling.querySelector('input[type="number"]');
                    if (parseInt(amountInput.value) > 0) {
                        isChecked = true;
                    } else {
                        alert('ไม่สามารถเลือกรายการที่มีจำนวนเป็น 0');
                        isChecked = false;
                    }
                }
            });

            if (isChecked) {
                document.getElementById('withdrawForm').submit();
            }
        }
    </script>

</html>
@section('content')
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #FF5BAE; font-size: 20px;">{{ __('รายการวัสดุ') }}</div>
                    <div class="card-body">
                        <form id="withdrawForm" method="POST" action="{{ route('withdraw.confirm_user') }}">
                            @csrf
                            @method('POST')
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text ">
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">รหัสวัสดุ</th>
                                        <th scope="col">ชื่อวัสดุ</th>
                                        <th scope="col">จำนวนที่มี</th>
                                        <th scope="col" style="padding-left: 30px;">จำนวน</th>
                                        <th scope="col">เลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($material as $index => $material)
                                    <tr class="text">
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $material->material_id }}</td>
                                        <td>{{ $material->name }}</td>
                                        <td>{{ $material->amount }} {{ $material->unit }}</td>

                                        <td>
                                            <style>input {
                                                text-align:center;
                                            }
                                            
                                            input::-webkit-outer-spin-button,
                                            input::-webkit-inner-spin-button {
                                                -webkit-appearance: none;
                                                -moz-appearance: none;
                                                appearance: none;
                                                margin: 0;
                                            }</style>

                                            <link media="all" rel="stylesheet" href="./style.css">

                                            <div>
                                                <button type="button" onclick="decreaseValue(this)">-</button>
                                                <input type="number" name="amount_selected[]" min="0" max="{{ $material->amount }}" value="0">
                                                <button type="button" onclick="increaseValue(this)">+</button>
                                            </div>
                                        </td>
                                        @if ($material->amount == 0)
                                            <td style="padding-left: 40px;"><input type="checkbox" class="form-check-input checkbox-center" name="material_id[]" value="{{ $material->material_id }}" disabled></td>
                                        @else
                                            <td style="padding-left: 40px;"><input type="checkbox" class="form-check-input checkbox-center" name="material_id[]" value="{{ $material->material_id }}" onchange="updateAmount(this.parentNode.previousElementSibling.querySelector('input[type=number]'), this.checked)"></td>
                                        @endif
                                    </tr>
                            @endforeach
                                    </tbody>
                            </table>
                            <div class="card-footer d-flex flex-row-reverse">
                                <button onclick="validateForm()" type="button"
                                    class="btn btn-success p-2 ml-4">ยืนยัน</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
