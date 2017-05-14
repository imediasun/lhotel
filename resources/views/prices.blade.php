@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Цены установлены</div>

                <div class="panel-body">
                    <a href="/admin/rooms_prices">Установить цены еще</a><br>
                    <a href="/admin">Переход в админ часть</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
