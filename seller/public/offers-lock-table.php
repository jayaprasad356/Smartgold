<section class="content-header">
    <h1>
        Offers /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-product.php"><i class="fa fa-plus-square"></i> Add New offer</a>
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
                    <table id='products_table' class="table table-hover" data-toggle="table" data-url="get-bootstrap-table-data.php?table=lockoffers&id=" data-page-list="[5, 10, 20, 50, 100, 200]"  data-side-pagination="server" data-pagination="true"  data-query-params="queryParams"   >
                        <thead>
                            <tr>
                                
                                
                                
                                
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="mobile" data-sortable="true">Mobile</th>
                                <th data-field="email" data-sortable="true">Email</th>
                            
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
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const offerid = urlParams.get('id')
    function queryParams(p) {
        return {
            "offerid": offerid
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