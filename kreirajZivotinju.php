<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Kreiraj</title>
</head>

<body>
    <?php include 'header.php '; ?>
    <div class='container'>
        <div class='row mt-2 '>
            <h1>Kreiraj novu zivotinju</h1>

        </div>
        <div class='row mt-2' <?php echo (!isset($_GET['greska']))?'hidden':''; ?>>
            <h2 class='text-danger bg-light'>
                <?php echo $_GET['greska']; ?>
            </h2>
        </div>
        <div class="row mt-2">
            <div class="col-8 bg-light">
                <form action="./server/zivotinja/kreiraj.php" method="post" enctype="multipart/form-data" size='200'>
                    <label>Ime</label>
                    <input type="text" required class="form-control" name="ime">
                    <label>Starost</label>
                    <input type="number" required min="1" max="9" class="form-control" name="starost">
                    <label>Vrsta zivotinje</label>
                    <select id='vrste' class="form-control" required name='vrsta_id'>

                    </select>
                    <label>Slika</label>
                    <input type="file" required class="form-control" name="slika">
                    <label>Opis</label>
                    <textarea required name="opis" cols="30" rows="5" class="form-control">

                    </textarea>
                    <button class="form-control btn btn-primary mt-2 mb-2">Kreiraj</button>
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
                        <option value='${vrsta.id}'> ${vrsta.naziv} </option>
                    `)
                }
            })
        })
    </script>
</body>

</html>