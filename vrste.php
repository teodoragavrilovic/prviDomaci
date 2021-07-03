<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Vrste</title>
</head>


<body>
    <?php include 'header.php '; ?>
    <div class='container'>
        <div class='row mt-2'>
            <div class='col-7'>
                <table class='table table-light display'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naziv vrste</th>
                        </tr>
                    </thead>
                    <tbody id='podaci'>

                    </tbody>
                </table>
            </div>
            <div class='col-5'>
                <h2>Kreiraj vrstu</h2>
                <form class='mb-5' action="./server/vrsta/kreiraj.php" method="post">
                    <label>Naziv vrste</label>
                    <input type="text" name='naziv' class='form-control'>
                    <label class='text-danger bg-light' <?php echo (!isset($_GET['greska']))?'hidden':''; ?> ><?php echo $_GET['greska']; ?></label>
                    <button type='submit' class='form-control btn btn-primary mt-2'>Kreiraj</button>
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
                $('#podaci').html('');
                for (let vrsta of data.kolekcija) {
                    $('#podaci').append(`
                        <tr>
                            <td>${vrsta.id}</td>
                            <td>${vrsta.naziv}</td>
                            <td>
                                <button class='form-control btn btn-danger' onClick=obrisi(${vrsta.id}) >Obrisi</button>
                            </td>
                        </tr>
                    `)
                }
            })
        })
        function obrisi(id_vrste) {
            $.post('./server/vrsta/obrisi.php', { id: id_vrste }, function (data) {
                if (data.status=='false') {
                    alert(data.error)
                } else {
                    window.location.reload();
                }
            })
        }
    </script>
</body>

</html>