<?php
include 'classes/ProverbeManager.class.php';
include_once 'classes/Proverbe.class.php';

$req_method = $_SERVER['REQUEST_METHOD'];

if ($req_method == 'GET') {

   switch ($_GET['action']) {
    case 'list':

        if(isset($_GET['cat'])) {
            
            $cat = $_GET['cat'];
            $pm = new ProverbeManager();
            echo json_encode($pm->getProvFromAjaxByCategory($cat));

        } 
        break;

    case 'delete':

        $pm = new ProverbeManager();

        if($pm->getById($_GET['id'])->delete()) {

            echo 'Proverbe supprimé';

        } else {

            echo 'La tentative de suppression a échoué';

        }
        break;

    default:
        echo "Action non reconnue";
        break;
    } 

} elseif ($req_method == 'POST') {

    $data = json_decode(file_get_contents('php://input'), $assoc = true);

    $proverbe = new Proverbe($data['proverbe']);

    if(!$proverbe->id) {

        if($proverbe->save()) {

            echo 'Proverbe enregistré';

        } else {

            echo 'L\'enregistrement a échoué';

        }

    }  

} else {

    echo 'Méthode HTTP non traitée';
    
}

?>