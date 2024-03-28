@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Borrowing</title> -->
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
            document.getElementById('borrowingForm').submit();
        } else {
            alert('กรุณาเลือกอย่างน้อยหนึ่งรายการ');
        }
    }
</script>
</html>
@section('content')
<div class ="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{__('การยืมครุภัณฑ์') }}</div>
                <div class="card-body">
                    @if ($durables->isEmpty())
                        ไม่มีครุภัณฑ์ให้ยืม
                    @else
                    <form id="borrowingForm" method="POST" action="{{ route('borrowing.confirm_user') }}">
                        @csrf
                        @method('POST')
                        <table class="table table-striped">
                            <thead>
                                <tr class="text">
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รหัสครุภัณฑ์</th>
                                    <th scope="col">ครุภัณฑ์</th>
                                    <th scope="col" >เลือก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($durables as $index => $durable)
                                <tr class="text">
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td>{{ $durable->durable_articles_code }}</td>
                                    <td>{{ $durable->name }}</td>
                                    <td style="padding-left: 40px;"><input type="checkbox" class="form-check-input checkbox" name="durable_articles_id[]" value="{{ $durable->durable_articles_id }}"></td>
                                </tr>           
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer d-flex flex-row-reverse">
                            <button onclick="validateForm()" type="submit" class="btn btn-success p-2 ml-4">ยืนยัน</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection