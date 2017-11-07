<?php

$limit = 1000000;
$count = 0;

$recordCount = 0;
$taxa = Array();

$handle = fopen("../data/Haliasdata_v1.0.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false && $count <= $limit) {
        $thisTaxa = returnNamesAsArray($line);
        $taxa[$thisTaxa[4]]['count']++; 
        $taxa[$thisTaxa[4]]['names'] = $thisTaxa; 

        $count++;
        $recordCount++;
    }

    fclose($handle);
} else {
    echo "Error opening the file";
} 

//echo "recordCount=" . ($recordCount - 2) . "\n"; // -2 because data contains header row and empty last row

// Output JSON
print_r (json_encode($taxa));

// Output CSV
/*
foreach ($taxa as $abbr => $data) {
    echo $data['names'][4] . ",";
    echo $data['names'][0] . ",";
    echo $data['names'][1] . ",";
    echo $data['names'][2] . ",";
    echo $data['names'][3] . ",";
    echo $data['names'][5] . ",";
    echo $data['count'];
    echo "\n";
}
*/

// ---------------------------------------------------------------------------

function returnTaxonAbbr($line) {
    $arr = explode(",", $line);
    return $arr[4];
}

function returnNamesAsArray($line) {
    $arr = explode(",", $line);

    // Remove non-taxon cells
    for ($i = 6; $i <= 14; $i++) {
        unset($arr[$i]);
    }
    return $arr;
}

