<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Zivotinje</title>
</head>


<body>
    <?php include 'header.php'; ?>
    <div class='container'>
        <div class="row mt-2">
            <div class="col-3">
                <select id='sort' class="form-control">
                    <option value="">Sortiraj po imenu</option>
                    <option value="ASC">Abecedno</option>
                    <option value="DESC">Obrnuto</option>
                </select>
            </div>
            <div class="col-6">
                <input type="text" id='imeFilter' class="form-control" placeholder="Filtriraj po imenu">
            </div>
            <div class="col-3">
                <select id='vrsta' class="form-control">
                    <option value="0">Filtriraj po vrsti</option>

                </select>
            </div>
        </div>
        <div id='podaci'>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        let zivotinje = [];
        $(document).ready(function () {
            $.getJSON('./server/zivotinja/vratiSve.php', function (data) {
                if (data.status == 'false') {
                    alert(data.error);
                    return;
                } else {
                    zivotinje = data.kolekcija;
                    iscrtaj();
                }

            });
            $.getJSON('./server/vrsta/vratiSve.php', function (data) {

                if (!data.status) {
                    alert(data.error);
                    return;
                }

                for (let vrsta of data.kolekcija) {
                    $('#vrsta').append(`
                        <option value='${vrsta.id}'> ${vrsta.naziv} </option>
                    `)
                }
            })

            $('#vrsta').change(function () {
                iscrtaj();
            })
            $('#sort').change(function () {
                iscrtaj();
            })
            $('#imeFilter').change(function () {
                iscrtaj();
            })

        })
        function iscrtaj() {
            const vrsta = $('#vrsta').val();
            const sort = $('#sort').val();
            const imeFilter = $('#imeFilter').val();
            const niz = zivotinje.filter(element => {
                return (vrsta == 0 || element.vrsta_id == vrsta) && element.ime.startsWith(imeFilter)
            })
            niz.sort((a, b) => {
                if (sort == 'ASC')
                    return (a.ime.toLowerCase() > b.ime.toLowerCase()) ? 1 : -1;
                return (a.ime.toLowerCase() > b.ime.toLowerCase()) ? -1 : 1;
            });

            let red = 0;
            let kolona = 0;
            $('#podaci').html(`<div id='row-${red}' class='row mt-2'></div>`)
            for (let zivotinja of niz) {
                if (kolona === 3) {
                    kolona = 0;
                    red++;
                    $('#podaci').append(`<div id='row-${red}' class='row mt-2'></div>`)
                }
                $(`#row-${red}`).append(
                    `
                        <div class='col-4 pt-2 bg-light'>
                            <img src='${zivotinja.slika}' width='100%' height='320' />
                            <h4 class='text-center'>${zivotinja.ime}</h4>
                            <h5 class='text-center'>${zivotinja.vrsta_naziv}</h5>
                           <a href='./izmena.php?id=${zivotinja.id}'> <button class='form-control btn btn-success mb-2'>Vidi</button></a>
                        </div>
                    `
                )
            }
        }

    </script>
</body>

</html>