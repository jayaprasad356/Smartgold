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
                    <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Products Category</h4>
                            <select id="category_id" name="category_id" placeholder="Select Category" required class="form-control col-xs-3" style="width: 300px;">
                                    <?php
                                    $Query = "select name, id from category";
                                    $db->sql($Query);
                                    $result = $db->getResult();
                                    if ($result) {
                                    ?>
                                        <option value="">All Products</option>
                                        <?php foreach ($result as $row) {
                                            
                                        ?>
                                        <option value='<?= $row['id'] ?>'><?= $row['name'] ?></option>
                                                
                                    <?php 
                                        }
                                    }
                                    ?>
                                </select>
                    </div>
                    <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Gender</h4>
                            <select id="gender" name="gender" class="form-control" required>
                            
                                <option value="Male">Male</option>
                                <option value="Female" selected>Female</option>
                                <option value="Kids" >Kids</option>
                                <option value="Unisex" >Unisex</option>
                            </select>
                    </div>
                    <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Status</h4>
                            <select id="status" name="status" placeholder="Select budget range" required class="form-control col-xs-3" style="width: 300px;">
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                            </select>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id='products_table' class="table table-hover" data-toggle="table" data-search="true" data-url="get-bootstrap-table-data.php?table=products" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="p.id" data-sort-order="desc"  data-export-types='["txt","excel"]'   >
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
    $('#category_id').on('change', function() {
        id = $('#category_id').val();
        $('#products_table').bootstrapTable('refresh');
    });
    $('#gender').on('change', function() {
        id = $('#gender').val();
        $('#products_table').bootstrapTable('refresh');
    });
    $('#status').on('change', function() {
        id = $('#status').val();
        $('#products_table').bootstrapTable('refresh');
    });
    function queryParams_1(p) {
        return {
            "category_id": $('#category_id').val(),
            "gender": $('#gender').val(),
            "status": $('#status').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>
