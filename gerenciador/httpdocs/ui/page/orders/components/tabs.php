<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#pedido" aria-controls="pedido" role="tab" data-toggle="tab">Dados</a></li>
    <li role="presentation"><a href="#servicos" aria-controls="servicos" role="tab" data-toggle="tab">Serviços</a></li>
    <li role="presentation"><a href="#timeline" aria-controls="timeline" role="tab" data-toggle="tab">Histórico</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="pedido">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="created_at">N° NF:</label>
                        <input type="text" class="form-control" id="created_at" value="" disabled>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="created_at">Data de Emissão:</label>
                        <input type="date" class="form-control" id="created_at">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="created_at">Data de Vencimento:</label>
                        <input type="date" class="form-control" id="created_at">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="type_service">Tipo de Prestação de Serviço:</label>
                        <select name="type_service" id="type_service" class="form-control select2">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["type_service"]) && $k == $data["type_service"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="clients_id">Selecione o Cliente:</label>
                        <input type="text" class="form-control" id="clients_search" value="">
                        <input type="hidden" class="form-control" id="clients_id" value="">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="cost_center">Centro de Custo:</label>
                        <select name="cost_center" id="cost_center" class="form-control select2">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["cost_center"]) && $k == $data["cost_center"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="method_payment">Forma de Pagamento:</label>
                        <select name="method_payment" id="method_payment" class="form-control select2">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["method_payment"]) && $k == $data["method_payment"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="uf">Natureza:</label>
                        <select name="uf" id="uf" class="form-control select2">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="cfop">CFOP:</label>
                        <select name="cfop" id="cfop" class="form-control select2">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["cfop"]) && $k == $data["cfop"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="code_service">Código NFS:</label>
                        <select name="code_service" id="code_service" class="form-control select2">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["code_service"]) && $k == $data["code_service"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleInputCNPJ">E-mail (NFe):</label>
                        <input type="text" class="form-control" id="exampleInputCNPJ" placeholder="">
                    </div>
                </div>

                <script>
                    $('#modalSocio').on('show.bs.modal', event => {
                        var button = $(event.relatedTarget);
                        var modal = $(this);
                        // Use above variables to manipulate the DOM

                    });
                </script>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="servicos">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="CEP">CEP</label>
                        <input type="text" class="form-control cep" id="CEP" placeholder="Ex: 00000-000">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleInputFantasyName">Endereço</label>
                        <input type="text" class="form-control" id="exampleInputFantasyName" placeholder="" disabled>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleInputCNPJ">N°</label>
                        <input type="text" class="form-control" id="exampleInputCNPJ" placeholder="Ex: 123456">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Complemento</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Bairro</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="" disabled>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cidade</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="" disabled>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="uf">UF</label>
                        <select name="uf" id="uf" class="form-control" disabled>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="timeline">
        <!-- Main content -->
        <section class="content">

            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                                10 Feb. 2014
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-envelope bg-blue"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">Read more</a>
                                    <a class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-user bg-aqua"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-green">
                                3 Jan. 2014
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
</div>