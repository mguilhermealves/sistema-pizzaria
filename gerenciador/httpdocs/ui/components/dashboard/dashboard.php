<section class="content-header">
    <h1>
        Dashboard
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <!-- SELECT COMPANIES -->
        <?php include(constant("cRootServer") . "ui/components/dashboard/companies/select_company.php"); ?>

        <!-- CARDS -->
        <?php include(constant("cRootServer") . "ui/components/dashboard/cards/cards.php"); ?>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> Pedidos</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

            <!-- solid sales graph -->
            <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Sales Graph</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-border">
                    <div class="row">
                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                            <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                            <div class="knob-label">Mail-Orders</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                            <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                            <div class="knob-label">Online</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                            <div class="knob-label">In-Store</div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->

</section>