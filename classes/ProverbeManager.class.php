<?php 
include 'Proverbe.class.php';

class ProverbeManager
{
    public $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=proverbe', 'root', '');

    }


    function getProvFromAjaxByCategory($cat)
    {
        $query = $this->db->prepare('
            SELECT *
            FROM proverb
            WHERE proverb.category = :cat
        ');

        $query->execute(array(
            ':cat' => $cat
        ));

        $p = new Proverbe($query->fetch());

        return $p;
    }

    function getById($id)
    {
        $query = $this->db->prepare('
            SELECT *
            FROM proverb
            WHERE id = :id
        ');
        
        $query->execute(array(
            ':id' => $id
        ));

        $p = new Proverbe($query->fetch());
        
        return $p;
    }

}

?>