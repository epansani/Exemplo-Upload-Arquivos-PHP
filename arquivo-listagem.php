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
            ?>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TÍTULO</th>
                        <th>NOME ARQUIVO</th>
                        <th>CAMINHO</th>
                        <th>DATA CRIAÇÃO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($dados = mysqli_fetch_assoc($result)) {
                        $id_arquivo = $dados["id_arquivo"];
                        $titulo = $dados["titulo"];
                        $nome = $dados["nome"];
                        $caminho = $dados["caminho"];
                        $datacriacao = $dados["datacriacao"];
                        ?>
                        <tr>
                            <td><?php echo $id_arquivo; ?></td>
                            <td><?php echo $titulo; ?></td>
                            <td><?php echo $nome; ?></td>
                            <td><?php echo $caminho; ?></td>
                            <td><?php echo $datacriacao; ?></td>
                            
                            <td style="width: 9%;" class="text-center" >
                                <a class="btn btn-sm btn-warning" href="arquivo-form-editar.php?id_arquivo=<?php echo $id_arquivo; ?>" >
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a class="btn btn-sm btn-danger" href="arquivo-excluir.php?id_arquivo=<?php echo $id_arquivo; ?>" onclick="if (!confirm('Tem certeza que deseja excluir?'))
                                            return false;">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <?php
            require 'menu.php';
            ?>
            
        </div>
    </body>
</html>

