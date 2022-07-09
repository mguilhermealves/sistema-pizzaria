<!-- <?php
      if ($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["idx"] == 4) {
         $dic = array(
            "Gerente de Contas" => array(
               "1" => "Cumprimento do Sell out em valor do trimestre da regional", "2" => "Positivação geral da regional – média mês do trimestre", "3" => "Cumprimento da PV do trimestre – venda do Mix planejado", "4" => "Cumprimento do Sell In do trimestre em valor"
            ), "GER CONTAS ESPECIAIS VET" => array(
               "1" => "Cumprimento do Sell out em valor do trimestre", "2" => "Crescimento do Sell In (em relação ao mesmo período do ano anterior)", "3" => "Cumprimento da PV do trimestre – venda do Mix planejado", "4" => "Cumprimento do Sell In do trimestre em valor"
            ), "Coordenador(a) Comercial" => array(
               "1" => "Cumprimento do Sell out em valor do trimestre da regional", "2" => "Positivação geral da regional – média mês do trimestre", "3" => "Crescimento do sell out em relação ao mesmo período do ano anterior", "4" => "Cumprimento do Sell In do trimestre em valor"
            ), "COORD CONTAS ESPECIAIS VET" => array(
               "1" => "Cumprimento do Sell out em valor do trimestre", "2" => "Aumento do ticket médio (%) valor Sell Out/nº de lojas de redes (em relação ao trimestre anterior)", "3" => "Crescimento do Sell Out em relação ao mesmo período do ano anterior", "4" => "Cumprimento do Sell In do trimestre em valor"
            ), "PROMOTOR VET" => array(
               "1" => "Cumprimento do Sell out em valor do trimestre", "2" => "Aumento do ticket médio (%) valor Sell Out/nº de lojas de redes (em relação ao trimestre anterior)", "3" => "Crescimento do Sell Out em relação ao mesmo período do ano anterior", "4" => "Cumprimento do Sell In do trimestre em valor"
            )
         );
      }
      if ($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["idx"] == 5) {
         $dic = array(
            "Supervisor(a)" => array(
               "1" => "Cumprimento do Sell out da distribuidora em valor do trimestre", "2" => "Positivação da distribuidora – média mês do trimestre", "3" => "Cumprimento das linhas em valor (por linha participante)"
            ), "Promotor(a)" => array(
               "1" => "Cumprimento do Sell out da distribuidora em valor do trimestre;", "2" => "Positivação da distribuidora – média mês do trimestre", "3" => "Cumprimento das linhas em valor (por linha participante"
            ), "Vendedor(a)" => array(
               "1" => "Cumprimento do Sell out em valor do trimestre;", "2" => "Positivação – média mês do trimestre;", "3" => "Cumprimento das linhas em valor (por linha participante)"
            )
         );
      }
      if ($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["idx"] == 7) {
         $dic = array(
            "Coordenador" => array(
               "1" => "Cumprimento do Sell out em valor da área espelho do trimestre do setor distribuidor (percentual de atingimento x 10) ", "2" => "MDV - Média de visitas diárias do setor (trimestre) – objetivo 100% = 10 (percentual de atingimento x 10)", "3" => "Qualidade do painel - percentual de veterinários classificados como 3 estrelas e diamante dentro do painel geral (percentual x 10);"
            ), "Consultor" => array(
               "1" => "Realização de um dia de prescrição dentro do ciclo, com ações direcionadas para maior oportunidade dentro dos produtos do ciclo dentro deste cliente. Meta: dois eventos/ ciclo = a meta (percentual X 10)", "2" => "MDV - Média de visitas diárias do setor – objetivo 100% = 10 (percentual de atingimento x 10)", "3" => "Qualidade do painel - percentual de veterinários classificados como 3 estrelas e diamante dentro do painel geral (percentual x 10);"
            ), "Propagandista" => array(
               "1" => "Cumprimento do Sell out em valor da área espelho do trimestre do setor (distribuidores - percentual de atingimento x 10);", "2" => "MDV - Média de visitas diárias do setor – objetivo 100% = 10 (percentual de atingimento x 10)", "3" => "Qualidade do painel - percentual de veterinários classificados como 3 estrelas e diamante dentro do painel geral (percentual x 10)"
            )
         );
      }
      ?>
<main class="main-section">
   <div class="goals-and-results-page">
      <div class="container">
         <div class="content-header d-flex justify-content-center mt-5">
            <h1 class="mb-0">Metas e Resultados</h1>
         </div>         
         <hr>
         <div class="content-header d-flex justify-content-center"><p>Confira aqui suas metas trimestrais e os resultados atingidos até o momento.</p></div>
         <div class="period">
            <div class="input-group">
               <label class="input-group-text" for="period-input">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M880 184H712v-64c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v64H384v-64c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v64H144c-17.7 0-32 14.3-32 32v664c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V216c0-17.7-14.3-32-32-32zm-40 656H184V460h656v380zM184 392V256h128v48c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-48h256v48c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-48h128v136H184z"></path>
                  </svg>
                  Selecione o trimestre
               </label>
               <select class="form-select" id="period-input">
                  <option value="1">1º trimestre</option>
                  <option value="2">2º trimestre</option>
                  <option value="3">3º trimestre</option>
                  <option value="4">4º trimestre</option>
               </select>
            </div>
         </div>
         

         <?php
         $key_dic = $_SESSION[constant("cAppKey")]["credential"]["position"];
         ?>
         <div class="row">
            <div class="col-12 col-md-6">
               <?php for ($xTrimeste = 1; $xTrimeste <= 4; $xTrimeste++) {  ?>
               <div id="tbl<?php print($xTrimeste) ?>" <?php print($xTrimeste > 1 ? 'style="display:none"' : '') ?> class="quarter">
                  <div id="header_4" class="title"><?php print($xTrimeste) ?>º Trimestre</div>
                     <div class="inner-content">
                     <?php
                     foreach ($dic[$key_dic] as $kdiv => $vdic) {
                     ?>
                        <div class="dropdown-rule">
                           <div class="title"><span><?php print($vdic) ?> </span></div>
                           <div class="results">
                           <?php
                           if (isset($array[$xTrimeste]["data"][$kdiv])) {
                              foreach ($array[$xTrimeste]["data"][$kdiv]["infos"] as $kdata => $vdata) {
                                 printf('<div class="extra-rules"><div>%s</div><div>%s</div></div>', "" /*$vdata["name"]*/, $vdata["points"]);
                              }
                           } else {
                              print('<span>Não há dados a serem apresentados.</span>');
                           }
                           ?>
                           </div>
                        </div>
                     <?php
                     }
                     ?>
                        <div class="dropdown-rule">
                           <div class="title"><span><strong>Bônus de pontos</strong></span></div>
                           <div class="results">
                              <?php
                              if (isset($array[$xTrimeste]["data"]["bonus"])) {
                                 foreach ($array[$xTrimeste]["data"]["bonus"]["infos"] as $kdata => $vdata) {
                                    printf('<div class="extra-rules"><div>%s - %s</div><div>%s</div></div>', $vdata["ref"],  $vdata["name"], $vdata["points"]);
                                 }
                              } else {
                                 print('<span>Não há dados a serem apresentados.</span>');
                              }
                              ?>
                           </div>
                        </div>
                  </div>
               </div>
               <?php
               }
               ?>
            </div>
         </div>
      </div>
   </div>         
</main>
<style>
   .results .extra-rules{ display: flex; justify-content: space-between; align-items: center; }
</style> -->

<main class="container">
   <div class="row my-3 mx-3">
      <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
         <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
      </div>

      <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20 xs-padding-left-0 xs-margin-top-20">
         <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">
            <h1 class="mb-0 regulamento">Metas e Resultados</h1>
         </div>

         <div class="row pt-4">
            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 card py-4 px-4">

               <div class="row padding-bottom-20 title-page">
                  <div class="col-lg-12">
                     <h2>Confira seu desempenho na campanha.</h2>
                     <h3></h3>
                  </div>
               </div>

               <div class="row">
               <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Janeiro">Jan</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Fevereiro">Fev</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Março">Mar</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Abril">Abr</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Maio">Mai</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Junho">Jun</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Julho">Jul</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Agosto">Ago</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Setembro">Set</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Outubro">Out</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Novembro">Nov</a>
                  </div>

                  <div class="col-1">
                     <a class="btn btn-secondary" href="#" role="button" title="Dezembro">Dez</a>
                  </div>

                  <div class="col-lg-12 my-2">
                     <hr>
                  </div>

                  <div class="col-lg-12 p-2 my-2">
                     <h1 class="mb-0 text-metas">Metas e Resultados</h1>
                  </div>

                  <div class="col-lg-3">
                     <div class="card text-white  mb-3" style="max-width: 18rem;">
                        <div class="card-header header-meta">Valor da meta</div>
                        <div class="card-body card-body-metas">
                           <h5 class="card-title card-metas-h5">00000</h5>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3">
                     <div class="card text-white mb-3" style="max-width: 18rem;">
                        <div class="card-header header-meta">Resultado</div>
                        <div class="card-body card-body-metas">
                           <h5 class="card-title card-metas-h5">00000</h5>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3">
                     <div class="card text-white mb-3" style="max-width: 18rem;">
                        <div class="card-header header-meta">% atingido</div>
                        <div class="card-body card-body-metas">
                           <h5 class="card-title card-metas-h5">00%</h5>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3">
                     <div class="card text-white mb-3" style="max-width: 18rem;">
                        <div class="card-header header-meta">Pontos conquistados</div>
                        <div class="card-body card-body-metas">
                           <h5 class="card-title card-metas-h5">00000</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>


      </div>
   </div>
</main>