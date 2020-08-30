@extends('layout')
@section('content')
<style>
    ul.pagination {
        list-style-type: none;
        display: flex;
        justify-content: center;
    }
    ul.pagination > li {
        margin: 0 10px;
        font-size: 20px;
    }
</style>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>SKU</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Categories</th>
            <th>Link</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($goods as $good)
        <tr>
            <td>{{ $good->id }}</td>
            <td>{{ $good->sku }}</td>
            <td>{{ $good->name }}</td>
            <td>{{ $good->brand }}</td>
            <td>{{ implode('->', $good->categories) }}</td>
            <td><a href="{{ $good->link }}" target="_blank">shop</a></td>
            <td><a href="{{ route('good_item', ['good' => $good->id]) }}">more</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{ $goods->render() }}
</div>
@endsection
