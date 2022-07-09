<main class="main-section">
	<img src="<?php printf("%s%s", constant("cFurniture"), "images/banner/01_abril.jpg"); ?>" alt="" />
    <div class="blog-page">
        <div class="row" >
            <div class="container col-2" style="background:url('/furniture/images/LoversAvertSelfie1.png') top center repeat-y transparent;">&nbsp;</div>
            <div class="container col-12 col-md-8" style="background:url('/furniture/images/elementosgameavert.png') top center no-repeat transparent;background-size:100% 100%">
                <article class="single-post">
                    <div class="row post-item featured">
                            <section class="col-12 memory-game">
								<?php
									foreach( array(
										"AminoCanis" => "AminoCanis.jpg"
										//, "AvertPositivo" => "avert_positivo.png"
										, "Avert" => "Avert.jpg"
										, "CaninusProtein" => "CaninusProtein.jpg"
										, "DemevertCaninus" => "DemevertCaninus.jpg"
										, "GlicopetCaninus" => "GlicopetCaninus.jpg"
										, "GlicopetFelinus" => "GlicopetFelinus.jpg"
										, "Hemolipet" => "Hemolipet.jpg"
										, "ProbioticoPet" => "ProbioticoPet.jpg"
									) as $k => $v ){
										print( strtr( '<div class="memory-card" data-framework="#name#"><img class="front-face" src="/furniture/game/#img#" alt="#name#" /><img class="back-face" src="/furniture/game/logo.png" alt="Lovers Avert" /></div><div class="memory-card" data-framework="#name#"><img class="front-face" src="/furniture/game/#img#" alt="#name#" /><img class="back-face" src="/furniture/game/logo.png" alt="Lovers Avert" /></div>' , array("#name#" => $k , "#img#" => $v ) ) ) ;
									}
								?>
							</section>
                    </div>
                </article>
            </div>
            <div class="container col-2" style="background:url('/furniture/images/LoversAvertSelfie2.png') top center repeat-y transparent;background-position-y:-160px">&nbsp;</div>
        </div>
    </div>
</main>
<style>.memory-game { /*width: 100%;*/ min-height: 640px; margin: auto; display: flex; justify-content: center; flex-wrap: wrap; perspective: 1000px; }.memory-card { width: 150px; height: 150px; margin: 5px; position: relative; transform: scale(1); transform-style: preserve-3d; transition: transform .5s; box-shadow: 1px 1px 1px rgba(0,0,0,.3); }.memory-card:active { transform: scale(0.97); transition: transform .2s; }.memory-card.flip { transform: rotateY(180deg); }.front-face,.back-face { width: 100%; height: 100%; padding: 20px; position: absolute; border-radius: 5px; background: #f0f0f0; backface-visibility: hidden; }.front-face { transform: rotateY(180deg); }</style>