@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}" />
@endsection

@section('content')
<div class="unit__container">
    <span class="unit__ttl">商品一覧</span>
    <button class="unit__button" onclick="location.href='/products/register'">＋商品を追加</button>
</div>
<div class="content__container">
    <div class="side__container">
        <form class="form" action="/products/search" method="get">
            <div class="search__container">
                <input class="search-field" type="text" name="keyword" placeholder="商品名で検索">
                <button class="search-button">検索</button>
            </div>
            <div class="select__container">
                <span class="select__ttl">価格順で表示</span>
                <select class="select__field" name="" id="">
                    <option class="select__option--white" value="" hidden selected>価格で並べ替え</option>
                    <option class="select__option--black" value="1">高い順に表示</option>
                    <option class="select__option--black" value="2">低い順に表示</option>
                </select>
            </div>
        </form>
    </div>
    <div class="main__container">
        <div class="form__container">
            @foreach($products as $product)
            <form action="/products/{{$product->id}}" method="get">
            @csrf
                <div class="card">
                    <button type="submit">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}の画像">
                        <div class="card__txt">
                            <p>{{ $product->name }}</p>
                            <p>￥{{ $product->price}}</p>
                        </div>
                    </button>
                </div>
            </form>
            @endforeach
        </div>
        <div class="paginate">
            {{ $products->links() }}
        </div>
    </div>
</div>


@endsection