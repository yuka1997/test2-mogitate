@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form__container">
    <h2 class="register-form__title">商品登録</h2>

    <form class="register-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="register-form__group">
            <label for="name" class="register-form__label">商品名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="register-form__input" placeholder="商品名を入力">
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="register-form__group">
            <label for="price" class="register-form__label">値段</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" class="register-form__input" placeholder="値段を入力">
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="register-form__group">
            <label for="image" class="register-form__label">商品画像</label>
            <input type="file" id="image" name="image" class="register-form__file">
            <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="register-form__group">
            <label class="register-form__label">季節</label>
            <div class="register-form__checkbox-group">
                @foreach ($seasons as $season)
                    <label class="register-form__checkbox-label">
                        <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
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

        <div class="register-form__group">
            <label for="description" class="register-form__label">商品説明</label>
            <textarea id="description" name="description" class="register-form__textarea" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="register-form__buttons">
            <a href="{{ route('products.index') }}" class="register-form__back-button">戻る</a>
            <button type="submit" class="register-form__submit-button">登録</button>
        </div>
    </form>
</div>
@endsection
