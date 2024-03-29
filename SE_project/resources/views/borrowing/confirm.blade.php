@ -15,22 +15,32 @@
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #FC6736;">Borrowing Detail</div>
                <div>

                <form method="POST" action="{{ route('borrowing.store') }}">
        @csrf
        @method('POST')
    <h1 class="col">การยืมครุภัณฑ์</h1>
    <p class="col">ผู้ขอเบิก: {{ $user->name }} </p>
    <p class="col">วันที่ยืม: {{ date('Y-m-d') }}</p>
        @foreach($selectedDurables as $durable)
        <input type="hidden" name="durable_articles_id[]" value="{{ $durable->durable_articles_id }}">
        <input type="hidden" name="status[]" value="{{ $durable->status }}">
        <ul>
        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
        {{ $durable->durable_articles_id }}
        {{ $durable->durable_articles_code}}
        {{ $durable->name }}
        <p>เหตุผลในการยืม:</p>
        <input type="text" name="borrowing_note" class="form-control" required>
        </div>
        </div>
        </ul>
        @endforeach
    </ul>
    <div class="card-footer d-flex flex-row-reverse">

     <a href="{{ route('borrowing.index') }}" class="btn btn-outline-primary p-2 ml-4">ยกเลิก</a>
        <button class="btn btn-outline-success p-2 ml-4" type="submit">ยืนยัน</button>
     </div>
    </form>
