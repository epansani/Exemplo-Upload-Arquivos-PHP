<?php
require 'conexao.php';

$sql = "select  id_arquivo, titulo, nome, caminho, DATE_FORMAT(datacriacao,'%d/%m/%Y - %h:%i') as datacriacao from arquivo";

$result = mysqli_query($conn, $sql);

$total = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Listagem de Arquivos</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />

    </head>
    <body>
        <div class="container">
            <h1 class="page-header">Arquivos cadastrados</h1>

            <?php
            if ($total == 0) {
                ?>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert alert-info" role="alert">
                        <h4>Não há arquivos cadastrados.</h4>
                        <p>A tabela está vazia.</p>
                    </div>
                </div>
                <?php
                require 'menu.php';
                exit;
            }
            while ($dados = mysqli_fetch_assoc($result)) {
                $id_arquivo = $dados["id_arquivo"];
                $titulo = $dados["titulo"];
                $nome = $dados["nome"];
                $caminho = $dados["caminho"];
                $datacriacao = $dados["datacriacao"];
                ?>
                <div class="col-sm-4">
                    <h3><?php echo $titulo; ?></h3>
                    <figure>
                        <img class="img-responsive img-rounded"  src="<?php echo $caminho; ?>" alt="<?php echo $nome; ?>" />
                        <figcaption><?php echo $nome; ?></figcaption>
                    </figure>
                </div>
            <?php } ?>
             <?php
            require 'menu.php';
            ?>
            
        </div>
    </body>
</html>

