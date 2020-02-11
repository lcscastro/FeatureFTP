
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
        $this->conectar();
    }

    public function index()
    {
        $this->load->view('baixar');
    }
    public function conectar()
    {
        $config['hostname'] = '186.202.119.200';
        $config['username'] = 'comti';
        $config['password'] = 'Com@ti0615';
        $config['passive']  = TRUE;
        $config['debug'] = TRUE;
        $config['port'] = 21;

        if( $this->ftp->connect($config)){
            echo "<br />Login no servidor realizado.<br />";
        }
        else {
            echo "<br />Falha no Login.<br />";
        }
    }

    function listar(){
        $pasta_remoto = './httpdocs/hidro';
        echo " Lista de Arquivos:";
        $list = $this->ftp->list_files($pasta_remoto);

        foreach ($list as $file)
        {
            echo "<br>$file";
        }
        $this->ftp->close();
    }

    function baixar(){

        $arquivo_remoto =  './httpdocs/hidro/hidro.png'; // Pasta (externa)
        $arquivo_local = './assets/teste.png';

        $this->ftp->download($arquivo_remoto, $arquivo_local, 'auto');
        //Força Download - Arquivo Dentro do Servidor Local
        force_download($arquivo_local, null);
        unlink($arquivo_local);
        $this->ftp->close();

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

