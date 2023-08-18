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

/* strucuture sql */
$sqlStructure = CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_pocleunik INT,
    produit_ref VARCHAR(255),
    refciale_arcleunik INT);

CREATE TABLE IF NOT EXISTS catalogue_data(
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255),
    product_price DECIMAL(10, 2),
    product_description TEXT,
    product_category VARCHAR(255)
);

/* Exec de la créa structure SQL*/ 

if (mysqli_multi_query($conn, $sqlStructure)) {
    echo "Structure SQL créée avec succès.";
} else {
    echo "Erreur lors de la création de la structure SQL : ".mysqli_error($conn);
}

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
