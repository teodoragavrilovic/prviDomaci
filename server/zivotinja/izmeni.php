<?php
    require '../broker.php';
    $broker=Broker::getBroker();
    $ime=$_POST['ime'];
    $starost=$_POST['starost'];
    $vrsta_id=$_POST['vrsta_id'];
    $opis=$_POST['opis'];
    $id=$_POST['id'];
   
    
    $upit="update zivotinja set ime='".$ime."', starost=".$starost.", vrsta_id=".$vrsta_id.", opis='".$opis."' where id=".$id;
    
    if(!isset($id)){
        header('Location: ../../izmeni.php&id='.$id.'&greska=Nije prosledjen id');
        exit;
    }
   
    $broker->izmeni( $upit);
    header('Location: ../../index.php');


?>