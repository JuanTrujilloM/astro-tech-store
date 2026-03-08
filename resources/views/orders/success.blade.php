@extends('layout.app')

@section('title', 'Order Created - Order Computing Store')
@section('subtitle', 'Order created')

@section('content')
<div class="orders-section">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="alert alert-success text-center py-4" role="alert">
        <h4 class="alert-heading mb-0">Order created successfully.</h4>
      </div>
      <div class="text-center">
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Create another order</a>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
