<?php
require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar vaga');

use \App\Entity\Vaga; //Uso da classe Vaga
$obVaga = new Vaga;

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit; //Teste de funcionalidade
//VALIDAÇÃO DO $_POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

$obVaga-> titulo    = $_POST['titulo'];
$obVaga-> descricao = $_POST['descricao'];
$obVaga-> ativo     = $_POST['ativo'];
$obVaga->cadastrar();

header('location: index.php?status=success');
exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
