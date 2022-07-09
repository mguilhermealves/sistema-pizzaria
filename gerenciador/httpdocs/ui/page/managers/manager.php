<section class="content-header">
    <h1>
        <?php print(constant("cTitle")) ?>
        <small><?php print($form["title"]) ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active"><a href="<?php print($GLOBALS["partners_url"]) ?>"><?php print($page); ?> </a></li>
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

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#socios" aria-controls="socios" role="tab" data-toggle="tab">Dados Cadastrais</a></li>
                        <li role="presentation"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="socios">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="first_name">Nome:</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Ex: Dagoberto" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="last_name">Sobrenome:</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ex: Tenaglia" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="document">CPF:</label>
                                            <input type="text" class="form-control cpf" id="document" name="document" placeholder="Ex: 123.456.789.99" value="<?php print(isset($data["document"]) ? $data["document"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="rg">RG:</label>
                                            <input type="text" class="form-control" id="rg" name="rg" placeholder="Ex: 123456" value="<?php print(isset($data["rg"]) ? $data["rg"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="mail">E-mail:</label>
                                            <input type="mail" class="form-control" id="mail" name="mail" placeholder="Ex: dtenaglia@hsolmkt.com.br" value="<?php print(isset($data["mail"]) ? $data["mail"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="commission">Comissão:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">%</span>
                                                <input type="text" class="form-control percent" id="commission" name="commission" value="<?php print(isset($data["commission"]) ? $data["commission"] : "") ?>" placeholder="" aria-describedby="basic-addon1">
                                            </div>
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
                                            <label for="postalcode">CEP</label>
                                            <input type="text" class="form-control postalcode" id="postalcode" name="postalcode" placeholder="Ex: 00000-000" value="<?php print(isset($data["postalcode"]) ? $data["postalcode"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="address">Endereço</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="number">N°</label>
                                            <input type="text" class="form-control" id="number" name="number" placeholder="Ex: 123456" value="<?php print(isset($data["number"]) ? $data["number"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="complement">Complemento</label>
                                            <input type="text" class="form-control" id="complement" name="complement" placeholder="" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>">
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="district">Bairro</label>
                                            <input type="text" class="form-control" id="district" name="district" placeholder="" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>">
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="city">Cidade</label>
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
                    </div>

                    <div class="box-footer text-right">
                        <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php print(isset($data["idx"]) ? " Salvar" : " Cadastrar") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>