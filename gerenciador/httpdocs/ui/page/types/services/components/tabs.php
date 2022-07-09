<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#infos" aria-controls="infos" role="tab" data-toggle="tab">Dados Cadastrais</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="infos">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Manuseio" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="is_taxed">Tributado:</label>
                        <select class="form-control" id="is_taxed" name="is_taxed">
                            <option value="">--Selecione--</option>
                            <?php
                            foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                printf('<option %s value="%s">%s</option>', isset($data["is_taxed"]) && $k == $data["is_taxed"] ? ' selected' : '', $k, $v);
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <input type="text" class="form-control editor" id="description" name="description" value="<?php print(isset($data["description"]) ? $data["description"] : "") ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>