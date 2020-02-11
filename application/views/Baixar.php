<html lang="br">
<head>
    <link rel="stylesheet" href="<?= base_url("vendor/twbscss/bootstrap/scssbootstrap.css") ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
</head>
<body>
<div class="container">

        <h1>Download FTP</h1>
        <?php
        echo form_open("download");

        echo form_button(array(
            "class" => "btn btn-default",
            "content" => "Baixar",
            "type" => "submit"
        ));

        echo form_close();
        ?>

    <div>
</body>
</html>