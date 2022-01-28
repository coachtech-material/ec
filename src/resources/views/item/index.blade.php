@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
    <div class="item__content">
        <div class="cards">
            @foreach ($items as $item)
                <a class="card" href="/items/{{ $item['id'] }}">
                    <div class="card__img-wrapper">
                        <img class="card__img" alt="商品画像" src="{{ $item['image_url'] }}">
                    </div>
                    <div class="card__body">
                        <h3 class="card__title">{{ $item['name'] }}</h3>
                        <p class="card__text">¥{{ number_format($item['price']) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
