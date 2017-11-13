<?php

$limit = 100;
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

        // Create directory
        $dir = "../data/daily/".$dateArrDMY[2];
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents(($dir."/".$dateYMD.".csv"), $line, FILE_APPEND);
        
        $count++;
    }

    fclose($handle);
} else {
    echo "Error opening the file";
}

/*
        elseif ("json" == $format) {
            $lineParts = explode(",", $line);
            $arr[$lineParts[4]]['date_dmy'] = $lineParts[6];
            $arr[$lineParts[4]]['Local'] = $lineParts[9];
            $arr[$lineParts[4]]['Migr'] = $lineParts[10];
            $arr[$lineParts[4]]['Stand'] = $lineParts[11];
            $arr[$lineParts[4]]['Additional'] = $lineParts[12];
            $arr[$lineParts[4]]['Observed'] = $lineParts[13];
            $arr[$lineParts[4]]['Night_migr'] = $lineParts[14];
        }

*/
