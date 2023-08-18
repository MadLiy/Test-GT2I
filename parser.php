<?php
include 'MagicParser.php';

$cata = 'catalogue.xml';

function handleRecord($record) {
    
    print_r($record);
    return true;
}

if (Parser($cata, 'handleRecord', 'xml')){
    echo "L'analyse XML a été effectuée avec succès."; }
else {
    echo "Une erreur s'est produite lors de l'analyse XML."; }

?>

