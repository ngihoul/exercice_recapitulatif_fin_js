<?php

/**
 * Description of MovieRental
 *
 * @author martel
 */
class MovieRental implements JsonSerializable {

// Interface JsonSerializable permet de convertir l'objet
// en JSON (via json_encode) par la méthode jsonSerialize

    /*
     * Propriétés
     */
    private $id;
    private $title;
    private $length;
    private $year;
    private $user_id;

    /**
     * 
     * @param array $datas tableau des données d'hydratation de l'objet
     */
    public function __construct(array $datas) {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }

    /**
     * 
     * @param array $datas tableau des données d'hydratation de l'objet
     */
    public function hydrate(array $datas) {
        foreach ($datas as $cle => $valeur) {
            $nomMethode = "set" . ucfirst($cle);
            if (method_exists($this, $nomMethode)) {
                $this->$nomMethode($valeur);
            }
        }
    }

    /**
     * Méthode de sérialisation de l'objet en JSON
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    /*
     * Zone des Getters
     */

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getLength() {
        return $this->length;
    }

    public function getYear() {
        return $this->year;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    /*
     * Zone des Setters
     */

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

}
