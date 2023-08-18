<!DOCTYPE html>
<html>
    <head>
        <title>Formulário de Envio de Arquivos</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />

    </head>
    <body>
        <div class="container">
            <h1 class="page-header">Formulário de Envio de Arquivos</h1>
            <?php
            require 'conexao.php';

            $titulo = addslashes($_POST["titulo"]);

            try {
                if (!empty($_FILES["arquivo"]['tmp_name'])) {
                    $date = date("Ymdhis");
                    $caminho = "arquivos/" . $date . "_" . $_FILES["arquivo"]['name'];
                    if (move_uploaded_file($_FILES["arquivo"]['tmp_name'], $caminho)) {
                        $nome = $_FILES["arquivo"]['name'];
                        $caminho = $caminho;

                        $sql = "INSERT INTO arquivo (titulo, nome, caminho) "
                                . " VALUES ('$titulo', '$nome', '$caminho')";
                        $result = mysqli_query($conn, $sql);

                        if ($result == true) {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <h4>Dados gravados com sucesso!</h4>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <h4>Falha ao efetuar gravação.</h4>
                                <p><?php echo mysqli_error($conn); ?></p>
                                <p>SQL Executado: <?php echo $sql; ?></p>
                            </div>
                            <?php
                        }
                    }
                }
            } catch (Exception $e) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Falha ao efetuar gravação.</h4>
                    <p><?php echo "<pre>$e</pre>"; ?></p>
                </div>
                <?php
            }
            require 'menu.php';
            ?>

        </div>
    </body>
</html>