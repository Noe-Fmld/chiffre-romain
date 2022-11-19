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

    require_once 'index.html';