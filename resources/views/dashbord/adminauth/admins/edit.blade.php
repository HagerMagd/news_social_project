<!-- Modal for edit -->
{{-- start modal  --}}
<div class="modal fade" id="admin-edit-{{ $admin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update 
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editadminForm" action="{{ route('admin.admin.update', $admin->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    
                    <!-- Admin Name -->
                    <div class="mb-3">
                        <label class="form-label">Admin Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $admin->name }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin user Name</label>
                        <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                            name="user_name" value="{{ $admin->user_name }}">

                        @error('user_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin Password </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" value="{{ $admin->password }}">

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{$admin->email }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <!-- Admin Status -->
                    <div class="mb-4">
                        <label class="form-label">Admin Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status">

                            <option disabled selected>Choose status</option>
                            <option value="1" @selected($admin->status ==1 )>Active</option>
                            <option value="0" @selected($admin->status ==0 )>Not Active</option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Admin permissions -->
                    <div class="mb-4">
                        <label class="form-label">Admin permissions</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="role_id">

                            <option disabled selected>Choose permissions</option>
                            @forelse ($authorizations as $authorization)
                                <option value="{{ $authorization->id }}" @selected($admin->role_id == $authorization->id )>{{ $authorization->role }}</option>
                            @empty
                                <option disabled selected> No Roles </option>
                            @endforelse



                        </select>

                        @error('role_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Modal  -->
