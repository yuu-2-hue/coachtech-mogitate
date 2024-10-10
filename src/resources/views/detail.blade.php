@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="content__container">
    <p>商品一覧 > {{$product->name}}</p>
    <form class="form" action="/products/{{$product->id}}/update" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form__container">
            <div class="item__left">
                <div class="form__item">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="file" name="image">
                    <div class="error">
                        @error('image') {{ $message }} @enderror
                    </div>
                </div>
            </div>
            <div class="item__right">
                <div class="form__item">
                    <div class="ttl__container">
                        <span class="item__ttl">商品名</span>
                    </div>
                    <input class="item__text" type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                    <div class="error">
                        @error('name') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form__item">
                    <div class="ttl__container">
                        <span class="item__ttl">値段</span>
                    </div>
                    <input class="item__text" type="text" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                    <div class="error">
                        @error('price') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form__item">
                    <div class="ttl__container">
                        <span class="item__ttl">季節</span>
                    </div>
                    @foreach($seasons as $season)
                    <input class="item__season" id="{{$season->name}}" type="checkbox" name="season[]" value="{{$season->id}}"
                        @foreach($product->seasons as $ps)
                            @if(is_array(old('season')) && in_array($season->id, old('season'))) checked
                            @elseif(!is_array(old('season')) && $season->id == $ps->pivot->season_id) checked
                            @endif
                        @endforeach
                        <label for="{{$season->name}}">{{$season->name}}</label>
                    @endforeach
                    <div class="error">
                        @error('season') {{ $message }} @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form__item">
            <div class="ttl__container">
                <span class="item__ttl">商品説明</span>
            </div>
            <textarea class="item__detail" name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
            <div class="error">
                @error('description') {{ $message }} @enderror
            </div>
        </div>

        <div class="form__buttons">
            <a class="return__button" type="submit" href="/products">戻る</a>
            <button class="entry__button" type="submit" name="action" value="update">変更を保存</button>
        </div>
    </form>

    <form class="form__delete" action="/products/{{$product->id}}/delete?id={{$product->id}}" method="post">
    @csrf
        <button class="delete__button" type="submit" name="action" value="delete">削除</button>
    </form>
</div>
@endsection