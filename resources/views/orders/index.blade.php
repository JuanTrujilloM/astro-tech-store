@extends('layout.app')

@section('title', 'Order Creation - Order Computing Store')
@section('subtitle', 'Create a new order')

@section('content')
<div class="orders-section">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create order</div>
        <div class="card-body">
          @if($errors->any())
            <ul id="errors" class="alert alert-danger list-unstyled">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div class="mb-3">
              <label for="total" class="form-label">Total</label>
              <input type="number" step="0.01" min="0" class="form-control" id="total" name="total" placeholder="0.00" value="{{ old('total') }}" />
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" id="status" name="status">
                <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>
            <div class="mb-3 form-check">
              <input type="hidden" name="can_be_cancelled" value="0" />
              <input type="checkbox" class="form-check-input" id="can_be_cancelled" name="can_be_cancelled" value="1" {{ old('can_be_cancelled', true) ? 'checked' : '' }} />
              <label class="form-check-label" for="can_be_cancelled">Can be cancelled</label>
            </div>
            <div class="mb-3">
              <label for="created_at" class="form-label">Created at</label>
              <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="{{ old('created_at') }}" />
              <small class="text-muted">Optional. If left empty, the current date and time will be used.</small>
            </div>
            <div class="mb-3">
              <label for="updated_at" class="form-label">Updated at</label>
              <input type="datetime-local" class="form-control" id="updated_at" name="updated_at" value="{{ old('updated_at') }}" />
              <small class="text-muted">Optional. If left empty, the current date and time will be used.</small>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
            <a href="{{ route('orders.list') }}" class="btn btn-outline-secondary">Ver lista</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
