@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/done.css')}}">
@endsection

@section('content')
<div class="box__container">
    <div class="box">
        <div class="box__body">
            <div class="box__content">ご予約ありがとうございます</div>
        </div>
        <div class="box__footer">
            <button class="box__button" type="submit">戻る</button>
        </div>
    </div>
</div>
@endsection