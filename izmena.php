<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>
</head>
<?php

    if(!isset($_GET['id'])){
        header('Location: index.php');
    }
    require './server/broker.php';
    $broker=Broker::getBroker();
    $rezultat=$broker->vratiKolekciju('select * from zivotinja where id='.$_GET['id']);
    $zivotinja=$rezultat['kolekcija'][0];
?>


<body>
    <style>
        body {
            background-image: url('<?php echo $zivotinja->slika; ?>') !important;
            background-size: cover;
        }
    </style>
    <?php include 'header.php'; ?>
    <div class='container'>
        <div class='row mt-2'>
            <div class='col-6'>
                <h1 class='text-center bg-light'>Izmeni podatke o zivotinji</h1>
            </div>
            <div class='col-2'>
                <form action="./server/zivotinja/obrisi.php" method="post">
                <input type="text" hidden name='id' value='<?php echo $zivotinja->id;?>'>    
                <button class="btn btn-danger form-control mt-2">Obrisi</button>
                </form>
            </div>
        </div>
        <div class="row mt-2" <?php echo (!isset($_GET['greska']))?'hidden':''; ?>>
            <h2 class="text-danger">
                <?php echo $_GET['greska'];?>
            </h2>
        </div>
        <input type="text" id='vrsta_id_hidden' hidden value='<?php echo $zivotinja->vrsta_id; ?>'>
        <div class="row mt-2">
            <div class="col-8 bg-light">
                <form action="./server/zivotinja/izmeni.php" method="post">
                <input type="text" hidden name='id' value='<?php echo $zivotinja->id;?>'>     
                <label>Ime</label>
                    <input type="text" required class="form-control" value='<?php echo $zivotinja->ime; ?>' name="ime">
                    <label>Starost</label>
                    <input type="number" required min="1" max="9" value='<?php echo $zivotinja->starost; ?>'
                        class="form-control" name="starost">
                    <label>Vrsta zivotinje</label>
                    <select id='vrste'  class="form-control" required
                        name='vrsta_id'>

                    </select>

                    <label>Opis</label>
                    <textarea required name="opis" cols="30" rows="5" class="form-control">
                    <?php echo $zivotinja->opis; ?>
                    </textarea>
                    <button class="form-control btn btn-primary mt-2 mb-2">Izmeni</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $.getJSON('./server/vrsta/vratiSve.php', function (data) {
                console.log(data);
                if (!data.status) {
                    alert(data.error);
                    return;
                }

                for (let vrsta of data.kolekcija) {
                    $('#vrste').append(`
                        <option  value='${vrsta.id}'> ${vrsta.naziv} </option>
                    `)
                }
                $('#vrste').val($('#vrsta_id_hidden').val());
            })
        })
    </script>
</body>

</html>