<div>

    <!-- products Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-a-0 m-t-xs">Products (<span id="prod_count"></span>)</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="search" id="prod_search" placeholder="Product Search..." />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <livewire:datatable
                model="App\Product"
                with="admins, admins.name"
                name="products_list"
                include="id, name, category, price, published_by, created_at"
                dates="dob"
            />
            <!--
            <-- DataTables init on table by adding .js-dataTable-simple class, functionality initialized in js/pages/base_tables_datatables.js --
            <table id="ProductsTable" class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Status</th>
                        <th class="text-center hidden-xs">Published By</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Last Update</th>
                        <th class="text-center" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                   
                   
                </tbody>
            </table>
            -->
        </div>
        <!-- .card-block -->

        <!--
        <div class="text-center">
            
        </div>
        -->
    </div>
    <!-- End Categorie Table -->

</div>
