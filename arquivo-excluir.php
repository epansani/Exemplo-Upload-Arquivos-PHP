<!DOCTYPE html>
<html>
    <head>
        <title>Página de exclusão de Arquivos</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />

    </head>
    <body>
        <div class="container">
            <h1 class="page-header">Página de exclusão de Arquivos</h1>
            <?php
            $id_arquivo = $_GET["id_arquivo"];

            if (empty($id_arquivo)) {
                ?>
                <div class="alert alert-danger">
                    <h4>Falha ao efetuar exclusão: código de arquivo vazio.</h4>
                    <p>
                        Para excluir um registro vá até a 
                        <a href="arquivo-listagem.php">
                            listagem 
                        </a> e clique no botão 
                        <strong>Excluir</strong>.
                    </p>
                </div>
                <?php
                exit;
            }

            require 'conexao.php';

            $sql = "select * from arquivo 
                        where id_arquivo = $id_arquivo";

            $result = mysqli_query($conn, $sql);

            $dados = mysqli_fetch_assoc($result);
            $titulo = $dados["titulo"];
            $nome = $dados["nome"];
            $caminho = $dados["caminho"];

            try {
                if (unlink($caminho)) {

                    $sql = "DELETE FROM arquivo WHERE id_arquivo = $id_arquivo";
                    $result = mysqli_query($conn, $sql);

                    if ($result == true) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            <h4>Arquivo excluído com sucesso!</h4>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <h4>Falha ao efetuar exclusão.</h4>
                            <p><?php echo mysqli_error($conn); ?></p>
                            <p>SQL Executado: <?php echo $sql; ?></p>
                        </div>
                        <?php
                    }
                }
            } catch (Exception $e) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Falha ao efetuar exclusão.</h4>
                    <p><?php echo "<pre>$e</pre>"; ?></p>
                </div>
                <?php
            }
            require 'menu.php';
            ?>

        </div>
    </body>
</html>