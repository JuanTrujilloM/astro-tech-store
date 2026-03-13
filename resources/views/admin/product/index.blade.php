@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Crear Nuevo Producto</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Precio:</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Stock:</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción:</label>
                    <textarea name="description" class="form-control" rows="2" required>{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">URL de la Imagen:</label>
                    <input type="text" name="image" class="form-control" value="{{ old('image') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Guardar Producto
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Listado de Productos</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewData['products'] as $product)
                        <tr>
                            <td>{{ $product->getId() }}</td>
                            <td>{{ $product->getName() }}</td>
                            <td>${{ number_format($product->getPrice(), 2) }}</td>
                            <td>{{ $product->getStock() }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.product.edit', $product->getId()) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.product.destroy', $product->getId()) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection