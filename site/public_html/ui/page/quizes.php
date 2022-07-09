<main class="container">
   <div class="row my-3 mx-3">
      <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
         <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
      </div>

      <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20  xs-padding-left-0 xs-margin-top-20">
         <div class="row">
            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">Quizzes</div>
         </div>

               <div class="row mt-4 quizz-list">
                  <div class="col-lg-12 card py-4 px-4">

                  <div class="row padding-bottom-20 title-page">
                     <div class="col-lg-12">
                        <h2>Participe dos quizzes e ganhe pontos extras!</h2>
                        <h3>Lembre-se: você tem uma chance em cada questão.</h3>
                     </div>
                  </div>

                     <div class="row">
                           <?php
                              $i = 1;
                              foreach ($data as $k => $v) {
                                 $questions = unserialize($v["questions"]);
                              ?>
                                 <div class="col-lg-6">               
                                    <div class="row  p-2">
                                       <div class="col-lg-12 card">
                                          <div class="row head-card">
                                             <div class="col-lg-2 text-center py-3 number"><?php print(strlen($i) > 1 ? $i : '0'.$i) ?></div>
                                             <div class="col-lg-10 py-2 vertical-middle px-3 head">
                                                <a href="<?php printf($GLOBALS["quiz_url"], $v["slug"]) ?>">
                                                   <?php print($v["name"]) ?>
                                                </a>
                                             </div>
                                          </div>

                                             <div class="row pt-3 cards-mini">
                                                <div class="col-lg-3 px-2 text-center xs-margin-bottom-10">
                                                   <div class="card h-100">
                                                      <div class="head vertical-middle horizontal-center">Grupo</div>
                                                      <div class="value vertical-middle horizontal-center"><?php print($v["level"]) ?></div>
                                                   </div>                                                
                                                </div>
                                                <div class="col-lg-3 px-2 text-center xs-margin-bottom-10">
                                                   <div class="card h-100">
                                                      <div class="head  vertical-middle horizontal-center">Total de perguntas</div>
                                                      <div class="value vertical-middle horizontal-center"><?php print(count($questions["data"])) ?></div>   
                                                   </div>                                                
                                                </div>
                                                <div class="col-lg-3 px-2 text-center xs-margin-bottom-10">
                                                   <div class="card h-100">
                                                      <div class="head  vertical-middle horizontal-center">Total Pontos Possíveis</div>
                                                      <div class="value vertical-middle horizontal-center"><?php print($v["points"]) ?></div>   
                                                   </div>      
                                                </div>
                                                <div class="col-lg-3 px-2 text-center xs-margin-bottom-10">
                                                   <div class="card h-100">
                                                      <div class="head  vertical-middle horizontal-center">Data</div>
                                                      <div class="value vertical-middle horizontal-center"><?php print(isset($v["respostas_attach"][0]) ? preg_replace("/^(....).(..).(..).(.....).+/", "$3/$2/$1", $v["respostas_attach"][0]["created_at"]) : '-') ?></div>   
                                                   </div>      
                                                </div>
                                             </div>

                                             <div class="row pt-3 pb-2">
                                                   <div class="col-lg-12 px-2">


                                                   <div id="accordion">
                                                         <div class="card wrapper-card">
                                                            <div class="card-header p-0" id="headingOne">
                                                               <h5 class="mb-0">
                                                               <button class="btn btn-link px-3 py-0 <?php print(isset($v["respostas_attach"][0]) ? 'result' : '') ?>" data-toggle="collapse" data-target="#<?php print($v["slug"]) ?>" aria-expanded="true" aria-controls="<?php print($v["slug"]) ?>" <?php print(isset($v["respostas_attach"][0]) ? '' : 'disabled') ?>>
                                                               <?php print(isset($v["respostas_attach"][0]) ? 'Resultado do QUIZ' : 'QUIZ pendente') ?>
                                                            
                                                               <img src="<?php printf("%s%s",constant("cFurniture"),"images/seta.svg")?>" />
                                                               </button>
                                                               </h5>
                                                            </div>

                                                            <div id="<?php print($v["slug"]) ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                                               <div class="card-body">
                                                                  <div class="row cards-mini">
                                                                     <div class="col-lg-3 px-2 text-center xs-margin-bottom-10">
                                                                        <div class="card h-100">
                                                                           <div class="head vertical-middle horizontal-center">Total de Acerto</div>
                                                                           <div class="value vertical-middle horizontal-center">
                                                                              <?php print(isset($v["respostas_attach"][0]) ? (int)$v["respostas_attach"][0]["acertos"] : '') ?>
                                                                           </div>
                                                                        </div>                                                
                                                                     </div>
                                                                     <div class="col-lg-4 px-2 text-center xs-margin-bottom-10">
                                                                        <div class="card h-100">
                                                                           <div class="head vertical-middle horizontal-center">Pontos Conquistados</div>
                                                                           <div class="value vertical-middle horizontal-center">
                                                                              <?php print(isset($v["respostas_attach"][0]) ? $v["respostas_attach"][0]["pontos"] : '') ?>
                                                                           </div>
                                                                        </div>                                                
                                                                     </div>
                                                                     <div class="col-lg-3 px-2 text-center xs-margin-bottom-10">
                                                                        <div class="card h-100">
                                                                           <div class="head vertical-middle horizontal-center">Gabarito</div>
                                                                           <div class="value vertical-middle horizontal-center"><a href="<?php printf($GLOBALS["quiz_url"], $v["slug"]) ?>">ver resultado</a></div>
                                                                        </div>                                                
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                   </div>






                                                   
                                                   </div>
                                             </div>

                                       </div>
                                       
                                    </div>
                                 </div>                               
                              <?php
                                 $i++;
                              }
                              ?>

                      </div>
                  </div>
               </div>
                  
              
         </div>
      </div>
</main>


<div class="modal fade bd-example-modal-lg" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <a href="<?php print( sprintf($GLOBALS["quiz_url"], $info["get"]["send"]) ); ?>">
            <img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/pop-up-quizrespondido.png"); ?>" alt="" style=" width: 500px; margin-top: 100px;"/>
         </a>
      </div>
   </div>
</div>


<style>

.modal-content {
    background: top;
    border: none;
    align-items: center;
  }

   @media (min-width: 768px) {
      .mobileQuiz {
         display: none;
      }
   }

   @media (max-width: 767px) {
      .dataTable {
         display: none;
      }

      .quizzes-page p {
         font-size: 25px;
      }
   }

   .mobileQuizzes {
      width: 100%;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 6px rgba(0, 0, 0, 0.57);
   }

   .titleQuiz {
      font-size: 1.5rem;
      font-weight: bold;
   }

   .contentQuiz {
      font-size: 1.25rem;
      color: red;
   }

   .contentQuiz a {
      text-decoration: none;
      color: var(--primary-color);
      font-weight: bold;
   }

   .contentQuiz a:hover {
      color: var(--primary-ascent-color);
   }
</style>