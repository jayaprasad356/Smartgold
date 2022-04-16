<section class="content-header">
    <h1>
        Customers Locked Offers /
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
                    <table id='products_table' class="table table-hover" data-toggle="table" data-search="true" data-url="get-bootstrap-table-data.php?table=lockoffers&id=" data-show-refresh="true"  data-side-pagination="server" data-pagination="true" data-query-params="queryParams"  data-trim-on-search="false" data-filter-control="true" data-sort-name="id" data-sort-order="desc"  data-export-types='["txt","excel"]'   >
                        <thead>
                            <tr>
                                <th data-field="operate" data-events="actionEvents">Action</th>
                                <th data-field="id" data-sortable="true">Offer Id</th>
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
            "offerid": offerid,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>
