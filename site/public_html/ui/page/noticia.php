<main class="container">
    <div class="row equal my-3 mx-3">
        <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
            <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>

            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 xs-gone">
                <div class="card mb-2 py-5 px-3" style="max-width: auto;">
                    <div>
                        <h6>Posts Recentes</h6>
                    </div>

                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <img class="card-img img-thumbnail" src="<?php print($data_recent_news[$i]["image"]) ?>" alt="" style="max-height: 300px;" />
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php print($data_recent_news[$i]["name"]) ?> </h5>
                                    <p class="card-text"> <?php print(mb_strimwidth($data_recent_news[$i]["context"], 0, 50, " ...")); ?> </p>
                                    <a class="" href="<?php printf($GLOBALS["noticia_url"], $data_recent_news[$i]["slug"]); ?>">Ver mais</a>
                                </div>
                            </div>
                            <div class="col-lg-12 my-2 justify-content-center">
                                <hr>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20 xs-padding-left-0 xs-margin-top-20">
            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">
                <h1 class="mb-0 noticia">Noticias</h1>
            </div>

            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 mt-3">
                <div class="card mb-2 py-5 px-5" style="max-width: auto;">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <img class="card-img img-thumbnail" src="/<?php print($data["image"]) ?>" alt="" style="max-height: 300px;" />
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title"> <?php print($data["name"]) ?> </h5>
                                <p class="card-text"> <?php print($data["context"]) ?> </p>

                            </div>
                        </div>

                        <div class="col-lg-12 justify-content-center">
                            <div class="card-footer">
                                <a type="button" class="btn btn-link btn-sm" href="<?php print($GLOBALS["noticias_url"]) ?>">Voltar</a>

                                <a type="button" class="btn btn-link btn-sm pull-right" href="<?php print($GLOBALS["noticias_url"]) ?>">Próximo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>