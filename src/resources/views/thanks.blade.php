@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/thanks.css')}}">
@endsection

@section('content')
<div class="box__container">
    <div class="box">
        <div class="box__body">
            <div class="box__content">会員登録ありがとうございます</div>
        </div>
        <div class="box__footer">
            <button class="box__button" type="submit">ログインする</button>
        </div>
    </div>
</div>
@endsection