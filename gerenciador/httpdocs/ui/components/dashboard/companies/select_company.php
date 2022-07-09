<div class="col-lg-12">
    <div class="form-group">
        <label for="companies_id">Selecione uma Filial da System Pizza: </label>
        <select class="form-control select2" id="companies_id" name="companies_id" style="width: 100%;">
            <?php
            foreach (companies_controller::data4select("idx", array(" idx > 0 "), "fantasy_name") as $k => $v) {
                print_pre($v);
                printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($_SESSION[constant("cAppKey")]["companie_id"] ) && $_SESSION[constant("cAppKey")]["companie_id"] == $k ? ' selected="selected"' : '', $v);
            }
            ?>
        </select>
    </div>
</div>