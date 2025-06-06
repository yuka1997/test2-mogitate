@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}">
@endsection

@section('content')
<div class="update-form__container">
    <form class="update-form__form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="update-form__group">
            <label for="name" class="update-form__label">商品名</label>
            <input class="update-form__input" type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="update-form__group">
            <label for="price" class="update-form__label">値段</label>
            <input class="update-form__input" type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="update-form__group">
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
                @error('seasons')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="update-form__group">
            <label for="image" class="update-form__label"></label>
            <input class="update-form__input" type="file" name="image" id="image">
            @if($product->image)
                <div class="update-form__image-preview">
                    <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" class="update-form__current-image">
                </div>
            @endif
            <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="update-form__group">
            <label for="description" class="update-form__label">商品説明</label>
            <textarea class="update-form__textarea" name="description" id="description" rows="5">{{ old('description', $product->description) }}</textarea>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="update-form__button-group">
            <a href="{{ route('products.index') }}" class="update-form__back-button">戻る</a>
            <button type="submit" class="update-form__submit-button">変更を保存</button>
        </div>
    </form>

    <form class="update-form__delete-form" method="POST" action="{{ url('/products/' . $product->id . '/delete') }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="update-form__delete-button">削除する</button>
    </form>
</div>
@endsection
