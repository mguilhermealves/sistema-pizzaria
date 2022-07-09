<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#infos" aria-controls="infos" role="tab" data-toggle="tab">Informações</a></li>
    <?php if (isset($data["idx"])) { ?><li role="presentation"><a href="#clients" aria-controls="clients" role="tab" data-toggle="tab">Lista de Clientes</a></li><?php } ?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="infos">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Nome do Grupo:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Grupo Hsol" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($data["idx"])) { ?>

        <div role="tabpanel" class="tab-pane" id="clients">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col-lg-12 margin-top-15">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>CNPJ</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($data["clients_attach"]) == 0) { ?>
                                    <tr>
                                        <td colspan="4">
                                            <p class="alert alert-warning text-center">Nenhum cliente atribuido para esse grupo...</p>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <?php foreach ($data["clients_attach"] as $v) { ?>
                                        <tr>
                                            <td scope="row"><?php print($v["idx"]) ?></td>
                                            <td><?php print($v["name"]) ?></td>
                                            <td><?php print($v["cnpj"]) ?></td>
                                            <td>
                                                <a name="" id="" class="btn btn-primary" href="#" role="button">Visualizar</a>
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
        </<?php } ?>