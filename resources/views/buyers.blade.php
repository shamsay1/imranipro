@extends('layout.app')

@section('content')
 <div class="content">

        <!-- USERS TABLE -->
{{-- <div class="box mt-4 p-2 bg-white shadow-sm rounded d-flex justify-content-end" style="width: 100%">
        <input class="form-control w-25" type="text" placeholder="Search...">
   
</div> --}}
         
<div class="box mt-4 p-3 bg-white shadow-sm rounded" style="width: 100%">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">All Users</h4>
    </div>
    <button class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
        + Add Seller
    </button>
    <!-- USER MODAL -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Seller</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" action="{{ route('buyers.store') }}">
        @csrf

        <div class="modal-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>First Name</label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Middle Name</label>
                    <input type="text" name="middlename" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Last Name</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Password</label>
                    <input type="password" name="password" value="12345" class="form-control" required>
                </div>

            </div>
                    <input type="hidden" name="role" value="seller">


        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save Buyer</button>
        </div>

      </form>

    </div>

  </div>
</div>
<br>

@if(session('success'))
<span style="color: green">{{ session('success') }}</span>
@endif
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle table-sm">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Created At</th>
                    <th class="text-center">Action</th>
                    
                </tr>
            </thead>

            <tbody>
                @forelse ($buyers as $index => $buyer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buyer->firstname }}</td>
                    <td>{{ $buyer->middlename }}</td>
                    <td>{{ $buyer->lastname }}</td>
                    <td>{{ $buyer->email }}</td>
                    <td>{{ $buyer->mobile }}</td>
                    <td>{{ $buyer->gender }}</td>
                    <td>{{ $buyer->created_at }}</td>
                    <td>
                         <button class="btn btn-sm btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#editUserModal"
        onclick="fillEditForm(
            '{{ $buyer->id }}',
            '{{ $buyer->firstname }}',
            '{{ $buyer->middlename }}',
            '{{ $buyer->lastname }}',
            '{{ $buyer->email }}',
            '{{ $buyer->mobile }}',
            '{{ $buyer->gender }}'
        )">
        Edit
    </button>
    <div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">
        <h5>Edit User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" id="editForm">
        @csrf
        @method('PUT')

        <div class="modal-body">

            <div class="row">

                <input type="hidden" id="edit_id">

                <div class="col-md-6 mb-2">
                    <label>First Name</label>
                    <input type="text" name="firstname" id="edit_firstname" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Middle Name</label>
                    <input type="text" name="middlename" id="edit_middlename" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Last Name</label>
                    <input type="text" name="lastname" id="edit_lastname" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Mobile</label>
                    <input type="text" name="mobile" id="edit_mobile" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Gender</label>
                    <select name="gender" id="edit_gender" class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>


            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div>
</div>
                    </td>

                </tr>
                    
                @empty
                <tr>
                    <td colspan="100" style="text-align: center">No data found</td>
                </tr>
                    
                @endforelse
            </tbody>

        </table>
    </div>

</div>
    </div>
    <script>
function fillEdit(id, firstname, middlename, lastname, email, mobile, gender)
{
    document.getElementById('edit_firstname').value = firstname;
    document.getElementById('edit_middlename').value = middlename;
    document.getElementById('edit_lastname').value = lastname;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_mobile').value = mobile;
    document.getElementById('edit_gender').value = gender;

    document.getElementById('editForm').action = "/buyers/" + id;
}
</script>
@endsection