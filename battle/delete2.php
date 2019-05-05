<?php 
 
  require 'db.php';
  $db=Database::connect();

 $req = $db->prepare('DELETE FROM habitants WHERE id = ?');
 $deleted = $req->execute([$_GET['id_habitant']]);
 if($deleted)
 {
 	header('Location: habitant2.php?id='.$_GET['id']);
 }
 $continents = $req->fetchAll();
?>