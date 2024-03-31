<?php
  session_start();

  include_once 'functions.php';
  include_once 'config.php';

  if(!empty($_POST['id_patient'])){

    $id_patient = $_POST['id_patient'];


    $url = $config['url'].$id_patient;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);

    curl_close($curl);

    $data = json_decode($response, true);

    if(!empty($data['status']) && $data['status'] == 'success') {
      $patient = $data['data']['patient'];
      $consultations = $data['data']['consultations'];

      addPatient(
        $patient['nom_pat'], $patient['postnom_pat'], 
        $patient['adresse'], $patient['genre_pat'], 
        $patient['poids_pat'], $patient['id_inter_sys'], 
        $patient['id_user']
      );

      foreach($consultations as $consultation) {
        addConsult(
          $consultation['title'], $consultation['motif'],
          $consultation['date_consult'], $consultation['identityPatient'],
          $consultation['idUser'], $consultation['idInterSys ']
        );
        
        foreach($consultation['prescriptions'] as $prescription) {
          addPrescri(
            $prescription['title'],$prescription['libelle'],
            $prescription['datePrescri'],$prescription['id_consult'],
            $prescription['idInterSys']
          );
        }
      }

      header('location: index.php?action=patient&id='.$patient->id_inter_sys);
    }

    header('location: index.php?action=patients');
}