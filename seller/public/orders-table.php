<section class="content-header">
    <h1>
        Orders /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    
</section>
<!-- Main content -->
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
                    <table id='products_table' class="table table-hover" data-toggle="table" data-search="true" data-url="get-bootstrap-table-data.php?table=orders" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-sort-name="orders.id" data-sort-order="desc"  data-export-types='["txt","excel"]'   >
                        <thead>
                            <tr>
                                <th data-field="operate" data-events="actionEvents">Action</th>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="date_created" data-sortable="true">Order Date</th>
                                <th data-field="product_id" data-sortable="true">Product ID</th>
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="quantity" data-sortable="true">Quantity</th>
                                <th data-field="delivery_charges" data-sortable="true">Delivery Charges</th>
                                <th data-field="buy_method" data-sortable="true">Buy Method</th>
                                <th data-field="status" data-sortable="true">Status</th>
                                <th data-field="update">Update</th>
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
    function queryParams_1(p) {
        return {
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>