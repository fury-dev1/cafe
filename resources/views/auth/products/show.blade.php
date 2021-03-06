@extends('auth.layouts.master')

@section('title', 'Товар: ' . $product->name)

@section('content')
    <div class="col-md-12">
        <h5>Товар: {{ $product->name }}</h5>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id}}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td>
                    <img src="{{ Storage::url($product->image) }}" height="240px">
                </td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr>
                <td>Labels</td>
                <td>
                    @if($product->isNew())
                        <span class="badge bg-success">NEW</span>
                    @endif
                    @if($product->isSale())
                            <span class="badge bg-danger">SALE</span>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
