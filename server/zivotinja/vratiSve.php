<?php
    require '../broker.php';
    $broker=Broker::getBroker();
  
    
    echo json_encode($broker->vratiKolekciju("select z.*, v.naziv as 'vrsta_naziv' from zivotinja z inner join vrsta v on(z.vrsta_id=v.id)"));

?>