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
                       <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Budget</h4>
                            <select id="budget_id" name="budget_id" placeholder="Select budget range" required class="form-control col-xs-3" style="width: 300px;">
                                    <?php
                                    $Query = "select budget, id from budget order by id desc";
                                    $db->sql($Query);
                                    $result = $db->getResult();
                                    if ($result) {
                                    ?>
                                        <option value="">All</option>
                                        <?php foreach ($result as $row) {
                                            
                                        ?>
                                        <option value='<?= $row['id'] ?>'><?= $row['budget'] ?></option>
                                                
                                    <?php 
                                        }
                                    }
                                    ?>
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
                    <table style="width:100%" id='products_table' class="table table-hover" data-toggle="table" data-search="true" data-url="get-bootstrap-table-data.php?table=offers" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams_1"  data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]'   >
                        <thead >
                            <tr>
                                <th class="main" data-field="operate" data-events="actionEvents">Action </th>
                                <th class="main" data-field="id" data-sortable="true">ID</th>
                                <th  data-field="valid_date" data-sortable="true">Offer <br> Date</th>
                                <th  data-field="gram_price" data-sortable="true">Discount <br> Per Gram(₹)</th>
                                <th class="main" data-field="wastage" data-sortable="true">Wastage <br> Discount(%)</th>
                                <th class="main" data-field="max_locked" data-sortable="true">Max <br> Locked Items</th>
                                
                                <th  data-field="budget_range" >Budget <br> Range</th>
                                <th data-field="total_locked_customers" >No. of Locked <br> Customers</th>
                                
                                <th data-field="locked" data-events="actionEvents">Locked <br> Customers</th>
                                <th class="main" data-field="status" >Status</th>
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
<style>
    .main{
        width:4px;
    }
</style>

<script>
    $('#budget_id').on('change', function() {
        id = $('#budget_id').val();
        $('#products_table').bootstrapTable('refresh');
    });
    $('#status').on('change', function() {
        id = $('#status').val();
        $('#products_table').bootstrapTable('refresh');
    });
    function queryParams_1(p) {
        return {
            "status": $('#status').val(),
            "budget_id": $('#budget_id').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>