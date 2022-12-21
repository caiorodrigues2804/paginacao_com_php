<?php 

// ============ PAGINACAO ============ //
$pagina = 1;

if(isset($_GET['pagina']))
    $pagina = filter_input(INPUT_GET,"pagina",FILTER_VALIDATE_INT);

if(!$pagina)
    $pagina = 1;

$limite = 4;

$inicio = ($pagina * $limite) - $limite;

// ================================== //

$con = new PDO("mysql:host=localhost;dbname=aula",'root','');

$registros = $con->query("SELECT COUNT(nome) count FROM programadores")->fetch()["count"];

$paginas = ceil($registros / $limite);

$result = $con->query("SELECT * FROM `programadores` ORDER BY nome LIMIT $inicio,$limite;")->fetchAll();

// var_dump($result);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginação Simples com PHP</title>
</head>
<body>

    <ul>
        <?php foreach($result as $item): ?>
                <li><?=$item["nome"]?></li>
        <?php endforeach; ?>
    </ul>
    <a href="?pagina=1">Primeira</a>

    <?php if($pagina>1): ?>
    <a href="?pagina=<?=$pagina-1?>"><<<</a>
    <?php endif; ?>

    <?= $pagina ?>

    <?php if($pagina<$paginas): ?>
    <a href="?pagina=<?=$pagina+1?>">>>></a>
    <?php endif; ?>
    
    <a href="?pagina=<?=$paginas?>">Última</a>

</body>
</html>