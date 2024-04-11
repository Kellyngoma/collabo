<?php 
if(
  !empty($_POST['title']) && !empty($_POST['motif']) 
  && !empty($_POST['date_consult'] && !empty($_POST['id_pat']) 
  )
 
)
{
   $title = $_POST['title'];
   $motif= $_POST['motif'];
   $date_consult = $_POST['date_consult'];
   $identityPatient = $_POST['id_pat'];
   

   $email = auth()['email'];
   $loggedUser = getUser( $email);

   addConsult($title,$motif,$date_consult,$identityPatient,$loggedUser->id );

   $patient = getOnePatient($id);

   $data = getPatientData($patient->id_inter_sys);
   
}

if(
  !empty($_POST['objet']) && !empty($_POST['description']) 
  && !empty($_POST['date_prescri']) && !empty($_POST['id_consult']) 
  )
  {
     $title = $_POST['objet'];
     $libelle = $_POST['description'];
     $datePrescri = $_POST['date_prescri'];
     $id_consult= $_POST['id_consult'];

     $email = auth()['email'];
     $loggedUser = getUser( $email);
     
     addPrescri($title,$libelle,$datePrescri,$id_consult);

     $patient = getOnePatient($id);

     $data = getPatientData($patient->id_inter_sys);
 }

?>

<div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#onExampleModal">Enregistrer une consultation</button>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#twoExampleModal-<?=$item['consultation_id'];?>">faire une prescription</button>

              <div class="modal" tabindex="-1" role="dialog" id="twoExampleModal-<?=$item['consultation_id'];?>">
                <div class="modal-dialog" role="document">
                  <form class="modal-content" method="post" action="?action=patient&id=<?=$patient->id_inter_sys?>">
                    <div class="modal-header">
                      <h5  id="" class="modal-title">Les Prescriptions</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <span class="content_message">Nouvelle Prescription</span><br><br>
                          <input class="form-control mb-3" type="text" name="objet" placeholder="L'objet" required>
                          <input class="form-control mb-3" type="text" name="description" placeholder="Libellé"  required>
                          <input class="form-control mb-3" type="date" name="date_prescri" placeholder="La date du prescription" required>
                          <input type="hidden" name="id_consult" value="<?=$item['consultation_id'];?>" >
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                  </form>
                </div>
              </div>
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
