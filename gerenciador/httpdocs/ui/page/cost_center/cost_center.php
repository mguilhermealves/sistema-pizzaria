<section class="content-header">
    <h1>
        Dashboard
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Centro de Custos</li>
    </ol>
</section>

<!--cadastrar novo centro de custos-->

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
                        <li role="presentation" class="active"><a href="#centro_de_custos" aria-controls="centro-de-custos" role="tab" data-toggle="tab">Centro de custos</a></li>
                    </ul>


                    <div role="tabpanel" class="tab-pane active" id="centro-de-custos">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Nome:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Administração" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" required>
                                    </div>
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