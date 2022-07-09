<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cadastro" aria-controls="cadastro" role="tab" data-toggle="tab">Dados Cadastrais</a></li>
    <li role="presentation"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
    <?php if (isset($data["idx"])) { ?>
        <li role="presentation"><a href="#historico" aria-controls="historico" role="tab" data-toggle="tab">Histórico de Pedidos</a></li>
    <?php } ?>
    <li role="presentation"><a href="#finalizar" aria-controls="finalizar" role="tab" data-toggle="tab">Finalizar</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="cadastro">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="first_name">Nome:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Ex: João" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="last_name">Sobrenome:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ex: Silva" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="Ex: 000.000.000-00" value="<?php print(isset($data["cpf"]) ? $data["cpf"] : "") ?>">
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
                        <label for="postalcode">CEP:</label>
                        <input type="text" class="form-control postalcode" id="postalcode" name="postalcode" placeholder="Ex: 00000-000" value="<?php print(isset($data["postalcode"]) ? $data["postalcode"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="address">Endereço:</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="number">N°:</label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="Ex: 123456" value="<?php print(isset($data["number"]) ? $data["number"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="complement">Complemento:</label>
                        <input type="text" class="form-control" id="complement" name="complement" placeholder="" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>">
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="district">Bairro:</label>
                        <input type="text" class="form-control" id="district" name="district" placeholder="" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>">
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="city">Cidade:</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>">
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

    <?php if (isset($data["idx"])) { ?>

        <div role="tabpanel" class="tab-pane" id="historico">
            <div class="box box-primary">
                <div class="box-body">
                    <h3 class="text-center margin-top-45">Pedidos Anteriores</h3>

                    <table class="table table-striped table-inverse table-responsive margin-top-45">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>E-mail</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data["contacts_attach"] as $contact) {
                                $fullName = isset($contact["last_name"]) ? $contact["first_name"] . " " . $contact["last_name"] : $contact["first_name"];
                            ?>
                                <tr>
                                    <td scope="row"><?php print($fullName) ?></td>
                                    <td><?php print($contact["office"]) ?></td>
                                    <td><?php print(isset($contact["mail"]) ? $contact["mail"] : "-") ?></td>
                                    <td>
                                        <a name="" id="" class="btn btn-primary btn-sm" href="/cliente/<?php print($data["idx"]) ?>/contato/<?php print($contact["idx"]) ?>" role="button"><i class="bi bi-eye"></i> Ver Pedido</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php } ?>

    <div role="tabpanel" class="tab-pane" id="finalizar">
        <div class="box box-primary">
            <div class="box-footer text-right">
                <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php print(isset($data["idx"]) ? " Salvar" : " Cadastrar") ?></button>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content1 {
        position: relative;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 6px;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        outline: 0;
    }

    .modal-content2 {
        position: relative;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 6px;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        outline: 0;
    }
</style>