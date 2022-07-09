<section class="content-header">
    <h1>
        Dashboard
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Contato</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="container-fluid">
            <div class="box-body">
                <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                    ?>
                        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                    <?php
                    }
                    ?>

                    <input type="hidden" name="clients_id" value="<?php print($info["clients_id"]) ?>">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#dados" aria-controls="dados" role="tab" data-toggle="tab">Dados</a></li>
                        <li role="presentation"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
                        <li role="presentation"><a href="#contatos" aria-controls="contatos" role="tab" data-toggle="tab">Telefone</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="dados">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="first_name">Nome:</label>
                                            <input type="text" id="first_name" class="form-control" name="first_name" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>" placeholder="Digite o Nome do Contato">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="last_name">Sobrenome:</label>
                                            <input type="text" id="last_name" class="form-control" name="last_name" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>" placeholder="Digite o Sobrenome do Contato">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="office">Cargo:</label>
                                            <input type="text" id="office" class="form-control" name="office" value="<?php print(isset($data["office"]) ? $data["office"] : "") ?>" placeholder="Ex: Gerente Administrativo">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="mail">Email:</label>
                                            <input type="text" id="mail" class="form-control" name="mail" value="<?php print(isset($data["mail"]) ? $data["mail"] : "") ?>" placeholder="Digite o email do Contato">
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
                                            <input type="text" id="postalcode" class="form-control postalcode" name="postalcode" value="<?php print(isset($data["postalcode"]) ? $data["postalcode"] : "") ?>" placeholder="Digite o CEP">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="address">Endereço:</label>
                                            <input type="text" id="address" class="form-control" name="address" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="number">Numero:</label>
                                            <input type="text" id="number" class="form-control" name="number" value="<?php print(isset($data["number"]) ? $data["number"] : "") ?>" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="complement">Complemento:</label>
                                            <input type="text" id="complement" class="form-control" name="complement" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="district">Bairro:</label>
                                            <input type="text" id="district" class="form-control" name="district" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="city">Cidade:</label>
                                            <input type="text" id="city" class="form-control" name="city" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>" placeholder="">
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

                        <div role="tabpanel" class="tab-pane" id="contatos">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Telefone 1:</label>
                                            <input type="text" id="phone" class="form-control phone" name="phone" value="<?php print(isset($data["phone"]) ? $data["phone"] : "") ?>" placeholder="(99) 9999-9999">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ramal">Ramal:</label>
                                            <input type="text" id="ramal" class="form-control" name="ramal" value="<?php print(isset($data["ramal"]) ? $data["ramal"] : "") ?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone2">Telefone 2:</label>
                                            <input type="text" id="phone2" class="form-control phone" name="phone2" value="<?php print(isset($data["phone2"]) ? $data["phone2"] : "") ?>" placeholder="(99) 9999-9999">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ramal2">Ramal:</label>
                                            <input type="text" id="ramal2" class="form-control" name="ramal2" value="<?php print(isset($data["ramal2"]) ? $data["ramal2"] : "") ?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="celphone">Celular:</label>
                                            <input type="text" id="celphone" class="form-control celphone" name="celphone" value="<?php print(isset($data["celphone"]) ? $data["celphone"] : "") ?>" placeholder="(99) 9 9999 9999">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="button" class="btn btn-default btn_back">Voltar</button>
                                <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php print(isset($data["idx"]) ? " Salvar" : " Cadastrar") ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>