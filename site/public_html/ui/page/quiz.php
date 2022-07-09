<main class="container">
    <div class="row my-3 mx-3">
        <div class="col-12 col-sm-12 col-xs-12 col-lg-2">
            <?php include(constant("cRootServer") . "ui/includes/cards/card_infos.php"); ?>
        </div>

        <div class="col-12 col-sm-12 col-xs-12 col-lg-10 padding-left-20  xs-padding-left-0 xs-margin-top-20">
            <div class="row">
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 p-3 d-flex content-header">Quizzes</div>
            </div>

            <div class="row">
                <div class="col-12 offset-1">
                    <?php
                    if (!empty($data[0]["catalogo"])) {
                    ?>
                        <div className="mb-3">
                            <div className="col-lg-12  offset-md-2">
                                <div className="text-center mb-3">
                                    <a target="_blank" href="/<?php print($data[0]["catalogo"]) ?>"><i class="fa fa-download" aria-hidden="true"></i> Baixar material de estudo</a>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!isset($data[0]["respostas_attach"][0])) {
                        print('<form action="' . sprintf($GLOBALS["quiz_url"], $info["slug"]) . '" method="POST" className="mb-3">');
                    } else {
                        print('<div className="mb-3">');
                    }
                    ?>
                    <div className="col-lg-12 offset-md-2">
                        <div className='card has-loading'>
 
                            <div className="card-body pb-0">
                                <?php
                                $questions = unserialize($data[0]["questions"]);
                                foreach ($questions["data"] as $k => $v) {
                                ?>
                                    <div className="accordion-item" id="item_<?php print($k) ?>" style="border: 1px solid #707070;border-radius: 25px;padding: 15px;margin: 5px;">
                                        <h6 className="accordion-header"><?php print($v["pergunta"]) ?></h6>
                                        <?php
                                        foreach ($v["resposta"] as $r => $s) {
                                            if (isset($data[0]["respostas_attach"][0])) {
                                        ?>
                                                <div className="form-check" id="key_<?php print($k) ?>" style="display: flex;align-items: baseline;">
                                                    <?php
                                                    if ($v["correct"] == $r) {
                                                    ?>
                                                        <svg style="min-width:16px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#198754" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                                        </svg>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <svg style="min-width:16px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FF0000" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    <?php
                                                    }
                                                    ?>
                                                    <label className="form-check-label" style="margin-left: 15px;"><?php print($s["text"]) ?></label>

                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div className="form-check" id="key_<?php print($k) ?>" style="display: flex;align-items: baseline;">
                                                    <input type="radio" name="<?php print('resposta[' . $k . ']') ?>" className="form-check-input me-2" value="<?php print($r) ?>" id="<?php print('resposta_' . $r) ?>">
                                                    <label className="form-check-label" for="<?php print('resposta_' . $r) ?>" style="margin-left: 15px;"><?php print($s["text"]) ?></label>
                                                </div>
                                            <?php
                                            }
                                        }
                                        if (isset($data[0]["respostas_attach"][0])) {
                                            $resposta = unserialize($data[0]["respostas_attach"][0]["resposta"]);
                                            ?>
                                            <hr />
                                            <h6>Sua resposta foi:</h6>
                                            <?php print_r($v["resposta"][$resposta[$k]]["text"]) ?>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <br><br>
                        </div>
                        <div className="card-footer d-flex justify-content-between">
                            <a href="<?php print($GLOBALS["quizes_url"]) ?>" class="btn btn-secondary">Voltar</a>
                            <?php
                            if (!isset($data[0]["respostas_attach"][0])) {
                                print('<button type="submit" name="btn_save" class="btn btn-success">Finalizar</button>');
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if (!isset($data[0]["respostas_attach"][0])) {
                        print('</form>');
                    } else {
                        print('</div>');
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>
</main>