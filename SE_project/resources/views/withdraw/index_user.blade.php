@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เบิกวัสดุ</title>
</head>

<body>
    <script>
        function validateForm() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var isChecked = false;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    isChecked = true;
                }
            });

            if (isChecked) {
                document.getElementById('disbursementForm').submit();
            } else {
                alert('กรุณาเลือกอย่างน้อยหนึ่งรายการ');
            }
        }
        // function validateForm() {
        //     var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        //     var isChecked = false;

        //     checkboxes.forEach(function(checkbox) {
        //         if (checkbox.checked) {
        //             isChecked = true;
        //         }
        //     });

        //     if (isChecked) {
        //         document.getElementById('withdrawForm').submit();
        //     } else {
        //         alert('กรุณาเลือกอย่างน้อยหนึ่งรายการ');
        //     }
        // }
    </script>

</html>
@section('content')
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('รายการวัสดุ') }}</div>
                    <div class="card-body">
                        <form id="withdrawForm" method="POST" action="{{ route('withdraw.confirm_user') }}">
                            @csrf
                            @method('POST')
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">รหัสวัสดุ</th>
                                        <th scope="col">ชื่อวัสดุ</th>
                                        <th scope="col">จำนวนที่มี</th>
                                        <th scope="col">จำนวน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($material as $index => $material)
                                        <tr class="text-center">
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
                                                  <button type="button" onclick="this.parentNode.querySelector('[type=number]').stepDown();">
                                                    -
                                                  </button>
                                                  
                                                  <!-- <input type="number" name="amount_selected" min="0" max="{{ $material->amount }}" value="0"> -->
                                                  <input type="number" name="amount_selected[]" min="0" max="{{ $material->amount }}" value="0">

                                                  
                                                
                                                  <button type="button" onclick="this.parentNode.querySelector('[type=number]').stepUp();">
                                                    +
                                                  </button>
                                                </div>
                                            </td>
                                            @if ($material->amount == 0)
                                                <td><input type="checkbox" class="form-check-input checkbox-center" name="material_id[]" value="{{ $material->material_id }}" disabled></td>
                                            @else
                                                <td><input type="checkbox" class="form-check-input checkbox-center" name="material_id[]" value="{{ $material->material_id }}"></td>
                                            @endif
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
                            <div class="card-footer d-flex flex-row-reverse">
                                <button onclick="validateForm()" type="submit"
                                    class="btn btn-outline-success p-2 ml-4">ยืนยัน</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
