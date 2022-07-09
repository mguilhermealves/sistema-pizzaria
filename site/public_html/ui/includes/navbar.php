<div class="row">
    <div class="col-12 xs-only"> 
      <div class="menu-mobile">
              <button class="icon btnMobile" onclick="menu()">
                  <i class="fa fa-bars"></i>
              </button>

              <div class="menu-toogle">

                  <button class="icon icon-close btnMobile" onclick="menu()">
                      <i class="fa fa-close"></i>
                  </button>

                  <figure>
                      <a href="/">
                          <img src="<?php printf("%s%s",constant("cFurniture"),"images/footer/footer.png")?>" />
                      </a>
                  </figure>

                  <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                      <li class="nav-item active">
                          <a class="nav-link" href="<?php print($GLOBALS["home_url"])?>">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php print($GLOBALS["regulamento_url"])?>">Regulamento</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php print($GLOBALS["noticias_url"]) ?>">Mural de notícias</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php print($GLOBALS["metas_url"]) ?>">Metas e Resultados</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php print($GLOBALS["quizes_url"]) ?>">Quizzes</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php print($GLOBALS["extrato_url"]) ?>">Extrato de PONTOS</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php print($GLOBALS["premiacoes_url"]) ?>">Portal de Premios</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php print( $GLOBALS["contato_url"] ) ?>">Contato</a>
                      </li>
                  </ul>
              </div>
      </div>
    </div>
  </div>

<nav class="navbar navbar-expand-lg navbar-dark bg-custom xs-gone">
    
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>

    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?php print($GLOBALS["home_url"])?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print($GLOBALS["regulamento_url"])?>">Regulamento</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print($GLOBALS["noticias_url"]) ?>">Mural de notícias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print($GLOBALS["metas_url"]) ?>">Metas e Resultados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print($GLOBALS["quizes_url"]) ?>">Quizzes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print($GLOBALS["extrato_url"]) ?>">Extrato de PONTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print($GLOBALS["premiacoes_url"]) ?>">Portal de Premios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print( $GLOBALS["contato_url"] ) ?>">Contato</a>
            </li>
        </ul>
    </div>
</nav>