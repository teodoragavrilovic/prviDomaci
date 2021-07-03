<?php
    require '../broker.php';
    $broker=Broker::getBroker();
   
    $naziv=$_POST['naziv'];
    if(!preg_match('/^[a-zA-Z]*$/',$naziv)){
        header("Location: ../../vrste.php?greska=Neispravan naziv");
    }else{
        $rezultat=$broker->izmeni("insert into vrsta(naziv) values ('".$naziv."') ");
        if($rezultat['status']){
            header("Location: ../../vrste.php");
        }else{
            header("Location: ../../vrste.php?greska=".$rezultat['error']);
        }
    }
       


?>