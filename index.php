<?php
include 'classes/ProverbeManager.class.php';
include_once 'classes/Proverbe.class.php';
include 'includes/header.php';

function connect() {
    $db = new PDO('mysql:host=localhost;dbname=proverbe', 'root', '');
    return $db;
}

function getCategory() {
    $db = connect();
    $query = $db->prepare('SELECT * FROM category');
    $query->execute();
    return $query->fetchAll();
}

$title = 'TP ProverbeApp';
$categories = getCategory();

?>

<h1><?php echo $title; ?></h1>
<p>Choisissez un thème et cliquez sur le bouton pour obtenir un proverbe</p>

<div ng-controller="mainCtrl">
    <div>
        <select ng-model="prv">
            <option value="">Choisissez un thème</option>
            <?php 
                foreach($categories as $category) {
                    echo '<option value="' . $category['id'] . '">' . $category['nom'] . '</option>';
                }
            ?>
        </select>

        <button ng-click="getProverb()" class="btn btn-primary btn-xs">Charger un proverbe</button>
        <button ng-click="reset()" class="btn btn-warning btn-xs">Reset</button>
    </div>

    <br>

    <div ng-show="affMode">
        <span id="content">"{{prov.body}} ({{prov.origin}})"</span>
        <button ng-click="deleteThisProverb()" class="btn btn-danger btn-xs">Supprimer</button>
    </div>

</div>

<?php include 'includes/footer.php'; ?>