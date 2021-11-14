<section class="content-header">
    <h1>
        Seller Nick Names /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-seller-nickname.php"><i class="fa fa-plus-square"></i> Add New Seller Nick Name</a>
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
                        <table id='products_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=nickname" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true"  data-side-pagination="server" data-pagination="true"  data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]' >
                            <thead>
                            <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="name" data-sortable="true">Enter Nick Name</th>
                                    
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