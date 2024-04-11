<?php

include_once 'config.php';

function auth() {
    return  $_SESSION['user'];
}

// CONNEXION A LA BD
function db(): PDO {
    try {
        return new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, 'root', '' );
    } catch(Exception $e) {
        die('error:' .$e->getmessage());
    }
}

// recuperation de tous les données dans la table user qui peut etre soit un id ou un email
function getUser(string $idOrEmail): null | StdClass {
    $sql = "SELECT * FROM user WHERE id = :identifier OR email = :identifier";

    // la première ligne se rende dans la BD tout en recuperant les données qui s'y dans la table user grace à l'objet bd()

    $query = db()->prepare($sql);
    $query->bindvalue(':identifier', $idOrEmail);
    $query->execute();

    // cette requette renvoie les données les unes après l'autre sous forme des objets

    return $query->fetch(PDO::FETCH_OBJ);
}

function getAllPatients() {
    $req = db()->query('SELECT * FROM patients');

    return $req->fetchAll(PDO::FETCH_OBJ);
}

function getAllConsultByPatientId(string $id) {
    $sql = "SELECT * FROM consultation WHERE id_pat = :id";

    // la première ligne se rende dans la BD tout en recuperant les données qui s'y dans la table user grace à l'objet bd()

    $query = db()->prepare($sql);
    $query->bindvalue(':id', $id);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPrescriptByConsultId(string $id) {
    $sql = "SELECT * FROM prescription WHERE id_consult = :id";

    // la première ligne se rende dans la BD tout en recuperant les données qui s'y dans la table user grace à l'objet bd()

    $query = db()->prepare($sql);
    $query->bindvalue(':id', $id);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getOnePatient(string $id): bool | null | StdClass {
    $sql = 'SELECT * FROM patients AS p WHERE p.id_inter_sys = ?';
    $req = db()->prepare($sql);
    $req->execute([$id]);

    return $req->fetch(PDO::FETCH_OBJ);
}

function getPatientData(string $id): bool|null|array {
    $sql = '
        SELECT c.*, c.id_inter_sys AS consultation_id, pre.*, pre.id_inter_sys AS prescription_id
        FROM patients AS p 
        INNER JOIN consultation AS c ON p.id_inter_sys = c.id_pat 
        LEFT JOIN prescription AS pre ON c.id_inter_sys = pre.id_consult
        WHERE p.id_inter_sys = ?
    ';
    $req = db()->prepare($sql);
    $req->execute([$id]);

    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function suppressionPatient(int $id): bool{
    $req = db()->prepare('DELETE FROM patients WHERE id_inter_sys=?');
    $req->execute([$id]);

    if($req->rowCount() === 1) {
        return true;
    }

    return false;
}

/**
 * @return bool
 */
function addPatient(string $nom, $postnom, $adresse, $genre, $poids, $idUser, string $idInterSys = null): bool {
    // die(var_dump($nom, $postnom, $adresse, $genre, $poids, $idUser, $idInterSys));
    $sql = "INSERT INTO patients (nom_pat,postnom_pat,adresse,genre_pat,poids_pat,id_inter_sys,id_user) VALUES
    (?, ?, ?, ?, ?, ?, ?)";

    if(null === $idInterSys) $idInterSys = getUniqueId();
    $query = db()->prepare($sql);
    $query->execute([$nom, $postnom, $adresse, $genre, $poids, $idInterSys, $idUser]);

    // $id = db()->lastInsertId();
    return true;
}

function getUniqueId(){
    return sha1(uniqid(APP_DATA_PREFIX, true));
}

function addConsult(string $title, $motif, $date_consult, $identityPatient, $idUser, string $idInterSys = null):bool{
    $sql = "INSERT INTO consultation (nom_consult, motif_consult, date_consult,id_user,id_pat, id_inter_sys) VALUES 
    (?, ?, ?, ?, ?, ?)";
    
    if(null === $idInterSys) $idInterSys = getUniqueId();
    $query = db()->prepare($sql);
    $query->execute([$title, $motif, $date_consult, $idUser, $identityPatient, $idInterSys]);

    return true;
}

function addPrescri(string $title, string $libelle, $datePrescri, string $id_consult, string $idInterSys = null): bool{
    $sql = "INSERT INTO  prescription (nom_prescrip,libelle_prescrip,date_prescript,id_consult,id_inter_sys) VALUES 
    (?, ?, ?, ?, ?)";

    if(null === $idInterSys) $idInterSys = getUniqueId();
    $query = db()->prepare($sql);
    $query->execute([$title, $libelle, $datePrescri, $id_consult,  $idInterSys]);

    return true;
}

 /**
  * Cette fonction prends en parametre les variables 
  * et renvoie une réponse false dans le ou l'email saisi 
  * est différent de celui qui s'y trouve dans la table user
  * 
  * @param string $email
  * @param string $password
  * @return bool|array ['email', 'name']
  */
function userLogin($email, $password) {
    if(false == ($user = getUser($email))) {
        return false;
    }

    /* cette ligne vérifie si le mot de passe saisi correspond au mot de passe qui est envoyé dans la table user
    en suite elle affiche l'email et le nom de l'internaute
    */
    if(true == password_verify($password, $user->password)) {
        return [
            'email' => $email,
            'name' => $user->nom
        ];
    }

    // dans le cas contarire elle retourne un false
    return false;
}