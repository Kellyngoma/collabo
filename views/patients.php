  <?php
if(
  !empty($_POST['name']) && !empty($_POST['postnom'])
  && !empty($_POST['genre']) && !empty($_POST['adresse']) 
  && !empty($_POST['poids'])
  ) {
      $nom = $_POST['name'];
      $postnom = $_POST['postnom'];
      $genre = $_POST['genre'];
      $poids = $_POST['poids'];
      $adresse = $_POST['adresse'];

      $email = auth()['email'];
      $loggedUser = getUser($email);
      
      addPatient($nom, $postnom, $adresse, $genre, $poids, $loggedUser->id);
  }
?>

<div class="">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Enregistrer un patient </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalxy"> Demander un transfert </button>
    <table class="table" id="datatable">
        <thead>
         <tr>
             <th scope="col">Id</th>
             <th scope="col">Nom</th>
             <th scope="col">Genre</th>
             <th scope="col">Poids</th>
             <th scope="col">Action</th>
         </tr>
    </thead>
    <tbody>

    <?php foreach(getAllPatients() as $patient): ?>
      <tr>
            <th scope="row" ><?= $patient->id_inter_sys; ?></th>
            <td><?php echo $patient->nom_pat; ?></td>
            <td><?= $patient->genre_pat; ?></td>
            <td><?= $patient->poids_pat; ?></td>
            <td>
              <a href="?action=patient&id=<?= $patient->id_inter_sys; ?>">Voir le dossier</a><br>
              <a href="?action=update_patient&id=<?= $patient->id_inter_sys; ?>">Modifier le dossier</a><br>
              <a href="controller/delete_patient.php?id=<?= $patient->id_inter_sys; ?>" class="btn btn-danger disabled">Supprimer le dossier</a><br>
            </td> 
        </tr>
    <?php endforeach; ?>
      </tbody> 
    </table>

</div>



<div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <form class="modal-content" method="post" action="?action=patients">
      <div class="modal-header">
        <h5 class="modal-title">Enregistrer un nouveau patient.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span class="content_message">Identité du patient</span><br><br>
            <input class="form-control mb-3" type="text" name="name" placeholder="Votre Nom" required><i class='bx bxs-user'></i>
            <input class="form-control mb-3" type="text" name="postnom" placeholder="Votre Post-Nom" required><i class='bx bx-user-circle'></i>
            <input class="form-control mb-3" type="text" name="adresse" placeholder="Votre Adresse" required><i class='bx bx-vertical-bottom'></i>
            <input class="form-control mb-3" type="text" name="genre" placeholder="Votre Genre" required><i class='bx bx-check-shield'></i>
            <input class="form-control mb-3" type="text" name="poids" placeholder="Votre Poids" required><i class='bx bx-alarm-add'></i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
</form>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="exampleModalxy">
  <div class="modal-dialog" role="document">
    <form class="modal-content" method="post" action="transfert.php">
      <div class="modal-header text-center">
        <h5 class="modal-title">Enregistrer un nouveau patient.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <span class="content_message">Veuillez saisir le numero d'identification du patient</span><br><br>
            <input class="form-control mb-3" type="text" name="id_patient" placeholder="Numero d'identification" required><i class='bx bxs-user'></i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Effectuer le transfert</button>
      </div>
</form>
  </div>
</div>