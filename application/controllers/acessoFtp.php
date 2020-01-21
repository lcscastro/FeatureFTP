
<?php
namespace acessoFtp;
/**
 * Conexão via FTP com PHP
 * 14 01 2020
 * Lucas Castro
 */

class acessoFtp extends \CI_Controller
{

    function login()
    {
        $ftp = ftp_connect($servidor); //Retorna: True ou false  - Abrindo Conexão com Servidor FTP

    }

    function listar(){

    }

    function baixar(){

    }
}

