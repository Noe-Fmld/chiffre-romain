<?php
    $resultCh = 0;
    $resultCh1 = 0;
    $resultCh2 = 0;
    $resultRom = "";
    $errorLetters = [];
    $errorMsg = '';
    $chiffres = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000,
    ];
    if (array_key_exists('chr1', $_POST) && array_key_exists('chr2', $_POST)){
        $chr1 = $_POST['chr1'];
        $chr2 = $_POST['chr2'];
        $c1 = str_split($chr1);
        $c2 = str_split($chr2);
        foreach ($c1 as $k1 => $v1){
            if (!array_key_exists($v1, $chiffres)){
                if (!in_array($v1, $errorLetters)){
                    $errorLetters[] = $v1;
                }
            }
        }
        foreach ($c2 as $k2 => $v2){
            if (!array_key_exists($v2, $chiffres)){
                if (!in_array($v2, $errorLetters)){
                    $errorLetters[] = $v2;
                }
            }
        }
        if (empty($errorLetters)){
            $index = -1;
            foreach ($c1 as $k1 => $v1){
                $resultCh1 += $chiffres[$v1];

                if (($v1 == 'X' || $v1 == 'V') && $index != -1){
                    if ($c1[$index] == 'I'){
                        $resultCh1 -= 2* $chiffres['I'];
                    }
                } elseif (($v1 == 'L' || $v1 == 'C') && $index != -1){
                    if ($c1[$index] == 'X'){
                        $resultCh1 -= 2* $chiffres['X'];
                    }
                } elseif (($v1 == 'D' || $v1 == 'M') && $index != -1){
                    if ($c1[$index] == 'C'){
                        $resultCh1 -= 2* $chiffres['C'];
                    }
                }

                $index++;
            }

            $index = -1;
            foreach ($c2 as $k2 => $v2){
                $resultCh2 += $chiffres[$v2];

                if (($v2 == 'X' || $v2 == 'V') && $index != -1){
                    if ($c2[$index] == 'I'){
                        $resultCh2 -= 2* $chiffres['I'];
                    }
                } elseif (($v2 == 'L' || $v2 == 'C') && $index != -1){
                    if ($c2[$index] == 'X'){
                        $resultCh2 -= 2* $chiffres['X'];
                    }
                } elseif (($v2 == 'D' || $v2 == 'M') && $index != -1){
                    if ($c2[$index] == 'C'){
                        $resultCh2 -= 2* $chiffres['C'];
                    }
                }

                $index++;
            }

            $resultCh = $resultCh1 + $resultCh2;
            $resultCopie = $resultCh;

            if ($resultCh <= 4999){

                while ($resultCopie != 0){
                    if ($resultCopie == 4){
                        $resultRom .= 'IV';
                        $resultCopie -= 4;
                        continue;
                    } elseif ($resultCopie == 9){
                        $resultRom .= 'IX';
                        $resultCopie -= 9;
                        continue;
                    } elseif ($resultCopie >= 40 && $resultCopie <= 49){
                        $resultRom .= 'XL';
                        $resultCopie -= 40;
                        continue;
                    } elseif ($resultCopie >= 90 && $resultCopie <= 99){
                        $resultRom .= 'XC';
                        $resultCopie -= 90;
                        continue;
                    } elseif ($resultCopie >= 400 && $resultCopie <= 499){
                        $resultRom .= 'CD';
                        $resultCopie -= 400;
                        continue;
                    } elseif ($resultCopie >= 900 && $resultCopie <= 999){
                        $resultRom .= 'CM';
                        $resultCopie -= 900;
                        continue;
                    }


                    if ($resultCopie >= $chiffres['M']){
                        $resultRom .= 'M';
                        $resultCopie -= $chiffres['M'];
                    } elseif ($resultCopie >= $chiffres['D']){
                        $resultRom .= 'D';
                        $resultCopie -= $chiffres['D'];
                    } elseif ($resultCopie >= $chiffres['C']){
                        $resultRom .= 'C';
                        $resultCopie -= $chiffres['C'];
                    } elseif ($resultCopie >= $chiffres['L']){
                        $resultRom .= 'L';
                        $resultCopie -= $chiffres['L'];
                    } elseif ($resultCopie >= $chiffres['X']){
                        $resultRom .= 'X';
                        $resultCopie -= $chiffres['X'];
                    } elseif ($resultCopie >= $chiffres['V']){
                        $resultRom .= 'V';
                        $resultCopie -= $chiffres['V'];
                    } else{
                        $resultRom .= 'I';
                        $resultCopie -= $chiffres['I'];
                    }

                }
            } else
                $errorMsg = 'Résultat trop grand !';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculatrice chiffre romain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>
<body class="bg-secondary">
    
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
              <div class="card rounded-3">
                <div class="card-body p-4">
                  <h4 class="text-center my-3">Bienvenue sur une calculatrice de chiffre romain !</h4>
                  <h6 class="text-center my-3" id="maj">Seules les lettres I, V, X, L, C, D et M sont autorisées.</h6>
                  <div class="container-fluid">
                    <div class="row d-inline justify-content-center">
                        <form name="form" action="" method="post">
                            <div>
                                <label for="chr1">Premier chiffre romain :</label>

                                <input type="text" id="chr1" name="chr1" required>
                            </div>
                            <div>
                                <label for="chr2">Second chiffre romain :</label>

                                <input type="text" id="chr2" name="chr2" required>
                            </div>
                            <div>
                                <br>
                                <button id="valider" class="btn btn-primary" type="submit">Calculer</button>
                            </div>
                        </form>
                    </div>
                    <div class="row mt-5">
                        <?php if ($errorLetters) : ?>
                            <p>La lettre saisie n'existe pas ! (
                                <?php foreach ($errorLetters as $error) : ?>
                                    <?= $error ?>
                                <?php endforeach ?>
                                )
                            </p>
                        <?php elseif ($errorMsg) : ?>
                            <p><?= $errorMsg ?></p>
                        <?php elseif ($resultCh) : ?>
<!--                            <p>Ch 1 : --><?//= $resultCh1 ?><!--</p>-->
<!--                            <hr>-->
<!--                            <p>Ch 2 : --><?//= $resultCh2 ?><!--</p>-->
<!--                            <hr>-->
                            <p>Le résultat est : <?= $resultRom ?> (<?= $resultCh ?>)</p>
                        <?php endif ?>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>






    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/fr.min.js" integrity="sha512-RAt2+PIRwJiyjWpzvvhKAG2LEdPpQhTgWfbEkFDCo8wC4rFYh5GQzJBVIFDswwaEDEYX16GEE/4fpeDNr7OIZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="main.js"></script>
</body>
</html>