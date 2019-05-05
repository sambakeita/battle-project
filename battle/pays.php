<?php require'db.php';
  $db=Database::connect();
    $req = $db->prepare('SELECT * FROM pays WHERE id_continent = ?');
   $req->execute([$_GET['id']]);
   $pays = $req->fetchAll();

 //le deriner id de la table pays
   $query = $db->prepare("SELECT id FROM pays 
                WHERE id_continent = ?
                ORDER BY id DESC
                LIMIT 1 OFFSET 0");

   $query->execute([$_GET['id']]);
   $res= $query->fetch();
   $last_id = $res['id'];

     //Ajout des villes 
   if(isset($_POST['soumettre']))
   {
      $req = $db->prepare("INSERT INTO villes(nom, superficie,id_pays) VALUES(?, ?, ?)");
      $req->execute([$_POST['ville1'], 0, $last_id]);

      $req2 = $db->prepare("INSERT INTO villes(nom, superficie,id_pays) VALUES(?, ?, ?)");
      $req2->execute([$_POST['ville2'], 0, $last_id]);

      $req3 = $db->prepare("INSERT INTO villes(nom, superficie,id_pays) VALUES(?, ?, ?)");
      $req3->execute([$_POST['ville3'], 0, $last_id]);
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
  <h2>Table des villes de l'Afrique</h2>
<form class="form-group">
    <input class="from-control" name="ville1" placeholder="Entrez un nom">
     <input class="from-control" name="ville1" placeholder="Entrez un nom">
      <input class="from-control" name="ville1" placeholder="Entrez un nom">
      <button class="btn btn-primary">Ajouter 3 villes</button>
      
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>nom</th>
        <th>superficie</th>
        <th>Pays</th>
      </tr>
    </thead>
    <tbody>
      
      <?php foreach ($pays as $value): 
      $req = $db->prepare("SELECT COUNT(id) AS nbr_ville FROM villes WHERE id_pays = ?");
      $req->execute([$value->id]);
      $nbr_ville = $req->fetch(PDO::FETCH_OBJ);
     ?>

      <tr>
          <td><?= $value->nom ?></td>
          <td><?= $value->superficie ?></td>
          <td>
             <?= $nbr_ville->nbr_ville ?>
          </td>
      </tr>
<?php endforeach ?>
    </tbody>
  </table>
</div>

</body>
</html>
