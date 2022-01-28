@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <div class="item__alert">
        @if (session('message'))
            <div class="item__alert--success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="item__alert--danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="item__content">
        <div class="item__img-wrapper">
            <img class="item__img" alt="商品画像" src="{{ $item['image_url'] }}">
        </div>
        <div class="item__name">
            <h2>{{ $item['name'] }}</h2>
        </div>
        <div class="item__price">
            <p>¥{{ number_format($item['price']) }}</p>
        </div>
        <form class="form" action="/cart_items" method="post">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item['id'] }}">
            <div class="form__input--text">
                <input type="number" name="quantity" value="1" min="1"/>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">カートに追加する</button>
            </div>
        </form>
    </div>
@endsection
