<?php
include_once'functions.php';

if(!empty($_GET['id'])) {
    $id = (int) $_GET['id'];

    suppressionPatient($id);
}

header('location: patients.php');
// header('location: index.php?action=patients');

?>