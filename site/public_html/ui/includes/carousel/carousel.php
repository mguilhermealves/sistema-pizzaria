<div id="carouselId" class="col-12 carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
        <li data-target="#carouselId" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php $i = 0; foreach($banners->data as $k => $v){ ?>
            <div class="carousel-item <?php print($i == 0 ? 'active' : '') ?>">
                <img class="img-fluid" style="width: 100%;" src="<?php printf("%s%s", constant("cFrontend"),  $v["img"]); ?>" alt="" />
            </div>
        <?php $i++; } ?>                
    </div>
    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>