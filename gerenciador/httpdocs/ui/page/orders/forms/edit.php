<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#prepedido" aria-controls="prepedido" role="tab" data-toggle="tab">Dados do Pré-Pedido</a></li>
    <li role="presentation"><a href="#pedido" aria-controls="pedido" role="tab" data-toggle="tab">Dados Pedido</a></li>
    <li role="presentation"><a href="#servicos" aria-controls="servicos" role="tab" data-toggle="tab">Serviços</a></li>
    <li role="presentation"><a href="#resumo" aria-controls="resumo" role="tab" data-toggle="tab">Resumo</a></li>
    <li role="presentation"><a href="#timeline" aria-controls="timeline" role="tab" data-toggle="tab">Histórico</a></li>
</ul>

<form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
    <?php
    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
    ?>
        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
    <?php
    }
    ?>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="prepedido">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-12 margin-top-30">
                        <div class="form-group">
                            <label for="clients_id">Cliente:</label>
                            <select id="clients_id" name="clients_id" class="form-control select2">
                                <option value="">Selecione</option>
                                <?php
                                foreach (clients_controller::data4select("idx", array(" active = 'yes' "), "concat_ws(' - ', name, cnpj) as name") as $k => $v) {
                                    $name_formated = preg_replace("/^(.+) - (\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1 - \$2.\$3.\$4/\$5-\$6", $v);
                                    printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($data["clients_attach"][0]) && $data["clients_attach"][0]["idx"] == $k ? ' selected="selected"' : '', $name_formated);
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="value">Valor do Pedido:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="value" name="value" value="<?php print(isset($data["value"]) ? $data["value"] : "") ?>" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="tax">Taxa:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">%</span>
                                <input type="text" class="form-control percent" id="tax" value="<?php print(isset($data["tax"]) ? $data["tax"] : "") ?>" placeholder="" aria-describedby="basic-addon1" disabled>
                                <input type="hidden" name="tax">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type">Tipo de Produto:</label>
                            <select id="type" name="type" class="form-control select2">
                                <option value="">Selecione</option>
                                <?php
                                foreach (products_controller::data4select("idx", array(" active = 'yes'"), "name") as $k => $v) {
                                    printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($data["type"]) && $data["type"] == $k ? ' selected="selected"' : '', $v);
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="emission_at">Data de Emissão:</label>
                            <input type="date" class="form-control" id="emission_at" name="emission_at" value="<?php print(isset($data["emission_at"]) ? preg_replace("/(....).(..).(..).+/", "$1-$2-$3", $data["emission_at"]) : "") ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="expirated_at">Data de Vencimento:</label>
                            <input type="date" class="form-control" id="expirated_at" name="expirated_at" value="<?php print(isset($data["expirated_at"]) ? preg_replace("/(....).(..).(..).+/", "$1-$2-$3", $data["expirated_at"]) : "") ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="observation">Observação:</label>
                            <input type="textarea" class="form-control" id="observation" name="observation" <?php print(isset($data["observation"]) ? $data["observation"] : "") ?>>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="has_balance_request" name="has_balance_request" <?php print($data["has_balance_request"] == "yes" ? "checked " : "") ?>>
                            <label class="form-check-label" for="has_balance_request">Pedido de Saldo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="pedido">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="order_id">N° Pedido:</label>
                            <input type="text" class="form-control" id="order_id" value="<?php print($data["idx"]) ?>" disabled>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="nf_number">N° NF:</label>
                            <input type="text" class="form-control" id="nf_number" value="<?php print(isset($data["nf_number"]) ? $data["nf_number"] : "-") ?>" disabled>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type_service">Tipo de Prestação de Serviço:</label>
                            <input type="text" class="form-control" id="type_service" value="Gerenciamento" disabled>
                            <input type="hidden" class="form-control" value="management">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label for="">Centro de Custo:</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCostCenter"><i class="fa fa-search" aria-hidden="true"></i> Centro de Custo</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" name="" id="cost_center_selected" class="form-control" disabled>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCostCenter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Selecione o Centro de Custo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Centro de Custo:</label>
                                                    <input type="text" name="" id="cost_center_search" class="form-control" placeholder="" aria-describedby="helpId">
                                                    <small id="helpId" class="text-muted">Digite o centro de custo.</small>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Nome</th>
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row">1</td>
                                                            <td>TI</td>
                                                            <td>
                                                                <a name="" id="" class="btn btn-primary" href="#" role="button">Selecione</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="cost_center" id="cost_center" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <label for="">Forma de Pagamento:</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPaymentMethod"><i class="fa fa-search" aria-hidden="true"></i> Forma de Pagamento</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" name="" id="cost_center_selected" class="form-control" disabled>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalPaymentMethod" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Selecione a Forma de Pagamento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Forma de Pagamento:</label>
                                                    <input type="text" name="" id="payment_method_search" class="form-control" placeholder="" aria-describedby="helpId">
                                                    <small id="helpId" class="text-muted">Digite o forma de pagamento.</small>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Nome</th>
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row">1</td>
                                                            <td>Pagamento a vista</td>
                                                            <td>
                                                                <a name="" id="" class="btn btn-primary" href="#" role="button">Selecione</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="cost_center" id="cost_center" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="uf">Natureza da Operação:</label>
                            <select name="uf" id="uf" class="form-control">
                                <option value="">Selecione</option>
                                <?php
                                foreach ($GLOBALS["type_nature_lists"] as $k => $v) {
                                    printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label for="">CFOP:</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCFOP"><i class="fa fa-search" aria-hidden="true"></i> CFOP</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" name="" id="cfop_selected" class="form-control" disabled>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCFOP" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Selecione a CFOP:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">CFOP:</label>
                                                    <input type="text" name="" id="cfop_search" class="form-control" placeholder="" aria-describedby="helpId">
                                                    <small id="helpId" class="text-muted">Digite o CFOP.</small>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Nome</th>
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row">1</td>
                                                            <td>5102</td>
                                                            <td>
                                                                <a name="" id="" class="btn btn-primary" href="#" role="button">Selecione</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="cfop" id="cfop" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <label for="">Código NFS:</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCodeService"><i class="fa fa-search" aria-hidden="true"></i> Código NFS</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" name="" id="code_service_selected" class="form-control" disabled>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCodeService" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Selecione a Código NFS:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Código NFS:</label>
                                                    <input type="text" name="" id="code_service_search" class="form-control" placeholder="" aria-describedby="helpId">
                                                    <small id="helpId" class="text-muted">Digite o Código NFS.</small>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Nome</th>
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row">1</td>
                                                            <td>2105</td>
                                                            <td>
                                                                <a name="" id="" class="btn btn-primary" href="#" role="button">Selecione</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="code_service" id="code_service" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="exampleInputCNPJ">E-mail (NFe):</label>
                            <input type="text" class="form-control" id="exampleInputCNPJ" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="servicos">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="order_id">Tipo de Serviço:</label>
                            <input class="form-control search_services" type="text" name="service" id="">
                            <input class="form-control" type="hidden" id="services_id" name="services_id">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="service_value">Valor do Serviço:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="service_value" name="service_value" value="<?php print(isset($data["service_value"]) ? $data["service_value"] : "") ?>" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="has_tributed">Tributado:</label>
                            <input class="form-control" type="text" name="has_tributed" id="has_tributed">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="tax_value">Impostos:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">%</span>
                                <input type="text" class="form-control porcent" id="tax_value" name="tax_value" value="1,50" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="IR_value">Valor do IR:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="IR_value" name="IR_value" value="<?php print(isset($data["IR_value"]) ? $data["IR_value"] : "") ?>" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="amount">Valor Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="amount" name="amount" value="<?php print(isset($data["amount"]) ? $data["amount"] : "") ?>" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button id="btn_add_item" type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Adicionar</button>
                    </div>

                    <table class="table table-striped table-inverse table-responsive" id="tbl_services">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Tipo de Serviço</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Tributado</th>
                                <th>Impostos</th>
                                <th>Valor IR</th>
                                <th>Valor Total</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="resumo">
            <div class="box box-primary">
                <div class="box-body">
                    <section class="content-header">
                        <h1>
                            Pedido
                            <small>#<?php print($data["idx"]) ?></small>
                        </h1>
                    </section>

                    <section class="invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-building-o"></i> <?php print($data["clients_attach"][0]["name"]) ?>
                                    <small class="pull-right">Data de Criação: 23/06/2022</small>
                                </h2>
                            </div>

                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Empresa Emissora
                                <address>
                                    <strong><?php print($data["companies_attach"][0]["name"]) ?></strong><br>
                                    CNPJ: <?php print($data["companies_attach"][0]["cnpj"]) ?>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Empresa Recebedora
                                <address>
                                    <strong><?php print($data["clients_attach"][0]["name"]) ?></strong><br>
                                    <?php print($data["clients_attach"][0]["name"]) ?><br>
                                    <?php print($data["clients_attach"][0]["name"]) ?><br>
                                    Phone: <?php print($data["clients_attach"][0]["name"]) ?><br>
                                    Email: <?php print($data["clients_attach"][0]["name"]) ?>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #007612</b><br>
                                <br>
                                <b>Order ID:</b> 4F3S8J<br>
                                <b>Payment Due:</b> 2/22/2014<br>
                                <b>Account:</b> 968-34567
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                            <th>Serial #</th>
                                            <th>Description</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td>455-981-221</td>
                                            <td>El snort testosterone trophy driving gloves handsome</td>
                                            <td>$64.50</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p class="lead">Vencimento em: 23/06/2022</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>$250.30</td>
                                        </tr>
                                        <tr>
                                            <th>Taxa (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>$5.80</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>$265.24</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-sm-6 col-lg-6">
                                <a type="button" id="cancellation_order" class="btn btn-danger" data-orderId="<?php print($data["idx"]) ?>"><i class="bi bi-x-circle"></i> Cancelar Pedido</a>
                            </div>

                            <div class="col-sm-6 col-lg-6 text-right">
                                <button type="submit" name="btn_save" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="timeline">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="timeline">
                            <?php foreach ($timelines as $timeline) { ?>
                                <li class="time-label">
                                    <span class="<?php print($timeline["color"]) ?>">
                                        <?php print(date_format(new DateTime($timeline["date"]), "d/m/Y")) ?>
                                    </span>
                                </li>
                                <li>
                                    <i class="<?php print($timeline["icon"]) ?>"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php print(date_format(new DateTime($timeline["time"]), "H:i")) ?></span>

                                        <h3 class="timeline-header"><?php print($timeline["title"]) ?></h3>

                                        <div class="timeline-footer">
                                            <?php print("Criado por: <strong>" . $timeline["username"] . "</strong>") ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="time-label">
                                    <span class="bg-green">
                                        <?php print(date_format(new DateTime($timeline["date"]), "d/m/Y")) ?>
                                    </span>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
</form>