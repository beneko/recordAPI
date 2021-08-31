<?php
    class crud {
        private $db;

        function __construct($db){
            $this->db = $db;
        }
        //function to get the list of discs
        function getDiscList(){
            try {
                $sql = "SELECT `disc_id`, `disc_title`,`disc_year`,`disc_picture`,`disc_label`, `disc_genre`, `artist_name` 
                FROM `disc`,`artist` 
                WHERE `disc`.`artist_id` = `artist`.`artist_id`
                ORDER BY `disc_id`";
                $result=$this->db->query($sql);
                return $result;
            } catch (PDOException $th) {
                // echo $e->getMessage();
                return false;
            }
        }

        //function to get the details of the disc
        function getDiscDetails($discId){
            try {
                $sql = "SELECT `disc_title`, `disc_year`, `disc_picture`, `disc_label`, `disc_genre`, `artist_name` , `disc_price` 
                FROM `disc`,`artist` 
                WHERE `disc`.`artist_id` = `artist`.`artist_id` 
                AND `disc_id`=:disc_id";
                $result=$this->db->prepare($sql);
                $result->bindparam(':disc_id', $discId);
                $result->execute();
                $details=$result->fetch();
                return $details;
            } catch (PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }
        // function to add a disc
        function addDisc($disc_title, $disc_year, $disc_picture, $disc_label, $disc_genre, $disc_price, $artist_id){
            try {
                $sql = "INSERT INTO `disc` (`disc_title`, `disc_year`, `disc_picture`, `disc_label`, `disc_genre`, `disc_price`, `artist_id`) 
                        VALUES (:disc_title, :disc_year, :disc_picture, :disc_label, :disc_genre, :disc_price, :artist_id)";
                $result = $this->db->prepare($sql);
                $result->bindparam(':disc_title', $disc_title);
                $result->bindparam(':disc_year', $disc_year);
                $result->bindparam(':disc_picture', $disc_picture);
                $result->bindparam(':disc_label', $disc_label);
                $result->bindparam(':disc_genre', $disc_genre);
                $result->bindparam(':disc_price', $disc_price);
                $result->bindparam(':artist_id', $artist_id);
                $result->execute();
                return true;
            } catch (PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }
        //function to get the list of artists
        function getArtistList(){
            try {
                $sql = "SELECT `artist_id`, `artist_name` FROM `artist`";
                $result=$this->db->query($sql);
                $artists = $result->fetchAll(PDO::FETCH_OBJ);
                return $artists;
            } catch (PDOException $e) {
                // echo $e->getMessage();
                return false;
            }
        }
         //function to update the disc
        function updateDisc($disc_id, $disc_title, $disc_year, $disc_picture, $disc_label, $disc_genre, $disc_price, $artist_id){
            try {
                $sql = "UPDATE `disc` 
                        SET `disc_title` = :disc_title,
                        `disc_year` = :disc_year ,
                        `disc_picture` = :disc_picture,
                        `disc_label` = :disc_label,
                        `disc_genre` = :disc_genre,
                        `disc_price` = :disc_price,
                        `artist_id` = :artist_id
                        WHERE `disc_id` = :disc_id";
                $result = $this->db->prepare($sql);
                $result->bindparam(':disc_id', $disc_id);
                $result->bindparam(':disc_title', $disc_title);
                $result->bindparam(':disc_year', $disc_year);
                $result->bindparam(':disc_picture', $disc_picture);
                $result->bindparam(':disc_label', $disc_label);
                $result->bindparam(':disc_genre', $disc_genre);
                $result->bindparam(':disc_price', $disc_price);
                $result->bindparam(':artist_id', $artist_id);
                $result->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        //function to delete the disc from database
        function deleteDisc($discId){
            try {
                $sql = "DELETE FROM `disc`
                WHERE `disc_id`=:disc_id";
                $result=$this->db->prepare($sql);
                $result->bindparam(':disc_id', $discId);
                $result->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
