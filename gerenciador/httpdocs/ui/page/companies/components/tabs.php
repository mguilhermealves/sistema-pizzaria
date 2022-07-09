<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#dados" aria-controls="dados" role="tab" data-toggle="tab">Dados Cadastrais</a></li>
    <li role="presentation"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
    <li role="presentation"><a href="#bancario" aria-controls="bancario" role="tab" data-toggle="tab">Dados Bancários</a></li>
    <?php if (isset($data["idx"])) { ?>
        <li role="presentation"><a href="#socios" aria-controls="socios" role="tab" data-toggle="tab">Sócios</a></li>
    <?php } ?>
    <li role="presentation"><a href="#finalizar" aria-controls="finalizar" role="tab" data-toggle="tab">Finalizar</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="dados">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Razão Social</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" placeholder="Razão Social">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="fantasy_name">Nome Fantasia</label>
                        <input type="text" class="form-control" id="fantasy_name" name="fantasy_name" value="<?php print(isset($data["fantasy_name"]) ? $data["fantasy_name"] : "") ?>" placeholder="Nome Fantasia">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?php print(isset($data["cnpj"]) ? $data["cnpj"] : "") ?>" placeholder="12.345.678/0001-99">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="insc_municipal">Inscrição Municipal</label>
                        <input type="text" class="form-control" id="insc_municipal" name="insc_municipal" value="<?php print(isset($data["insc_municipal"]) ? $data["insc_municipal"] : "") ?>" placeholder="Ex: 123456" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="insc_estadual">Inscrição Estadual</label>
                        <input type="text" class="form-control" id="insc_estadual" name="insc_estadual" value="<?php print(isset($data["insc_estadual"]) ? $data["insc_estadual"] : "") ?>" placeholder="Ex: 654321" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control phone" id="phone" name="phone" value="<?php print(isset($data["phone"]) ? $data["phone"] : "") ?>" placeholder="Ex: (11) 4444-4444">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="endereco">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="CEP">CEP</label>
                        <input type="text" class="form-control postalcode" id="CEP" name="postalcode" value="<?php print(isset($data["postalcode"]) ? $data["postalcode"] : "") ?>" placeholder="Ex: 00000-000">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>" placeholder="">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="number">N°</label>
                        <input type="text" class="form-control" id="number" name="number" value="<?php print(isset($data["number"]) ? $data["number"] : "") ?>" placeholder="Ex: 123456">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="complement">Complemento</label>
                        <input type="text" class="form-control" id="complement" name="complement" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>" placeholder="">
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="district">Bairro</label>
                        <input type="text" class="form-control" id="district" name="district" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>" placeholder="">
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="city">Cidade</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>" placeholder="">
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="uf">UF</label>
                        <select class="form-control" id="uf" name="uf">
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

    <div role="tabpanel" class="tab-pane" id="bancario">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 margin-top-10">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead>
                            <tr>
                                <th>Selecionar</th>
                                <th>Código:</th>
                                <th>Nome:</th>
                                <th>Agencia-Digito:</th>
                                <th>Conta-Digito:</th>
                                <th>Tipo:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data2 as $v) { ?>
                                <tr>
                                    <td><input type="checkbox" id="bankaccounts_id" name="bankaccounts_id[]" value="<?php print($v["idx"]) ?>" <?php print(in_array($v["idx"], $bankaccounts_id) ? 'checked="checked"' : '') ?> /></td>
                                    <td><?php print($v["bank_number"]); ?></td>
                                    <td><?php print($v["name"]); ?></td>
                                    <td><?php print($v["agency_digit"] ? $v["agency_number"] . '-' . $v["agency_digit"] : $v["agency_number"]); ?></td>
                                    <td><?php print($v["account_digit"] ? $v["account_number"] . '-' . $v["account_digit"] : $v["account_number"]); ?></td>
                                    <td><?php print($GLOBALS["type_bank_lists"][$v["type"]]); ?></td>
                                </tr>
                            <?php   }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($data["idx"])) { ?>
        <div role="tabpanel" class="tab-pane" id="socios">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <a type="button" id="add_partner" class="btn btn-primary pull-right" href="/socios/empresa/<?php print($data["idx"]) ?>"><i class="bi bi-plus-circle"></i> Adicionar Sócio</a>
                        </div>
                    </div>

                    <div class="col-lg-12 margin-top-45">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>E-mail</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($data["partners_attach"]) == 0) { ?>
                                    <tr>
                                        <td colspan="6">
                                            <p class="alert alert-warning text-center">Nenhum sócio atribuido para essa empresa...</p>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <?php foreach ($data["partners_attach"] as $partner) {
                                        $fullName = isset($partner["last_name"]) ? $partner["first_name"] . " " . $partner["last_name"] : $partner["first_name"];
                                    ?>
                                        <tr>
                                            <td scope="row"><?php print($fullName) ?></td>
                                            <td><?php print($partner["document"]) ?></td>
                                            <td><?php print($partner["mail"]) ?></td>
                                            <td>
                                                <a type="button" name="" id="" class="btn btn-danger btn-sm remove_partner" data-partnerName="<?php print($fullName) ?>"><i class="bi bi-x"></i> Excluir</a>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div role="tabpanel" class="tab-pane" id="finalizar">
        <div class="box box-primary">
            <div class="box-body">

            </div>
        </div>

        <div class="box-footer text-right">
            <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php print(isset($data["idx"]) ? " Salvar" : " Cadastrar") ?></button>
        </div>
    </div>
</div>