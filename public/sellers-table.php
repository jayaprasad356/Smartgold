<section class="content-header">
    <h1>
        Sellers /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-seller.php"><i class="fa fa-plus-square"></i> Add New Seller</a>
    </ol>
    
</section>
<section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-xs-12">
                <div class="box">
                    <!-- <div class="col-xs-6"> -->
                    
                    <div class="box-header">
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Status</h4>
                            <select id="status" name="status" class='form-control'>
                                <option value="">Select</option>
                                <option value="0">Deactivate</option>
                                <option value="1">Approved</option>
                                <option value="2">Not-Approved</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Plan</h4>
                            <select id="plan" name="plan" class='form-control'>
                                            <option value="">Select Plan</option>
                                            <option value="free-trial">Free Trial</option>
                                            <option value="basic-monthly">Basic Monthly</option>
                                            <option value="deluxe-monthly">Deluxe Monthly</option>
                                            <option value="premium-monthly">Premium Monthly</option>
                                            <option value="basic-quarterly">Basic Quarterly</option>
                                            <option value="deluxe-quarterly">Deluxe Quarterly</option>
                                            <option value="premium-quarterly">Premium Quarterly</option>
                                            <option value="basic-annually">Basic Annually</option>
                                            <option value="deluxe-annually">Deluxe Annually</option>
                                            <option value="premium-annually">Premium Annually</option>
                                
                            </select>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='seller_table' class="table table-hover" data-toggle="table" data-search="true" data-url="api/get-bootstrap-table-data.php?table=seller" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]' >
                            <thead>
                                <tr>
                                    <th data-field="operate" data-events="actionEvents">Action</th>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="date_created" data-sortable="true">Enrollment Date  <br> <small>(yyyy-mm-dd)</small></th>
                                    <th data-field="name" data-sortable="true">Name</th>
                                    <th data-field="status" data-sortable="true">Status</th>
                                    <th data-field="store_name" data-sortable="true">Store Name</th>
                                    <th data-field="email" data-sortable="true">Email</th>
                                    <th data-field="mobile">Mobile</th>
                                    <th data-field="plan">Plan</th>
                                
                                    <th data-field="store_url" data-sortable="true">Store URL</th>
                                    <th data-field="logo" >Logo</th>
                                    <th data-field="address_proof">Address Proof</th>
                                    <th data-field="national_identity_card">National Identity Card</th>
                                    <th data-field="store_description">Description</th>
                                    <th data-field="street" data-sortable="true">Street</th>
                                    <th data-field="pincode" data-sortable="true">Pincode</th>
                                    <th data-field="city" data-sortable="true" >City</th>
                                    <th data-field="state" data-sortable="true">State</th>
                                    

                                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="separator"> </div>
        </div>
        <!-- /.row (main row) -->
    </section>
    <script>
    $('#status').on('change', function() {
        $('#seller_table').bootstrapTable('refresh');
    });
    $('#plan').on('change', function() {
        $('#seller_table').bootstrapTable('refresh');
    });
    
   
    

    function queryParams_1(p) {
        return {
            "plan": $('#plan').val(),
            "status": $('#status').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>
