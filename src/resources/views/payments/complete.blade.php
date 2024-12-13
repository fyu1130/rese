@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/payments/complete.css')}}">
@endsection

@section('content')
<div class="container">
    <h1>決済が完了しました！</h1>
    <p>支払金額: {{ number_format($amount) }}円</p>
    <a href="{{ route('payments.index') }}">戻る</a>
</div>
@endsection