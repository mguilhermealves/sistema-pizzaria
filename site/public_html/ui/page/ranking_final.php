<main class="main-section">
    <div class="points-statement-page">
        <div class="container">
            <div class="content-header d-flex justify-content-center mb-3 mt-5">
                <h1 class="mb-0">Ranking | Final</h1>
            </div>
            <hr>

            <div class="row">
                <div class="col-lg-6 mb-4 mt-4">
                    <div class="premiacao-final">
                        <h4>A premiação final pode ser sua!</h4>
                        <p>Os líderes do ranking final da campanha ganharão uma viagem
                            para gramado com acompanhante e all inclusive! Uma oportunidade para descansar
                            e curtir muito a vitória dos LOVERS AVERT!</p>
                        <img src="<?php printf("%s%s", constant("cFurniture"), "images/premio/1GRAMADOloversAvert.png"); ?>" class="img-fluid" alt="" />
                    </div>
                    <div class="navio-MSC mt-4">
                        <h4>Conheça a cidade de Gramado</h4>
                        <hr>
                        <div class="row">
                            <div class="col-5 text-right">
                                <p><strong> Snowland</strong><br>
                                    Cenário inédito no Brasil, onde
                                    a neve é a grande sensação.
                                    Atrações como: Vilarejo Alpino;
                                    Mirante Bela Vista com vista
                                    privilegiada da Montanha de Neve;
                                    e a Montanha de Neve
                                    com temperaturas
                                    que variam de -5°C e 3°C.</p>
                            </div>
                            <div class="col-7">
                                <img src="<?php printf("%s%s", constant("cFurniture"), "images/premio/2GRAMADOloversAvert2.png"); ?>" class="img-fluid" alt="" />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-7 mt-5">
                                <img src="<?php printf("%s%s", constant("cFurniture"), "images/premio/3GRAMADOloversAvert3.png"); ?>" class="img-fluid" alt="" />
                            </div>

                            <div class="col-5 mt-5">
                                <p><strong>Mini Mundo Gramado</strong><br>
                                    Com inspiração nas crianças
                                    que pediam casas em miniaturas,
                                    o pequeno presente virou grande
                                    atração da cidade. Assim, com cidades
                                    inspiradas na Alemanha e Brasil,
                                    o que vemos são réplicas perfeitas
                                    e encantadoras.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 mt-5 text-right">
                                <p><strong>Passeio de Maria Fumaça</strong><br>
                                    Saindo de Gramado,a rota passa
                                    por mais três cidades em um
                                    trajeto de mais ou menos
                                    1h30.Durante o passeio você
                                    ainda pode degustar muitos
                                    tipos de vinhos, espumantes,
                                    queijos e outras delícias. .</p>
                            </div>
                            <div class="col-7 mt-5">
                                <img src="<?php printf("%s%s", constant("cFurniture"), "images/premio/4GRAMADOloversAvert4.png"); ?>" class="img-fluid" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mt-4">
                    <div class="dataTable">
                        <div class="columns">
                            <div class="column" style="max-width: 100px;"><button>Colocação</button></div>
                            <div class="column" style="max-width: 100%;"><button>Nome</button></div>
                            <div class="column" style="max-width: 100px;"><button>Pontos</button></div>
                        </div>
                        <?php

                        foreach ($rkn[1] as $v) {
                        ?>
                            <div class="columns" <?php print($v["idx"] == $_SESSION[constant("cAppKey")]["credential"]["idx"] ? 'style="border: 3px solid #0000ff"' : '') ?>>
                                <div class="column" style="max-width: 100px;"><?php print($rkn[0][$v["total"]] + 1) ?></div>
                                <div class="column" style="max-width: 100%;"><?php print($v["first_name"] . " " . $v["last_name"]) ?></div>
                                <div class="column" style="max-width: 100px;"><?php 
                                $p = explode("." , $v["total"] );
                                $p[1] = isset( $p[1] ) ? substr( $p[1] , 0 , 2 ) : "00" ;
                                print( $p[0] .".". $p[1] ); ?></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>