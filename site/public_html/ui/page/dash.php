<main class="container">
    <div class="row my-3 mx-3">
        <div class="col-12 col-sm-12 col-xs-12 col-md-2 col-lg-2">
            <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
        </div>

        <div class="col-12 col-sm-12 col-xs-12 col-md-10 col-lg-10 padding-left-20">
            <?php include(constant("cRootServer") . "ui/includes/carousel/carousel.php"); ?>

            <div class="card my-3 p-3" style="max-width: auto;">
                <div class="row no-gutters">
                    <div class="col-4">
                        <img class="card-img w-100" src="<?php printf("%s%s", constant("cFurniture"), "images/news.png"); ?>" alt="" style="max-height: 300px;" />
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title"> Uma campanha de prêmios para você! </h5>
                            <p class="card-text"> De julho a dezembro de 2022, suas vendas de produtos Santher valem Hots
                                (moeda virtual) para trocar por prêmios incríveis aqui no site!
                                Confira o regulamento para ver as regras do seu perfil e quantos pontos pode
                                acumular! Fique de olho também nos aceleradores e quizzes, que podem
                                render pontuação extra para você!
                                Não perca tempo, participe e conquiste suas premiações!</p>
                            <a class="btn btn-success pull-right" href="">Ver mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>