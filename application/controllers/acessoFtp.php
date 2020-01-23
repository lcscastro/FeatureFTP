
<?php

/**
 * Conexão via FTP com PHP
 * 14 01 2020
 * Lucas Castro
 */

class acessoFtp extends \CI_Controller
{
    public function _construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('teste');
    }
    public function login()
    {
        $ftp = ftp_connect('186.202.119.200'); //Retorna: True ou false  - Abrindo Conexão com Servidor FTP
        $login = ftp_login($ftp, 'comti' ,'Com@ti0615');
    }

    function listar(){

    }

    function download(){
        // Define variáveis para o recebimento de arquivo
        $local_arquivo = '/Downloads'; // Localização (local)
        $ftp_pasta = 'public_html'; // Pasta (externa)
        $ftp_arquivo = '/logoTeste.png'; // Nome do arquivo (externo)


        echo "<br />Connecting via FTP...";
        $ftp = ftp_connect('186.202.119.200'); //Retorna: True ou false  - Abrindo Conexão com Servidor FTP
        $login = ftp_login($ftp, 'comti' ,'Com@ti0615');

        //Enable PASV ( Note: must be done after ftp_login() )
        $mode = ftp_pasv($ftp, TRUE);

        //Login OK ?
        if ((!$ftp) || (!$login) || (!$mode)) {
            die("Conexão com FTP Falhou !");
        }
        echo "<br />Login Ok.<br />";

        //Lista Arquivos da Pasta()
/*
        $file_list = ftp_nlist($ftp, $ftp_pasta);
        foreach ($file_list as $file)
        {
            echo "<br>$file";
        }*/

       // Recebe o arquivo pelo FTP (FTP_ASCII(Text) e FTP_BINARY(Img))
        
        if( ftp_get($ftp,$local_arquivo,$ftp_pasta.$ftp_arquivo, FTP_BINARY)){
            echo "\nSalvo com sucesso em $local_arquivo\n";
        }
        else {
            echo "Erro no Download\n";
        }

        // Encerra a conexão ftp
        ftp_close($ftp);

    }

    function upload(){

/*        Define variáveis para o envio de arquivo
    $local_arquivo = './arquivos/documento.doc'; // Localização (local)
    $ftp_pasta = '/public_html/arquivos/'; // Pasta (externa)
   $ftp_arquivo = 'documento.doc'; // Nome do arquivo (externo)

   Envia o arquivo pelo FTP em modo ASCII
    $envio = ftp_put($ftp, $ftp_pasta.$ftp_arquivo, $local_arquivo, FTP_ASCII); // Retorno: true / false
    */
        }

}

