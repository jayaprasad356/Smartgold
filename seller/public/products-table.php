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
                    <table id='products_table' class="table table-hover" data-toggle="table" data-search="true" data-url="get-bootstrap-table-data.php?table=products" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]'   >
                        <thead>
                            <tr>
                                <th data-field="operate" data-events="actionEvents">Action</th>
                                <th data-field="id" data-sortable="true">ID</th>
                                
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="category_name" data-sortable="true">Category Name</th>
                                <th data-field="image" >Image</th>
                                <th data-field="weight" data-sortable="true">Weight</th>
                                <th data-field="gender" data-sortable="true">Gender</th>
                                <th data-field="price" data-sortable="true">Price</th>
                                <th data-field="discounted_price" data-sortable="true">D.Price</th>
                                
                                <th data-field="status" data-sortable="true">Status</th>
                                <th data-field="description" data-sortable="true" data-visible="false">Description</th>
                                
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
