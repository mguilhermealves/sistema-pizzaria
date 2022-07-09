<main class="main-section">
	<img src="<?php printf("%s%s", constant("cFurniture"), "images/banner/01_abril.jpg"); ?>" alt="" />
    <div class="blog-page">
        <div class="row" >
            <div class="container col-2" style="background:url('/furniture/images/LoversAvertSelfie1.png') top center repeat-y transparent;">&nbsp;</div>
            <div class="container col-12 col-md-8" style="background:url('/furniture/images/elementosgameavert.png') top center no-repeat transparent;background-size:100% 100%">
                <article class="single-post">
                    <div class="row post-item featured" style="min-height:70vh; display:block">
                        <div style="background:url('/furniture/images/telaparabensgamedamemoria.png') center center repeat transparent; background-size:cover; display:block; font-size:1.5rem;padding:2rem" class="col-md-8 offset-md-2 text-center" >Parabéns nesta tentativa você concluiu em <?php print( $data["tempo"] ) ?> com <?php print( $data["moviment"] ) ?> movimentos<br><br>
                            <!--a style="padding:1rem; border-radius: 10px;background-color: #e5891a;color:#FFFFFF;font-size:1.5rem" href="<?php print( $GLOBALS["game_ranking_url"] ) ; ?>">RANKING</a--><br><br><br><br>
                        </div>
                    </div>
                </article>
            </div>
            <div class="container col-2" style="background:url('/furniture/images/LoversAvertSelfie2.png') top center repeat-y transparent;background-position-y:-160px">&nbsp;</div>
        </div>
    </div>
</main>