@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}">
@endsection

@section('content')
<div class="update-form__container">
    @if(isset($product))
        <p class="breadcrumb">商品一覧 &gt; {{ $product->name }}</p>
    @endif

    <form id="update-form" class="update-form__form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="update-form__group--top">
            <div class="update-form__group--image">
                <label for="image" class="update-form__label"></label>
                @if($product->image)
                    <div class="update-form__image-preview">
                        <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" class="update-form__current-image">
                    </div>
                @endif
                <input class="update-form__input--image" type="file" name="image" id="image">
                <div class="form__error">
                    @error('image') {{ $message }} @enderror
                </div>
            </div>

            <div class="update-form__info-box">
                <div class="update-form__group--info">
                    <label for="name" class="update-form__label">商品名</label>
                    <input class="update-form__input" type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
                    <div class="form__error">
                        @error('name') {{ $message }} @enderror
                    </div>
                </div>

                <div class="update-form__group--info">
                    <label for="price" class="update-form__label">値段</label>
                    <input class="update-form__input" type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
                    <div class="form__error">
                        @error('price') {{ $message }} @enderror
                    </div>
                </div>

                <div class="update-form__group--info">
                    <label class="update-form__label">季節</label>
                    <div class="update-form__checkbox-group">
                        @foreach ($seasons as $season)
                            <label class="update-form__checkbox-label">
                                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                    {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                    <div class="form__error">
                        @error('seasons') {{ $message }} @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="update-form__group">
            <label for="description" class="update-form__label">商品説明</label>
            <textarea class="update-form__textarea" name="description" id="description" rows="5">{{ old('description', $product->description) }}</textarea>
            <div class="form__error">
                @error('description') {{ $message }} @enderror
            </div>
        </div>

        <div class="update-form__button-group">
            <a href="{{ route('products.index') }}" class="update-form__back-button">戻る</a>
            <button type="submit" class="update-form__submit-button">変更を保存</button>
        </div>
    </form>

    <form method="POST" action="{{ url('/products/' . $product->id . '/delete') }}" class="update-form__delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="update-form__delete-button">
            <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="currentColor" d="M160 400c0 8.8-7.2 16-16 16s-16-7.2-16-16V208c0-8.8
            7.2-16 16-16s16 7.2 16 16v192zm80 0c0 8.8-7.2 16-16
            16s-16-7.2-16-16V208c0-8.8 7.2-16 16-16s16 7.2 16
            16v192zm64-16c8.8 0 16-7.2 16-16V208c0-8.8-7.2-16-16-16s-16
            7.2-16 16v160c0 8.8 7.2 16 16 16zm120-288h-88l-34-56c-5.9-9.8-16.4-16-28-16H134c-11.6
            0-22.1 6.2-28 16l-34 56H16C7.2 96 0 103.2 0
            112s7.2 16 16 16h16l21.2 339.2C54.3 494.1 75.7 512 100.1
            512h247.7c24.4 0 45.8-17.9 46.9-44.8L416
            128h16c8.8 0 16-7.2 16-16s-7.2-16-16-16zM171.8
            48h104.4l19.2 32H152.6l19.2-32z" />
            </svg>
        </button>
    </form>
</div>
@endsection