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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='products_table' class="table table-hover" data-search="true" data-toggle="table" data-query-params="queryParams_1" data-url="api/get-bootstrap-table-data.php?table=seller" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true"  data-side-pagination="server" data-pagination="true"  data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]' >
                            <thead>
                                <tr>
                                    <th data-field="operate" data-events="actionEvents">Action</th>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="date_created" data-sortable="true">Enrollment Date  <br> <small>(yyyy-mm-dd)</small></th>
                                    <th data-field="name" data-sortable="true">Name</th>
                                    <th data-field="store_name" data-sortable="true">Store Name</th>
                                    <th data-field="email" data-sortable="true">Email</th>
                                    <th data-field="mobile">Mobile</th>
                                
                                    <th data-field="store_url">Store URL</th>
                                    <th data-field="logo" >Logo</th>
                                    <th data-field="address_proof">Address Proof</th>
                                    <th data-field="national_identity_card">National Identity Card</th>
                                    <th data-field="store_description">Description</th>
                                    <th data-field="street">Street</th>
                                    <th data-field="pincode">Pincode</th>
                                    <th data-field="city">City</th>
                                    <th data-field="state">State</th>
                                    <th data-field="status" data-sortable="true">Status</th>
                                    
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
    $('#filter_user').on('change', function() {
        $('#user_table').bootstrapTable('refresh');

    });

    function queryParams_1(p) {
        return {
            "filter_user": $('#filter_user').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>