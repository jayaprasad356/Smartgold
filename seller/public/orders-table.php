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
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Product ID</h4>
                            <input id='product_id' name="product_id[]" class='form-control products'></input>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Status</h4>
                            <select id="status" name="status" class="form-control" required>
                                <option value="">All</option>
                                <option value="Received">Received</option>
                                <option value="Cancelled">Cancelled</option>         
                                <option value="Completed">Completed</option>                                                                            
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Payment Status</h4>
                            <select id="payment_status" name="payment_status" class="form-control" required>
                                <option value="">All</option>
                                <option value="UnPaid">UnPaid</option>
                                <option value="Paid">Paid</option>                                                                        
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Buy Method</h4>
                            <select id="buy_method" name="buy_method" class="form-control" required>
                                <option value="">All</option>
                                <option value="1">Pick Up at Store</option>
                                <option value="2">Delivery at Home</option>                                                                                   
                            </select>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id='orders_table' class="table table-hover" data-toggle="table" data-search="true" data-url="get-bootstrap-table-data.php?table=orders" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-sort-name="orders.id" data-sort-order="desc"  data-export-types='["txt","excel"]'   >
                        <thead>
                            <tr>
                                
                                <th data-field="id">ID</th>
                                <th data-field="order_date" data-sortable="true" >Order - Date</th>
                                <th data-field="product_id" data-sortable="true">Product ID</th>
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="quantity" data-sortable="true">Quantity</th>
                                <th data-field="delivery_charges" data-sortable="true">Delivery Charges</th>
                                <th data-field="buy_method" data-sortable="true">Buy Method</th>
                                <th data-field="status" >Status</th>
                                <th data-field="payment_status">Payment Status</th>
                                <th data-field="update">Update</th>
                                <th data-field="operate" data-events="actionEvents">Action</th>
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
        id = $('#status').val();
        $('#orders_table').bootstrapTable('refresh');
    });
    // $('#product_id').on('change', function() {
    //     id = $('#product_id').val();
    //     $('#orders_table').bootstrapTable('refresh');
    // });
    $('#buy_method').on('change', function() {
        id = $('#buy_method').val();
        $('#orders_table').bootstrapTable('refresh');
    });
    $('#payment_status').on('change', function() {
        id = $('#payment_status').val();
        $('#orders_table').bootstrapTable('refresh');
    });
    $(document).on('input', '.products', function(){
        id = $('#product_id').val();
        $('#orders_table').bootstrapTable('refresh');
    });
    function queryParams_1(p) {
        return {
            "status": $('#status').val(),
            "product_id": $('#product_id').val(),
            "buy_method": $('#buy_method').val(),
            "payment_status": $('#payment_status').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
    $('#product_id').select2({
        width: 'element',
        placeholder: 'Type in product_id to search',

    });
</script>