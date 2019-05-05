<?php
include('db.php');
 $db=Database::connect();
    $req = $db->prepare('SELECT habitants.*, communes.nom as nom_commune 
                  FROM habitants
                   JOIN quartiers
                  ON quartiers.id = habitants.id_quartier
                   JOIN communes
                  ON communes.id = quartiers.id_commune
                   JOIN villes
                  ON villes.id = communes.id_ville
                   JOIN pays
                  ON pays.id = villes.id_pays
                   JOIN continents
                  ON continents.id = pays.id
                  WHERE continents.id = ?
                  ORDER BY habitants.solde ASC');

       $req = $db->prepare('SELECT habitants.*, communes.nom as nom_commune 
                  FROM habitants
                   JOIN quartiers
                  ON quartiers.id = habitants.id_quartier
                   JOIN communes
                  ON communes.id = quartiers.id_commune
                   JOIN villes
                  ON villes.id = communes.id_ville
                   JOIN pays
                  ON pays.id = villes.id_pays
                   JOIN continents
                  ON continents.id = pays.id
                  WHERE continents.id = ?
                  ORDER BY habitants.solde ASC');

       $req->execute([$_GET['id']]);
   $total = $req>fetch();
   if(isset($_POST['update']))
   {
      $req = $db->prepare('UPDATE villes SET superficie = ? WHERE id = ?');
      $req->execute([$_POST['supreficie'], $_POST['ville']]);
   }  



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Table des habitants de l'Afrique</h2>

  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>prenom</th>
        <th>commune</th>
        <th>solde</th>
        <th>numéro</th>
      </tr>
    </thead>
     
    <tbody>
       <?php foreach ($habitants as $habitant): ?>
        <tr>
          <td><?= $habitant->nom ?></td>
          <td><?= $habitant->prenom ?></td>
          <td>
            <?= $habitant->nom_commune ?>
          </td>
          <td><?= $habitant->solde ?></td>
          <td><?= $habitant->numero ?></td>
          <td>
            <a href= "delete2.php?id=<?= $_GET['id'] ?>&&id_habitant=<?= $habitant->id ?>" class="btn btn-danger">Supprimer</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
    <tfooter>
      <tr>
        <th>Toatal</th>
        <th></th>
        <th></th>
        <th><?= $total->total ?></th>
        <th></th>
      </tr>
</tfooter>
  </table>
</div>

</body>
</html>
