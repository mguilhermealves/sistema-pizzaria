<section class="content-header">
    <h1>
        Dashboard
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">CFOPS</li>
    </ol>
</section>

<section class="content">
    <div class="row">

        <div class="container-fluid">
            <div class="box-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation"><a href="#cfops" aria-controls="cfop" role="tab" data-toggle="tab">Dados</a>
                    </li>
                </ul>

                <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                    ?>
                        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                    <?php
                    }
                    ?>

                    <div role="tabpanel" class="tab-pane active" id="cfop">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nome:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Pagamento a Vista" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="descript">Desrição:</label>
                                        <input type="text" class="form-control" id="descript" name="descript" placeholder="" value="<?php print(isset($data["descript"]) ? $data["descript"] : "") ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-footer text-right">
                        <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i><?php print(isset($data["idx"]) ? " Salvar" : " Cadastrar") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>