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

$fLigne = $xmlObject - >fLigne;

$produit_pocleunik = $fLigne - >PRODUIT_POCLEUNIK;
$produit_ref = $fLigne - >PRODUIT_REF;
$refciale_arcleunik = $fLigne - >REFCIALE_ARCLEUNIK;
$refciale_refart = $fLigne - >REFCIALE_REFART;
$refciale_refcat = $fLigne - >REFCIALE_REFCAT;
$potrad_desi = $fLigne - >POTRAD_DESI;
$refciale_ctva = $fLigne - >REFCIALE_CTVA;
$fictech_memocat = $fLigne - >FICTECH_MEMOCAT;
$fictech_memonet = $fLigne - >FICTECH_MEMONET;
$produit_marque = $fLigne - >PRODUIT_MARQUE;
$produit_clep01 = $fLigne - >PRODUIT_CLEP01;
$produit_clep02 = $fLigne - >PRODUIT_CLEP02;
$produit_clep03 = $fLigne - >PRODUIT_CLEP03;
$produit_clep04 = $fLigne - >PRODUIT_CLEP04;
$produit_clep06 = $fLigne - >PRODUIT_CLEP06;
$produit_clep07 = $fLigne - >PRODUIT_CLEP07;
$produit_gcoloris = $fLigne - >PRODUIT_GCOLORIS;
$produit_gtaille = $fLigne - >PRODUIT_GTAILLE;
$produit_clep12 = $fLigne - >PRODUIT_CLEP12;
$refciale_ficheina = $fLigne - >REFCIALE_FICHEINA;
$refciale_modte = $fLigne - >REFCIALE_MODTE;
$produit_modte = $fLigne - >PRODUIT_MODTE;
$article_poids = $fLigne - >ARTICLE_POIDS;
$article_hnormel = $fLigne - >ARTICLE_HNORMEL;
$article_categ = $fLigne - >ARTICLE_CATEG;

$sql = "INSERT INTO produits (produit_pocleunik, produit_ref, refciale_arcleunik, refciale_refart,refciale_refcat,potrad_desi,refciale_ctva, fictech_memocat,fictech_memonet,produit_marque,produit_clep01,produit_clep02,produit_clep03,produit_clep04,produit_clep06,produit_clep07,produit_gcoloris,produit_gtaille,produit_clep12,refciale_ficheina,refciale_modte,produit_modte,article_poids,article_hnormel,article_categ)
        VALUES ('$produit_pocleunik', '$produit_ref', '$refciale_arcleunik','refciale_refart','refciale_refcat','potrad_desi','refciale_ctva','fictech_memocat','fictech_memonet','produit_marque','produit_clep01','produit_clep02','produit_clep03','produit_clep04','produit_clep06','produit_clep07',produit_gcoloris,'produit_gtaille','produit_clep12','refciale_ficheina','refciale_modte','produit_modte','article_poids','article_hnormel','article_categ')";

if (mysqli_query($conn, $sql)) {
    echo "Données insérées avec succès.";
} else {
    echo "Erreur lors de l'insertion : " . mysqli_error($conn);
}

mysqli_close($conn);


$xml = new MagicParser();
$xml->open('catalogue.xml'); 

foreach ($xml->catalogue->produit as $produit) {
    $name = $conn->real_escape_string($produit->name);
    $prix = (float) $produit->prix;
    $description = $conn->real_escape_string($produit->description);
    $categorie = $conn->real_escape_string($produit->categorie);

    $sql = "INSERT INTO catalogue_data (produit_name, produit_prix, produit_description, produit_categorie)
            VALUES ('$name', $prix, '$description', '$categorie')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

echo "Données insérées avec succès!";
?>
