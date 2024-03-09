@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Add Stock</div>

                <div class="card-body">
                    <form action="{{ route('stocks.store') }}" method="POST">
                        @csrf

                        @foreach($materials as $material)
                            {{ $material->name }}
                            <input type="number" name="{{ $material->id }}" value="0" min="0"> {{ $material->unit }}<br>
                        @endforeach
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection