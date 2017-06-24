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

$categ = getCategory();
?>

<h1>Ajouter un proverbe</h1>

<div ng-controller="mainCtrl">
    
    <label>Origine:</label>
    <input ng-model="proverbe.origin" type="text" placeholder="Origine">

    <label>Corps:</label>
    <input ng-model="proverbe.body" type="text" placeholder="Corps">

    <label>Catégorie:</label>
    <select ng-model="proverbe.category">
        <option value="">Choisissez un thème</option>
        <?php 
            foreach($categ as $c) {
                echo '<option value="' . $c['id'] . '">' . $c['nom'] . '</option>';
            }
        ?>
    </select>
    
    <button ng-click="saveProverb()" class="btn btn-primary btn-xs">Enregistrer</button>
    <button ng-click="reset2()" class="btn btn-warning btn-xs">Reset</button>

    <div ng-show="affMode2">
        <span id="message"></span>
    </div>

</div>

<?php include 'includes/footer.php'; ?>