<?php 
include 'MagicParser.php';

$cata = 'catalogue.xml';

function handleRecord($record) {
    print_r($record);
    return true;
}

if (MagicParser($cata, 'handleRecord', 'xml')){
    echo "L'analyse XML a été effectuée avec succès.";
} else {
    echo "Une erreur s'est produite lors de l'analyse XML.";
}

$servername = "localhost";
$username = "votre_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "votre_base_de_donnees";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$xml = '
 < HF_DOCUMENT >
<!-- Contenu XML -->

</HF_DOCUMENT>';

$xmlObject = simplexml_load_string($xml);

$fLigne = $xmlObject -> fLigne;

$produit_pocleunik = $fLigne -> PRODUIT_POCLEUNIK;
$produit_ref = $fLigne -> PRODUIT_REF;
$refciale_arcleunik = $fLigne -> REFCIALE_ARCLEUNIK;
/* ... */

$sql = "INSERT INTO produits (produit_pocleunik, produit_ref, refciale_arcleunik)
        VALUES ('$produit_pocleunik', '$produit_ref', '$refciale_arcleunik')";

if (mysqli_query($conn, $sql)) {
    echo "Données insérées avec succès.";
} else {
    echo "Erreur lors de l'insertion : " . mysqli_error($conn);
}

mysqli_close($conn);


$xml = new MagicParser();
$xml->open('catalogue.xml'); 

foreach ($xml->catalogue->produit as $produit) {
    $name = $conn->real_escape_string($product->name);
    $price = (float) $product->price;
    $description = $conn->real_escape_string($product->description);
    $category = $conn->real_escape_string($product->category);

    $sql = "INSERT INTO catalogue_data (product_name, product_price, product_description, product_category)
            VALUES ('$name', $price, '$description', '$category')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

echo "Données insérées avec succès!";
?>
