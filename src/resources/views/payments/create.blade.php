@extends('layouts.app')

@section('content')
<div class="container">
    <h1>決済ページ</h1>
    <form action="{{ route('payments.charge', ['paymentId' => $payment->id]) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">決済を開始</button>
    </form>
</div>
@endsection