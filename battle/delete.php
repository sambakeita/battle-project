<?php 
  require 'db.php';
  $db=Database::connect();
 $req = $db->prepare('DELETE FROM habitants WHERE id = ?');
 $deleted = $req->execute([$_GET['id_habitant']]);
 if($deleted)
 {
 	header('Location: habitants-1.php?id='.$_GET['id']);
 }
 $continents = $request->fetchAll(PDO::FETCH_OBJ);
?>
