<?php
class gestion
{

    private $_id;
    private $_nom;
    

    public function __construct($id, $nom)
    {  
        $this->_id = $id;
        $this->_nom = $nom;
        
    }
    public function getId()
    {
        return $this->_id;
    }
    public function getNom()
    {
        return $this->_nom;
    }
}
?>