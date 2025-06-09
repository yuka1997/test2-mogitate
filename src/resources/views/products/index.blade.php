@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="product-list__container">
    <div class="product-list__header">
        <h2 class="product-list__title">
            @if(request('keyword'))
                "{{ request('keyword') }}"の商品一覧
            @else
                商品一覧
            @endif
        </h2>
        <a href="{{ route('products.register') }}" class="product-list__add-button">+ 商品を追加</a>
    </div>

    <div class="product-list__body">
        <form method="GET" action="{{ route('products.search') }}"  class="product-search__form">
            <div class="product-search__input-group">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索" class="product-search__input">
            </div>
            <div class="product-search__controls">
                <button type="submit" class="product-search__submit-button">検索</button>
                <h2 class="product-search__sort-title">価格順で表示</h2>
                <select name="sort" onchange="this.form.submit()" class="product-search__sort-select">
                    <option value="">価格で並び替え</option>
                    <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>低い順に表示</option>
                </select>
            </div>
        </form>

        @if(request('sort'))
            <div class="product-sort__tag-wrapper">
                <span class="product-sort__tag">
                    {{ request('sort') == 'high' ? '高い順に表示' : '低い順に表示' }}
                    @php
                        $query = request()->except('sort');
                    @endphp
                    <a href="{{ route('products.search', $query) }}" class="product-sort__tag-remove">&times;</a>

                </span>
            </div>
        @endif

        <div class="product-grid">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-card">
                    <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-card__image">
                    <div class="product-card__body">
                        <h2 class="product-card__name">{{ $product->name }}</h2>
                        <p class="product-card__price">&yen;{{ number_format($product->price) }}</p>
                    </div>
                </a>
            @empty
                <p class="product-list__empty-message">商品が見つかりませんでした。</p>
            @endforelse
        </div>
    </div>
    <div class="product-pagination">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
