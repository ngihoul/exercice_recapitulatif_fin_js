<?php

/**
 * Description of User
 *
 * @author martel
 */
class User implements JsonSerializable {

// Interface JsonSerializable permet de convertir l'objet
// en JSON (via json_encode) par la méthode jsonSerialize

    /*
     * Propriétés
     */
    private $id;
    private $last_name;
    private $first_name;
    private $email;
    private $login;
    private $password;

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

    public function getLast_name() {
        return $this->last_name;
    }

    public function getFirst_name() {
        return $this->first_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    /*
     * Zone des Setters
     */

    public function setId($id) {
        $this->id = $id;
    }

    public function setLast_name($last_name) {
        $this->last_name = $last_name;
    }

    public function setFirst_name($first_name) {
        $this->first_name = $first_name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

}
