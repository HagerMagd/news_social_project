
                                            <!-- Modal for edit -->
                                            {{-- start modal  --}}
                                            <div class="modal fade" id="admin-edit-{{ $admin->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update
                                                                admin Name
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editadminForm"
                                                                action="{{ route('admin.admin.update', $admin->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- admin Name -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">admin Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="adminName" placeholder="Enter admin name"
                                                                        value="{{ $admin->name }}" name="name">
                                                                    <!-- Buttons -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
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