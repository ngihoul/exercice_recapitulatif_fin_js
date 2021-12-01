<?php

/**
 * Description of MovieRentalManager
 *
 * @author alainmartel
 */
class MovieRentalManager {

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
     * @param MovieRental $movie_rental
     */
    public function create(MovieRental $movie_rental) {
        $sql_query = 'INSERT INTO movie_rental SET '
                //        . 'id=:id, '
                . 'title=:title, '
                . 'length=:length, '
                . 'year=:year, '
                . 'user_id=:user_id';

        $query = $this->getConnexionDb()->prepare($sql_query);

        //$query->bindValue(':id', $movie_rental->getId(), PDO::PARAM_INT);
        $query->bindValue(':title', $movie_rental->getTitle());
        $query->bindValue(':length', $movie_rental->getLength(), PDO::PARAM_INT);
        $query->bindValue(':year', $movie_rental->getYear(), PDO::PARAM_INT);
        $query->bindValue(':user_id', $movie_rental->getUser_id(), PDO::PARAM_INT);

        $query->execute();
    }

    /**
     * Sélectionne en DB l'objet dont l'id est passée en paramètre
     * @param type $id
     * @return \MovieRental
     */
    public function read($id) {

        $sql_query = 'SELECT *'
                . 'FROM movie_rental '
                . 'WHERE id = ' . $id;

        $query = $this->getConnexionDb()->query($sql_query);

        $datas = $query->fetch(PDO :: FETCH_ASSOC);

        return new MovieRental($datas);
    }

    /**
     * Sélectionne tous les objets en DB (si paramètre $limit pas positionné)
     * @param type $limit = nombre de données à retourner par le SELECT
     * @return \MovieRental
     */
    public function readAll($limit = NULL) {
        $movie_rentals = array();

        $sql_query = 'SELECT * '
                . 'FROM movie_rental '
                . 'ORDER BY id';

        if (is_int($limit) && $limit > 0) {
            $sql_query .= ' LIMIT ' . $limit;
        }

        $query = $this->getConnexionDb()->query($sql_query);

        while ($datas = $query->fetch(PDO :: FETCH_ASSOC)) {
            $movie_rentals [] = new MovieRental($datas);
        }

        return $movie_rentals;
    }

    /**
     * Mise à jour en DB de l'objet passé en paramètre
     * @param MovieRental $movie_rental
     */
    public function update(MovieRental $movie_rental) {
        $sql_query = 'UPDATE movie_rental SET '
                . 'id=:id, '
                . 'title=:title, '
                . 'length=:length, '
                . 'year=:year, '
                . 'user_id=:user_id '
                . 'WHERE id=:id';

        $query = $this->getConnexionDb()->prepare($sql_query);

        $query->bindValue(':id', $movie_rental->getId(), PDO::PARAM_INT);
        $query->bindValue(':title', $movie_rental->getTitle());
        $query->bindValue(':length', $movie_rental->getLength(), PDO::PARAM_INT);
        $query->bindValue(':year', $movie_rental->getYear(), PDO::PARAM_INT);
        $query->bindValue(':user_id', $movie_rental->getUser_id(), PDO::PARAM_INT);

        $query->execute();
    }

    /**
     * Supprime en DB l'objet passé en paramètre
     * @param MovieRental $movie_rental
     */
    public function delete($id) {
        $sql_query = 'DELETE '
                . 'FROM movie_rental '
                . 'WHERE id = ' . $id;

        $this->getConnexionDb()->exec($sql_query);
    }

}
