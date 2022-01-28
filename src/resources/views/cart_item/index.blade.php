@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart_item.css') }}">
@endsection

@section('content')
    <div class="cart-item__alert">
        @if (session('message'))
            <div class="cart-item__alert--success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="cart-item__alert--danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="cart-item__content">
        <div class="cart-item-table">
            <table class="cart-item-table__inner">
                <tr class="cart-item-table__row">
                    <th class="cart-item-table__header">
                        <span class="cart-item-table__header-span">商品名</span>
                        <span class="cart-item-table__header-span">単価</span>
                        <span class="cart-item-table__header-span">個数</span>
                    </th>
                </tr>
                @foreach ($cart_items as $cart_item)
                    <tr class="cart-item-table__row">
                        <td class="cart-item-table__item">
                            <form class="update-form" action="/cart_items/{{ $cart_item['id'] }}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="update-form__item">
                                    <p class="update-form__item-p">{{ $cart_item['item']['name'] }}</p>
                                </div>
                                <div class="update-form__item">
                                    <p class="update-form__item-p">¥{{ number_format($cart_item['item']['price']) }}</p>
                                </div>
                                <div class="update-form__item">
                                    <input class="update-form__item-input" type="number" name="quantity" value="{{ $cart_item['quantity'] }}">
                                </div>
                                <div class="update-form__button">
                                    <button class="update-form__button-submit" type="submit">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="cart-item-table__item">
                            <form class="delete-form" action="/cart_items/{{ $cart_item['id'] }}" method="post">
                                @method('DELETE')
                                @csrf
                                <div class="delete-form__button">
                                    <button class="delete-form__button-submit" type="submit">削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="cart-item__subtotal">
            <p>小計：¥{{ number_format($subtotal) }}</p>
        </div>
        <form action="/purchases" method="post">
            @csrf
            <div class="form__button">
                <button class="form__button-submit" type="submit">購入する</button>
            </div>
        </form>
    </div>
@endsection
