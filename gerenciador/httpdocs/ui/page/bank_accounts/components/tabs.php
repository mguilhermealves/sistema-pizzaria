<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#conta_bancaria" aria-controls="conta_bancaria" role="tab" data-toggle="tab">Dados Cadastrais</a></li>
    <li role="presentation"><a href="#produtos" aria-controls="produtos" role="tab" data-toggle="tab">Produtos</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="conta_bancaria">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="bank_number">Código:</label>
                        <input type="text" class="form-control" id="bank_number" name="bank_number" placeholder="Ex: 237" value="<?php print(isset($data["bank_number"]) ? $data["bank_number"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Banco Bradesco" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="type">Tipo:</label>
                        <select class="form-control" id="type" name="type">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["type_bank_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["type"]) && $k == $data["type"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="agency_number">Agencia:</label>
                        <input type="text" class="form-control" id="agency_number" name="agency_number" placeholder="Ex: 00001" value="<?php print(isset($data["agency_number"]) ? $data["agency_number"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="agency_digit">Digito:</label>
                        <input type="text" class="form-control" id="agency_digit" name="agency_digit" placeholder="Ex: 2" value="<?php print(isset($data["agency_digit"]) ? $data["agency_digit"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="account_number">Conta:</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Ex: 123456" value="<?php print(isset($data["account_number"]) ? $data["account_number"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="account_digit">Digito:</label>
                        <input type="text" class="form-control" id="account_digit" name="account_digit" placeholder="Ex: 3" value="<?php print(isset($data["account_digit"]) ? $data["account_digit"] : "") ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="produtos">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 margin-top-10">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead>
                            <tr>
                                <th>Selecionar</th>
                                <th>Nome:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data2 as $v) { ?>
                                <tr>
                                    <td><input type="checkbox" id="products_id" name="products_id[]" value="<?php print($v["idx"]) ?>" <?php print(in_array($v["idx"], $products_id) ? 'checked="checked"' : '') ?> /></td>
                                    <td><?php print($v["name"]); ?></td>
                                </tr>
                            <?php   }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>