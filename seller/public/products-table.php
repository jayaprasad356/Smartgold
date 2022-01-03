<section class="content-header">
    <h1>
        Products /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-product.php"><i class="fa fa-plus-square"></i> Add New Product</a>
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
                    <table id='products_table' class="table table-hover" data-toggle="table" data-url="get-bootstrap-table-data.php?table=products" data-page-list="[5, 10, 20, 50, 100, 200]"  data-side-pagination="server" data-pagination="true"  data-query-params="queryParams"   >
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                
                                
                                
                                <!-- <th data-field="seller_id" data-sortable="true">Seller ID</th> -->
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="image">Image</th>
                                <th data-field="price" data-sortable="true">Price</th>
                                <th data-field="discounted_price" data-sortable="true">D.Price</th>
                                
                                <!-- <th data-field="stock" data-sortable="true">Stock</th>
                                <th data-field="serve_for" data-sortable="true">Availability</th> -->
                                
                                <th data-field="is_approved" data-sortable="true">Is Approved?</th>
                                <th data-field="description" data-sortable="true" data-visible="false">Description</th>
                                
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