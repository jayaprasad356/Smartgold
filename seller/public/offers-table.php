<section class="content-header">
    <h1>
        Offers /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-offer.php"><i class="fa fa-plus-square"></i> Add Offers</a>
    </ol>
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
                    <table id='products_table' class="table table-hover" data-toggle="table" data-search="true" data-url="get-bootstrap-table-data.php?table=offers" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]'   >
                        <thead>
                            <tr>
                                <th data-field="operate" data-events="actionEvents">Action</th>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="valid_date" data-sortable="true">Offer Date</th>
                                <th data-field="gram_price" data-sortable="true">Discount Per Gram(₹)</th>
                                <th data-field="wastage" data-sortable="true">Discount On Wastage(%)</th>
                                <th data-field="max_locked" data-sortable="true">Maximum Locked Items</th>
                                
                                <th data-field="budget_range" >Budget Range</th>
                                <th data-field="total_locked_customers" >No. of Locked Customers</th>
                                
                                <th data-field="locked" data-events="actionEvents">Locked Customers</th>
                                <th data-field="status" >Status</th>
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