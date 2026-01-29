<form action="{{ route('admin.users.index') }} " method="GET">
            @csrf
            <div class="row mb-3">

                <!-- Sort By -->
                <div class="col-md-2">
                    <select class="form-control" id="sort_by" name="sort_by">
                        <option value="" selected disabled>Sort By</option>
                        <option value="id">Id</option>
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                    </select>
                </div>

                <!-- Order -->
                <div class="col-md-2">
                    <select class="form-control" id="order_by" name="order_by">
                        <option value="" selected disabled>Order By</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>

                <!-- Show Entries -->
                <div class="col-md-2">
                    <select class="form-control" id="show_entries" name="limit_by">
                        <option value="" selected disabled>Limit</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-2">
                    <select class="form-control" id="status" name="status">
                        <option value="" selected disabled>Status</option>
                        <option value="">All</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="col-md-3">
                    <input type="text" id="search" class="form-control" placeholder="Search Here" name="keyword">
                </div>

                <!-- Button -->
                <div class="col-md-1">
                    <button class="btn btn-primary w-100" id="searchBtn">
                        Search
                    </button>
                </div>

            </div>

        </form>