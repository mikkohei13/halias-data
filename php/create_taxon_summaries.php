<?php
/*
FIN_name,SWE_name,ENG_name,Sci_name,Species_Abb,Species_code,Date,Day-of-Year,Year,Local,Migr,Stand,Additional,Observed,Night_migr
talitiainen,talgoxe,Great Tit,Parus major,PARMAJ,754,28.02.79,59,1979,2,0,0,NA,FALSE,NA
teeri,orre,Black Grouse,Tetrao tetrix,TETRIX,143,06.03.79,65,1979,1,0,0,NA,FALSE,NA
kalalokki,fiskmås,Mew Gull,Larus canus,LARCAN,438,06.03.79,65,1979,1,0,0,NA,FALSE,NA

*/

$limit = 1000000; // how many lines = observations to handle
$count = 0;

// TODO: remove species names, except for abbr

$handle = fopen("../data/Haliasdata_v1.0.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false && $count <= $limit) {

        if (0 == $count) { $count++; continue; } // Skip header row

        $lineArr = explode(",", $line);
        $dateArrDMY = explode(".", $lineArr[6]);

        // Fill in missing millennium & century
        if ($dateArrDMY[2] >= 70) {
            $dateArrDMY[2] = 1900 + $dateArrDMY[2];
        }
        else
        {
            $dateArrDMY[2] = 2000 + $dateArrDMY[2];
        }
        $dateYMD = $dateArrDMY[2] . "-" . $dateArrDMY[1] . "-" . $dateArrDMY[0];

        $taxonNonwhitespace = str_replace(" ", "_", $lineArr[4]);
        $taxonNonwhitespace = str_replace("/", "+", $taxonNonwhitespace);
        $taxonNonwhitespace = str_replace(".", "-", $taxonNonwhitespace);

        // Remove taxa names execpt for abbr 
//        $clipPosition = strpos($line, ",", 3);
//        $line = substr($line, $clipPosition);
 
        $line = substrFromNth($line, ",", 4);

        $dir = "../data/taxa/";
        file_put_contents(($dir."/".$taxonNonwhitespace.".csv"), $line, FILE_APPEND);
        
        $count++;
    }

    fclose($handle);
} else {
    echo "Error opening the file";
}

// Function by Galled
// https://stackoverflow.com/questions/5956066/how-to-split-a-string-in-php-at-nth-occurrence-of-needle
function substrFromNth($string,$needle,$nth){
    $max = strlen($string);
    $n = 0;
    for($i=0;$i<$max;$i++){
        if($string[$i]==$needle){
            $n++;
            if($n>=$nth){
                break;
            }
        }
    }
    return substr($string,$i+1,$max);
}