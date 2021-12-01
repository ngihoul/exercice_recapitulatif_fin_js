<?php

/**
 * Description of UserManager
 *
 * @author alainmartel
 */
class UserManager {

    private $connexionDb = 0; //Objet PDO

    public function __construct($connexionDb) {
        $this->setConnexionDb($connexionDb);
    }

    public function setConnexionDb($connexionDb) {
        $this->connexionDb = $connexionDb;
    }

    public function getConnexionDb() {
        return $this->connexionDb;
    }

    /**
     * Insertion en DB de l'objet passé en paramètre
     * @param User $user
     */
    public function create(User $user) {
        $sql_query = 'INSERT INTO user SET '
        //        . 'id=:id, '
                . 'last_name=:last_name, '
                . 'first_name=:first_name, '
                . 'email=:email, '
                . 'login=:login, '
                . 'password=:password';

        $query = $this->getConnexionDb()->prepare($sql_query);

        //$query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $query->bindValue(':last_name', $user->getLast_name());
        $query->bindValue(':first_name', $user->getFirst_name());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':login', $user->getLogin());
        $query->bindValue(':password', $user->getPassword());

        $query->execute();
    }

    /**
     * Sélectionne en DB l'objet dont l'id est passée en paramètre
     * @param type $id
     * @return \User
     */
    public function read($id) {

        $sql_query = 'SELECT *'
                . 'FROM user '
                . 'WHERE id = ' . $id;

        $query = $this->getConnexionDb()->query($sql_query);

        $datas = $query->fetch(PDO :: FETCH_ASSOC);

        return new User($datas);
    }

    /**
     * Sélectionne tous les objets en DB (si paramètre $limit pas positionné)
     * @param type $limit = nombre de données à retourner par le SELECT
     * @return \User
     */
    public function readAll($limit = NULL) {
        $users = array();

        $sql_query = 'SELECT * '
                . 'FROM user '
                . 'ORDER BY id';

        if (is_int($limit) && $limit > 0) {
            $sql_query .= ' LIMIT ' . $limit;
        }

        $query = $this->getConnexionDb()->query($sql_query);

        while ($datas = $query->fetch(PDO :: FETCH_ASSOC)) {
            $users [] = new User($datas);
        }

        return $users;
    }

    /**
     * Mise à jour en DB de l'objet passé en paramètre
     * @param User $user
     */
    public function update(User $user) {
        $sql_query = 'UPDATE user SET '
                . 'id=:id, '
                . 'last_name=:last_name, '
                . 'first_name=:first_name, '
                . 'email=:email, '
                . 'login=:login, '
                . 'password=:password '
                . 'WHERE id=:id';

        $query = $this->getConnexionDb()->prepare($sql_query);

        $query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $query->bindValue(':last_name', $user->getLast_name());
        $query->bindValue(':first_name', $user->getFirst_name());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':login', $user->getLogin());
        $query->bindValue(':password', $user->getPassword());

        $query->execute();
    }

    /**
     * Supprime en DB l'objet passé en paramètre
     * @param User $user
     */
    public function delete(User $user) {
        $sql_query = 'DELETE '
                . 'FROM user '
                . 'WHERE id = ' . $user->getId();

        $this->getConnexionDb()->exec($sql_query);
    }

}
