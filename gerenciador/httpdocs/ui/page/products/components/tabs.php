<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#dados_produto" aria-controls="dados_produto" role="tab" data-toggle="tab">Dados do Produto</a></li>
    <li role="presentation"><a href="#imagem" aria-controls="imagem" role="tab" data-toggle="tab">Imagens do Produto</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="dados_produto">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nome do Produto: </label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" placeholder="Ex: Cartão BPP">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="type">Tipo: </label>
                        <select class="form-control" id="type" name="type">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["type"]) && $k == $data["type"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="price">Valor: </label>
                        <input type="text" class="form-control" id="price" name="name" value="<?php print(isset($data["price"]) ? $data["price"] : "") ?>" placeholder="Ex: Cartão BPP">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="descript">Descrição: </label>
                        <textarea class="textarea" id="descript" name="descript" placeholder="Digite uma descrição aqui" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="imagem">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="image">Imagem: </label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>