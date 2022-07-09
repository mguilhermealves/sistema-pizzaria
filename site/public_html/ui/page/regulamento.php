<main class="container">
    <div class="row my-3 mx-3">
        <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
            <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
        </div>

        <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20 xs-padding-left-0 xs-margin-top-20">
            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">
                Regulamento
            </div>

            <div class="card my-3 p-3" style="max-width: auto;">
                <iframe src="<?php printf("%s%s", constant("cFurniture"), "upload/REGULAMENTO-LOVERS-AVERT-2022-V4.pdf") ?>" width="100%" height="600px" style="border: none;"></iframe>
            </div>

            <?php
            if (empty($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) {
            ?>

                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 my-3 p-3">
                    <form class="col-12" action=<?php print($GLOBALS["regulamento_url"]) ?> method="POST">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="checkRules" id="check_rules">
                            <label class="form-check-label" for="checkRules">Eu, li e estou de acordo com o regulamento</label>
                        </div>

                        <button class="btn btn-success pull-right" type="submit" id="btn_save" name="btn_save">Aceitar</button>
                    </form>
                </div>

            <?php
            } else {
            ?>
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 my-3 p-3">
                    <p class="pull-right">
                        <strong>Data do aceite: <span style="text-decoration: underline;"> <?php print date("d/m/Y H:i:s", strtotime($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) ?> </span> </strong>
                    </p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>