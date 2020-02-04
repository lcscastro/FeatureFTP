
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


    function baixar(){
        $this->load->helper('download');
        $config['hostname'] = '186.202.119.200';
        $config['username'] = 'comti';
        $config['password'] = 'Com@ti0615';
        $config['passive']  = TRUE;
        $config['debug']        = TRUE;

        $arquivo_local = dirname(__FILE__) . '\assets\\';

        echo "<br />Connecting via FTP...";
        if( $this->ftp->connect($config)){
            echo "<br />Login Ok.<br />";
        }
        else {
            echo "<br />Falha no Login.<br />";
        }

        echo " Lista de Arquivos:";
        $list = $this->ftp->list_files('./public_html/');

        foreach ($list as $file)
        {
            echo "<br>$file";
        }

        //download($remotepath, $localpath[, $mode = 'auto'])
        if ($this->ftp->download('./public_html/logoTeste.png', $arquivo_local, 'auto')){
            echo "<br>Salvo com sucesso";
        }else {
            echo "<br>Erro no Download\n";
        }

        $this->ftp->close();

    }


    function download1(){
        // Define variáveis para o recebimento de arquivo php://temp
        $arquivo_local = 'php://temp'; // Localização (local)
        $arquivo_remoto = './public_html/logoTeste.png'; // Pasta (externa)
        $ftp_arquivo = ''; // Nome do arquivo (externo)


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

        $handle = fopen($arquivo_local, 'r'); //Problema no Diretorio

       // Recebe o arquivo pelo FTP (FTP_ASCII(Text) e FTP_BINARY(Img))

        if( ftp_fget($ftp,$handle,$arquivo_remoto,FTP_BINARY, 0)){
            echo "\nSalvo com sucesso\n";
        }
        else {
            echo "Erro no Download\n";
        }
        // Encerra a conexão ftp
        ftp_close($ftp);
//        fclose($handle);

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

