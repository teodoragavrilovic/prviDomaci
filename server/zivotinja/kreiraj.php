<?php
    require '../broker.php';
    $broker=Broker::getBroker();
    $ime=$_POST['ime'];
    $starost=$_POST['starost'];
    $vrsta_id=$_POST['vrsta_id'];
    $slika=$_FILES['slika'];
    $opis=$_POST['opis'];
    $nazivSlike=$slika['name'];
    $lokacija = "../../img/".$nazivSlike;
    if(!move_uploaded_file($_FILES['slika']['tmp_name'],$lokacija)){
        $lokacija="";
        header("Location: ../../kreirajZivotinju.php?greska=Nije uspelo prebacivanje slike");
        exit;
    }else{
        
        $lokacija=substr($lokacija,4);
    }
    
    $rezultat=$broker->izmeni("insert into zivotinja(ime,starost,vrsta_id,slika,opis) values ('".$ime."',".$starost.",".$vrsta_id.",'".$lokacija."','".$opis."') ");
    if($rezultat['status']){
        header("Location: ../../kreirajZivotinju.php");
    }else{
        header("Location: ../../kreirajZivotinju.php?greska=".$rezultat['error']);
    }
    
    
    


?>