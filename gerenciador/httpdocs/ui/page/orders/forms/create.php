<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cliente" aria-controls="cliente" role="tab" data-toggle="tab">Cliente</a></li>
    <li role="presentation"><a href="#itens" aria-controls="itens" role="tab" data-toggle="tab">Itens</a></li>
    <li role="presentation"><a href="#pagamento" aria-controls="pagamento" role="tab" data-toggle="tab">Forma de Pagamento</a></li>
    <li role="presentation"><a href="#motoboy" aria-controls="motoboy" role="tab" data-toggle="tab">Motoboy</a></li>
    <li role="presentation"><a href="#resumo" aria-controls="resumo" role="tab" data-toggle="tab">Resumo</a></li>
</ul>

<form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
    <?php
    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
    ?>
        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
    <?php
    }
    ?>
    <!-- orderstatus id -->
    <input type="hidden" id="orderstatus_id" name="orderstatus_id" value="1">
    <!-- companie id -->
    <input type="hidden" id="companie_id" name="companie_id" value="<?php print($_SESSION[constant("cAppKey")]["companie_id"]) ?>">
    <!-- client_id -->
    <input type="hidden" id="clients_id" name="clients_id">

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="cliente">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-12 text-center">
                        <h3>Pesquisar Cliente</h3>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_name">Razão Social:</label>
                            <input type="text" class="form-control clients_name_search" id="client_name" name="client_name" value="<?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["name"] : '') ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_cnpj">CPF:</label>
                            <input type="text" class="form-control clients_cnpj_search" id="client_cnpj" name="client_cnpj" value="<?php print(isset($data["clients_attach"][0]) ? preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $data["clients_attach"][0]["cpf"]) : '') ?>">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_group">Telefone:</label>
                            <input type="text" class="form-control clients_phone_search" id="client_phone" name="client_phone" value="<?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["phone"] : '') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="itens">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="order_id">Nome do Produto:</label>
                            <input class="form-control search_services" type="text" name="service" id="">
                            <input class="form-control" type="hidden" id="services_id" name="services_id">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="uf">Meio à meio</label>
                            <select class="form-control" id="uf" name="uf">
                                <option value="">Selecione</option>
                                <?php
                                foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                    printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="service_value">Valor do Produto:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="service_value" name="service_value" value="<?php print(isset($data["service_value"]) ? $data["service_value"] : "") ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 margin-top-15 margin-bottom-15">
                        <button id="btn_add_item" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Adicionar</button>
                    </div>

                    <table class="table table-striped table-inverse table-responsive" id="tbl_services">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Tipo</th>
                                <th>Nome do Produto</th>
                                <th>Valor Unit.</th>
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

        <div role="tabpanel" class="tab-pane" id="pagamento">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="value">Valor do Pedido:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="value" name="value" value="<?php print(isset($data["value"]) ? $data["value"] : "") ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="value">Taxa de Entrega:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="value" name="value" value="<?php print(isset($data["value"]) ? $data["value"] : "") ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type">Forma de Pagamento:</label>
                            <select id="type" name="type" class="form-control">
                                <option value="">Selecione</option>
                                <?php
                                foreach (products_controller::data4select("idx", array(" active = 'yes'"), "name") as $k => $v) {
                                    printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($data["type"]) && $data["type"] == $k ? ' selected="selected"' : '', $v);
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="motoboy">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="value">Valor do Pedido:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="value" name="value" value="<?php print(isset($data["value"]) ? $data["value"] : "") ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="value">Taxa de Entrega:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">R$</span>
                                <input type="text" class="form-control money" id="value" name="value" value="<?php print(isset($data["value"]) ? $data["value"] : "") ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="type">Forma de Pagamento:</label>
                            <select id="type" name="type" class="form-control">
                                <option value="">Selecione</option>
                                <?php
                                foreach (products_controller::data4select("idx", array(" active = 'yes'"), "name") as $k => $v) {
                                    printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($data["type"]) && $data["type"] == $k ? ' selected="selected"' : '', $v);
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="resumo">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>teste</th>
                                <th>teste 2</th>
                                <th>teste 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">1</td>
                                <td>2</td>
                                <td>3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box-footer text-right">
                <div class="col-sm-12 text-right">
                    <button type="submit" name="btn_save" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

</form>

<style>
    .autocomplete-suggestions {
        overflow: auto;
        background-color: #fff;
        border: 1px solid #c0c0c0
    }

    .autocomplete-suggestion {
        background-color: #fff;
        clear: both;
        cursor: pointer;
        display: block;
        font-size: 2rem;
        padding: 0.5rem;
    }

    .autocomplete-suggestion p {
        vertical-align: middle;
        padding-top: 15px;
        color: #0A4C80;
        font-size: 1.5rem
    }

    .autocomplete-selected {
        background-color: #0A4C80;
        color: #fff;
    }

    .autocomplete-selected p {
        color: #fff !important;
        font-size: 0.9rem
    }
</style>