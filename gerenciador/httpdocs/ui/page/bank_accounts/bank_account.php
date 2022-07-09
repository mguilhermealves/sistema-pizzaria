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

                    <!-- TABS -->
                    <?php include(constant("cRootServer") . "ui/page/bank_accounts/components/tabs.php"); ?>

                    <div class="box-footer text-right">
                        <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php print(isset($data["idx"]) ? " Salvar" : " Cadastrar") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>