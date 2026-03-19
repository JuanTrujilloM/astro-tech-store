@extends('layouts.app')
@section('title', __('messages.cart.purchase_title') . ' - ' . __('messages.layout.title_default'))
@section('subtitle', __('messages.cart.purchase_subtitle'))
@section('content')
<div class="card">
    <div class="card-header">
        {{ __('messages.cart.purchase_completed') }}
    </div>
    <div class="card-body">
        <div class="alert alert-success" role="alert">
            {{ __('messages.cart.purchase_success', ['order' => '#' . $viewData['order']->getId()]) }}
        </div>
    </div>
</div>
@endsection