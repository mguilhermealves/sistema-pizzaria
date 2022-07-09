<main class="container">
   <div class="row my-3 mx-3">
      <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
         <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>

         <div class="col-12 col-sm-12 col-xs-12 col-lg-12 xs-gone">
            <div class="card mb-2 py-5 px-3" style="max-width: auto;">
               <div>
                  <h6>Posts Recentes</h6>
               </div>

               <?php foreach($data_recent_news as $k => $v ) { ?>
                  <div class="row no-gutters">
                     <div class="col-md-12">
                        <img class="card-img img-thumbnail" src="<?php print($v["image"]) ?>" alt="" style="max-height: 300px;" />
                     </div>
                     <div class="col-md-12">
                        <div class="card-body">
                           <h5 class="card-title"> <?php print($v["name"]) ?> </h5>
                           <p class="card-text"> <?php print(mb_strimwidth($v["context"], 0, 50, " ...")); ?> </p>
                           <a class="" href="<?php printf($GLOBALS["noticia_url"], $v["slug"]); ?>">Ver mais</a>
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

      <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20  xs-padding-left-0 xs-margin-top-20">
         <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">Mural de notícias</div>

            <?php foreach($data_recent_news as $k => $v ) { ?>
            <div class="card my-3 p-3" style="max-width: auto;">
               <div class="row no-gutters">
                  <div class="col-lg-12">
                     <div class="card-body">
                     <img class="card-img img-thumbnail" src="<?php print($v["image"]) ?>" alt="" style="max-height: 300px;" />
                        <h5 class="card-title"> <?php print($v["name"]) ?> </h5>
                        <p class="card-text"> <?php print($v["context"]) ?> </p>
                        <a class="" href="<?php printf($GLOBALS["noticia_url"], $v["slug"]) ?>">Ver mais</a>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>
      </div>
</main>