@extends('auth.layouts.master')

@section('title', 'Заказы')

@section('content')
    <div class="col-md-12">
        <h1>Заказы</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    ИМЯ
                </th>
                <th>
                    ТЕЛЕФОН
                </th>
                <th>
                    КОГДА ЗАКАЗАН
                </th>
                <th>
                    СУММА
                </th>
                <th>
                    ДЕЙСТВИЯ
                </th>
            </tr>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $order->getFullPrice() }}</td>f
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button" href="">Открыть</a>
                        </div>
                    </td>
                </tr>
                @endforeach
        </table>
{{--        {{ $orders->links() }}--}}

    </div>
@endsection
