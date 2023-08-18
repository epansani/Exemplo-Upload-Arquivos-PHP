<!DOCTYPE html>
<html>
    <head>
        <title>Página de alteração de Arquivos</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />

    </head>
    <body>
        <div class="container">
            <h1 class="page-header">Página de alteração de Arquivos</h1>
            <?php
            $id_arquivo = $_POST["id_arquivo"];
            $titulo = addslashes($_POST["titulo"]);

            if (empty($id_arquivo)) {
                ?>
                <div class="alert alert-danger">
                    <h4>Falha ao efetuar alteração: código de arquivo vazio.</h4>
                    <p>
                        Para alterar um registro vá até a 
                        <a href="arquivo-listagem.php">
                            listagem 
                        </a> e clique no botão 
                        <strong>Editar</strong>.
                    </p>
                </div>
                <?php
                exit;
            }

            require 'conexao.php';

            $sql0 = "select * from arquivo 
                        where id_arquivo = $id_arquivo";
            $result0 = mysqli_query($conn, $sql0);

            $dados0 = mysqli_fetch_assoc($result0);
            $caminho0 = $dados0["caminho"];

            try {
                if (unlink($caminho0)) {
                    if (!empty($_FILES["arquivo"]['tmp_name'])) {
                        $date = date("Ymdhis");
                        $caminho = "arquivos/" . $date . "_" . $_FILES["arquivo"]['name'];
                        if (move_uploaded_file($_FILES["arquivo"]['tmp_name'], $caminho)) {
                            $nome = $_FILES["arquivo"]['name'];
                            $caminho = $caminho;

                            $sql = "UPDATE arquivo SET "
                                    . " titulo = '$titulo', "
                                    . " nome = '$nome', "
                                    . " caminho = '$caminho' "
                                    . " WHERE id_arquivo = $id_arquivo";
                            $result = mysqli_query($conn, $sql);

                            if ($result == true) {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <h4>Dados alterados com sucesso!</h4>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <h4>Falha ao efetuar alteração.</h4>
                                    <p><?php echo mysqli_error($conn); ?></p>
                                    <p>SQL Executado: <?php echo $sql; ?></p>
                                </div>
                                <?php
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Falha ao efetuar alteração.</h4>
                    <p><?php echo "<pre>$e</pre>"; ?></p>
                </div>
                <?php
            }
            require 'menu.php';
            ?>

        </div>
    </body>
</html>