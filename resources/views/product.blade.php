@extends('layout.app')

@section('content')
<div class="content">

<div class="box mt-4 p-3 bg-white shadow-sm rounded">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">All Products</h4>
    </div>

    <!-- ADD BUTTON -->
    <button class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#productModal">
        + Add Product
    </button>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- ================= ADD MODAL ================= -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Add Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body row">

                        <div class="col-md-6 mb-2">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Stock Quantity</label>
                            <input type="number" name="stock_quantity" class="form-control">
                        </div>

                        <div class="col-md-6 mb-2">
    <label>Category</label>
    <select name="category" class="form-control" required>
        <option value="">-- Select Category --</option>
        <option value="Electronics">Electronics</option>
        <option value="Clothes">Clothes</option>
        <option value="Shoes">Shoes</option>
        <option value="Food">Food</option>
        <option value="Furniture">Furniture</option>
        <option value="Accessories">Accessories</option>
        <option value="Books">Books</option>
        <option value="Beauty">Beauty</option>
        <option value="Sports">Sports</option>
    </select>
</div>

                        <div class="col-md-12 mb-2">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ================= TABLE ================= -->
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($products as $key => $product)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->status }}</td>

                <td>
                    <button class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal"
                        onclick="fillEdit(
                            '{{ $product->id }}',
                            '{{ $product->product_name }}',
                            '{{ $product->price }}',
                            '{{ $product->stock_quantity }}',
                            '{{ $product->category }}',
                            `{{ $product->description }}`
                        )">
                        Edit
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<!-- ================= EDIT MODAL ================= -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">
        <h5>Edit Product</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" id="editForm">
        @csrf
        @method('PUT')

        <div class="modal-body row">

            <input type="hidden" id="edit_id">

            <div class="col-md-6 mb-2">
                <label>Name</label>
                <input type="text" name="product_name" id="edit_name" class="form-control">
            </div>

            <div class="col-md-6 mb-2">
                <label>Price</label>
                <input type="number" name="price" id="edit_price" class="form-control">
            </div>

            <div class="col-md-6 mb-2">
                <label>Stock</label>
                <input type="number" name="stock_quantity" id="edit_stock" class="form-control">
            </div>

            <div class="col-md-6 mb-2">
                <label>Category</label>
                <input type="text" name="category" id="edit_category" class="form-control">
            </div>

            <div class="col-md-12 mb-2">
                <label>Description</label>
                <textarea name="description" id="edit_description" class="form-control"></textarea>
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div>
</div>

</div>

<!-- ================= JS ================= -->
<script>
function fillEdit(id, name, price, stock, category, description)
{
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_stock').value = stock;
    document.getElementById('edit_category').value = category;
    document.getElementById('edit_description').value = description;

    document.getElementById('editForm').action = "/products/" + id;
}
</script>

@endsection