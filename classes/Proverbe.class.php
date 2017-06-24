<?php

class Proverbe
{
    public $db;

    public $id; // nécessaire pour l'opération de suppression
    public $origin;
    public $body;
    public $category;

    function __construct($data)
    {
        // 1) connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=proverbe', 'root', '');

        // si l'identifiant du joueur fait partie du tableau de données passé en entrée du constructeur, on l'utilise pour hydrateur la propriété id de l'objet
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        
        if($data['origin'] == "") {

            $this->origin = "inconnue";

        } else {

            $this->origin = $data['origin'];
            
        }

        $this->body         = $data['body'];
        $this->category     = $data['category'];
    }

    function save()
    {
        // 2) requête
        $query = $this->db->prepare('INSERT INTO proverb (origin, body, category) VALUES (:origin, :body, :category)');

        // 3) execution
        return $query->execute(array(
            ':origin'       => $this->origin,
            ':body'         => $this->body,
            ':category'     => $this->category
        ));
    }

    function delete() 
    {
        $query = $this->db->prepare('DELETE FROM proverb WHERE id = :id');
        
        return $query->execute(array(
            ':id' => $this->id
        ));
    }
}

?>