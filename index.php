<?php
require_once './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require './project-related-files/databaseSendMail.php';
require './project-related-files/pdf-generator.php';

use \setasign\fpdf\FPDF;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="//unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />

    <script src="//unpkg.com/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="//unpkg.com/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script>
    <script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Application</title>
</head>

<body>
    <div class="d-flex vh-100 justify-content-center align-items-center ">
        <form method="post" action="#" class=" border  border-primary p-5">
            <div class="form-group p-1">
                <input name="fname" type="text" class="form-control" id="fname" placeholder="First Name">
            </div>
            <div class="form-group p-1">
                <input name="lname" type="text" class="form-control" id="lname" placeholder="Last Name">
            </div>
            <div class="form-group p-1">
                <input name="company" type="text" class="form-control" id="company" placeholder="Company">
            </div>
            <div class="form-group p-1 ">
                <select name="country" class="selectpicker countrypicker w-100"></select>
            </div>
            <div class="d-flex">
                <div class="form-group p-1 w-25">
                    <input name="prefix" type="text" class="form-control" id="prefix" placeholder="Prefix" value="">
                </div>
                <div class="form-group p-1 w-100">
                    <input name="phone" type="tel" class="form-control" id="phone" placeholder="Phone number">
                </div>
            </div>
            <div class="form-group p-1">
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email address">
                <small id="emailHelp" class="form-text text-muted">We'll value your privacy ...</small>
            </div>
            <button type="submit" class="btn btn-success">Download</button>
        </form>
    </div>
</body>
<script>
    $('.countrypicker').countrypicker();
    $(".countrypicker").change(function() {
        // Get Country Value
        countryCode = $(".countrypicker option:selected").val()
        $.ajax({
            type: "POST",
            url: "./project-related-files/getCountryByCharacters.php",
            data: {
                countryCode: countryCode
            }
        }).done(function(msg) {
            if (msg.length > 0) {
                $("#prefix").val(`+${msg}`)
            }
        });
    });
</script>

</html>