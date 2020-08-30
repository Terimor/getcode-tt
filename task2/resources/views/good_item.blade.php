@extends('layout')
@section('content')
<div>
    SKU - {{ $good->sku }}
</div>
<div>
    Name - {{ $good->name }}
</div>
<div>
    Brand - {{ $good->brand }}
</div>
<div>
    Categories - {{ implode('->', $good->categories) }}
</div>
<div>
    @foreach($good->images as $image)
    <img src="{{ $image }}" alt="good image"/>
    @endforeach
</div>
@endsection
