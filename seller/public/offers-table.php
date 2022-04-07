<section class="content-header">
    <h1>
        Offers /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-offer.php"><i class="fa fa-plus-square"></i> Add Offer</a>
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
                    <table id='products_table' class="table table-hover" data-toggle="table" data-url="get-bootstrap-table-data.php?table=offers" data-page-list="[5, 10, 20, 50, 100, 200]"  data-side-pagination="server" data-pagination="true"  data-query-params="queryParams"   >
                        <thead>
                            <tr>
                                <th data-field="operate" data-events="actionEvents">Action</th>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="valid_date" data-sortable="true">Offer Date</th>
                                <th data-field="seller_id" data-sortable="true">Seller ID</th>
                                <th data-field="gram_price" data-sortable="true">Price Per Gram</th>
                                <th data-field="wastage" data-sortable="true">Wastage</th>
                                <th data-field="max_locked" data-sortable="true">Max Locked</th>
                                <th data-field="status" data-sortable="true">Status</th>
                                <th data-field="budget_range" data-sortable="true">Budget Range</th>
                                
                                <th data-field="locked" data-events="actionEvents">Locked Customers</th>
                                <!-- <th data-field="operate" data-events="actionEvents">Action</th> -->
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
    function queryParams(p) {
        return {
            "category_id": $('#category_id').val(),
            "is_approved": $('#is_approved').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>
<script>
    $('#category_id').on('change', function() {
        id = $('#category_id').val();
        $('#products_table').bootstrapTable('refresh');
    });
    $('#is_approved').on('change', function() {
        id = $('#is_approved').val();
        $('#products_table').bootstrapTable('refresh');
    });
</script>