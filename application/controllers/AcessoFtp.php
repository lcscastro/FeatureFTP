
<?php

/**
 * Conexão via FTP com PHP
 * 14 01 2020
 * Lucas Castro
 */

class AcessoFtp extends \CI_Controller
{
    public function _construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function conectar()
    {
        $config['hostname'] = '186.202.119.200';
        $config['username'] = 'comti';
        $config['password'] = 'Com@ti0615';
        $config['passive']  = TRUE;
        $config['debug'] = TRUE;
        $config['port'] = 21;
        $this->ftp->connect($config);
//        if( $this->ftp->connect($config)){
//            echo "<br />Login no servidor realizado.<br />";
//        }
//        else {
//            echo "<br />Falha no Login.<br />";
//        }
    }

    public function lista(){

        $this->conectar();
        $pasta_remoto = './httpdocs/hidro';
        $lista = $this->ftp->list_files($pasta_remoto); //Array
        $arquivos = implode("", $lista); //array 0 - gera espaço em branco
        $dados['nome'] = explode('./httpdocs/hidro/', $arquivos); //String
        $dados['lista'] = $this->ftp->list_files($pasta_remoto); //Array
        $this->load->view('lista',$dados);
        $this->ftp->close();

    }

    public function baixar(){
        //Trazer Arquivo Remoto pela lista de arquivos
        $this->conectar();
        $pasta_remoto = './httpdocs/hidro';
        $id = $this->input->get("id");
        $lista = $this->ftp->list_files($pasta_remoto); //Array

        $arquivo_remoto =  $lista[$id]; // Pasta (externa)
        $arquivo_local = './assets/arquivo.pdf'; //Puxar da lista de Arquivos Selecionado
        $this->ftp->download($arquivo_remoto, $arquivo_local, 'auto');
        //Força Download - Arquivo Dentro do Servidor Local
        force_download($arquivo_local, null);
        unlink($arquivo_local); //apagar arquivo local
        $this->ftp->close();

    }

    public function registro(){
        $this->load->view('registro');
    }
}

