@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/reviews-create.css')}}">
@endsection

@section('content')
<div class="reviews-create">
    <h1 class="reviews-create__title">{{ $shop->shop_name }} のレビュー</h1>
    <form action="{{ route('reviews.store', $shop) }}" method="POST" class="reviews-create__form">
        @csrf
        <div class="form-group">
            <label for="rating" class="form-label">評価（1～5）:</label>
            <select name="rating" id="rating" required class="form-select">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        @error('rating')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="comment" class="form-label">コメント:</label>
            <textarea name="comment" id="comment" rows="4" maxlength="500" class="form-input"></textarea>
        </div>
        @error('comment')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">レビューを投稿</button>
    </form>
</div>
@endsection