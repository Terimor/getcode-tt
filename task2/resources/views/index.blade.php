@extends('layout')
@section('content')
<h3>
    Enter any link of category page or good page from <a href="https://brain.com.ua/">this</a> shop
</h3>
<form method="post">
    @csrf
    <input type="text" name="link" placeholder="https://brain.com.ua/..."/>
    <input type="submit" value="Submit">
    @if (request()->session()->has('message'))
    <div class="message">{{ request()->session()->get('message') }}</div>
    @endif
</form>
@endsection
