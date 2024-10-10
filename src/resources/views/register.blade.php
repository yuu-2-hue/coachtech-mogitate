@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content__container">
    <p class="ttl">商品登録</p>
    <div class="form__container">
        <form class="form" action="/products/register" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form__item">
                <div class="ttl__container">
                    <span class="item__ttl">商品名</span>
                    <span class="item__alert">必須</span>
                </div>
                <input class="item__text" type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
                <div class="error">
                    @error('name') {{ $message }} @enderror
                </div>
            </div>
            <div class="form__item">
                <div class="ttl__container">
                    <span class="item__ttl">値段</span>
                    <span class="item__alert">必須</span>
                </div>
                <input class="item__text" type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
                <div class="error">
                    @error('price') {{ $message }} @enderror
                </div>
            </div>
            <div class="form__item">
                <div class="ttl__container">
                    <span class="item__ttl">商品画像</span>
                    <span class="item__alert">必須</span>
                </div>
                @livewire('component-preview')
                <div class="error">
                    @error('image') {{ $message }} @enderror
                </div>
            </div>
            <div class="form__item">
                <div class="ttl__container">
                    <span class="item__ttl">季節</span>
                    <span class="item__alert">必須</span>
                </div>
                @foreach($seasons as $season)
                <input class="item__season" id="{{$season->name}}" type="checkbox" name="season[]" value="{{$season->id}}"
                {{ is_array(old('season')) && in_array($season->id, old('season')) ? 'checked=checked' : '' }} />
                    <label for="{{$season->name}}">{{$season->name}}</label>
                @endforeach
                <div class="error">
                    @error('season') {{ $message }} @enderror
                </div>
            </div>
            <div class="form__item">
                <div class="ttl__container">
                    <span class="item__ttl">商品説明</span>
                    <span class="item__alert">必須</span>
                </div>
                <textarea class="item__detail" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <div class="error">
                    @error('description') {{ $message }} @enderror
                </div>
            </div>
            <div class="form__buttons">
                <a class="return__button" type="submit" href="/products">戻る</a>
                <button class="entry__button" type="submit" name="action" value="entry">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection