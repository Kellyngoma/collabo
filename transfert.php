<?php
  session_start();

  include_once 'functions.php';

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
      // die(var_dump($patient['id_inter_sys']));
      $consultations = $data['data']['consultations'];
      $patient_ = getOnePatient($patient['id_inter_sys']);
      if (!$patient_ instanceof StdClass) {
          addPatient(
            $patient['nom_pat'], $patient['postnom_pat'], 
            $patient['adresse'], $patient['genre_pat'], 
            $patient['poids_pat'], $patient['id_user'], 
            $patient['id_inter_sys']
          );
          
          foreach($consultations as $consultation) {
            addConsult(
              $consultation['nom_consult'], $consultation['motif_consult'],
              $consultation['date_consult'], $consultation['id_pat'],
              $consultation['id_user'], $consultation['id_inter_sys']
            );
            
            foreach($consultation['prescriptions'] as $prescription) {
              addPrescri(
                $prescription['nom_prescrip'],$prescription['libelle_prescrip'],
                $prescription['date_prescript'],$prescription['id_consult'],
                $prescription['id_inter_sys']
              );
            }
          }
    
          header('location: index.php?action=patient&id='.$patient->id_inter_sys);
      }      
    }

    header('location: index.php?action=patients');
}