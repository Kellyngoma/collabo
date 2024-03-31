<?php

  include_once 'functions.php';

  if(!empty($_POST['identity'])){

    $identity = $_POST['identity'];

    $patient = getOnePatient($identity);

    if($patient instanceof StdClass) {
        $data = getPatientData($patient->id_inter_sys);
    } else {
      header('location: search.php?message=Aucun résultat trouvé');
  }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Collaboration Center
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> -->
  <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/dataTables.dataTables.min.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
    <!-- Start of Part dynamic !-->
    <div class="container my-5">
      <div class="row">
        <div class="col">
          <a href="search.php" class="btn btn-info">Retourner à la page de recherche</a>
        </div>
      </div>
    <div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="onExampleModal">
  <div class="modal-dialog" role="document">
    <form class="modal-content" method="post" action="?action=patient&id=<?=$patient->id_inter_sys;?>">
      <div class="modal-header">
        <h5 class="modal-title">Les consultations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span class="content_message">Nouveau Consultation</span><br><br>
            <input class="form-control mb-3 w-60" type="text" name="title" placeholder="L'intitulé" required>
            <input class="form-control mb-3" type="text" name="motif" placeholder="Le Motif" required>
            <input class="form-control mb-3" class="input_box" type="date" name="date_consult" placeholder="La Date du consultation" required>
            <input type="hidden" name="id_pat" value="<?=$patient->id_inter_sys;?>">
            
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
</form>
  </div>
</div>

<div class="">
  <div class="row">
   <div class="col-md-6 d-none"class="mt-10 "> 
    <div >
      <img src="assets/img/patient_2.jpg" style="width:40%;">
    </div>
   </div>
   <div class="col-md-12 card py-3" style="width:18rem; font-weight:bold; background:#51cbce;; color:#fff;">
   <div class="card-body">
      <span><?=$patient->id_inter_sys;?></span><br>
        <span><?= $patient->nom_pat; ?></span><br>
        <span><?= $patient->genre_pat; ?></span><br>
        <span><?= $patient->poids_pat; ?></span>
   </div>
       
   </div>
  </div>
  <div>
<table class="table" id="datatable">
        <thead>
         <tr>
             <th scope="col">N</th>
             <th scope="col">Date du consultation</th>
             <th scope="col">Date du prescription</th>
             <th scope="col">Action</th>
         </tr>
    </thead>
    <tbody>

      <?php foreach($data as $key => $item) :?>
        <tr>
             <th scope="col"><?= $key + 1 ;?></th>
             <th scope="col"><?= $item['date_consult'] ;?></th>
             <th scope="col">
              <?php if(null <> $item['date_prescript']) :?>
                <?= $item['date_prescript']; ?>
              <?php else :?>
                  -                
              <?php endif;?>
            </th>
            <th scope="col">
              <?php if(null <> $item['date_prescript']) :?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#twoExampleModal-<?=$item['consultation_id'];?>">Voir les détails</button>

              <div class="modal" tabindex="-1" role="dialog" id="twoExampleModal-<?=$item['consultation_id'];?>">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5  id="" class="modal-title">Informations détaillées</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="card p-3">
                          <h6>Details de la consultation</h6>
                          <hr>
                          <div>
                            <span>Nom: <?= $item['nom_consult']; ?></span><br>
                            <span>Motif: <?= $item['motif_consult'];  ?></span><br>
                            <span>Date: <?= $item['date_consult'];  ?></span><br>
                          </div>
                        </div>
                        <div class="card p-3">
                          <h6>Details de la prescription</h6>
                          <hr>
                          <div>
                          <span>Nom: <?= $item['nom_prescrip']; ?></span><br>
                            <span>Libelle: <?= $item['libelle_prescrip'];  ?></span><br>
                            <span>Date: <?= $item['date_prescript'];  ?></span><br>
                           
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
              </div>
                </div>
              </div>
              <?php endif;?>
            </th>
         </tr>
      <?php endforeach; ?>
    </tbody>
    <tbody>
</div>
</div>
    </div>
    <!-- The End of Part of dynamic !-->
     <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <script src="assets/js/dataTables.min.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <script src="assets/js/script.js"></script>
</body>
</html>