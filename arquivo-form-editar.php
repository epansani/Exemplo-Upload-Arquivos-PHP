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
            $id_arquivo = $_GET["id_arquivo"];

            if (empty($id_arquivo)) {
                ?>
                <div class="alert alert-danger">
                    <h4>Falha ao abrir formulário de alteração</h4>
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

            $sql = "select * from arquivo 
                        where id_arquivo = $id_arquivo";

            $result = mysqli_query($conn, $sql);

            $dados = mysqli_fetch_assoc($result);
            $titulo = $dados["titulo"];
            $nome = $dados["nome"];
            $caminho = $dados["caminho"];
            ?>

            <div class="row">
                <div class="col-sm-7">
                    <form id="form_foto" action="arquivo-editar.php" enctype="multipart/form-data" method="POST" class="form-horizontal" >
                        <input type="hidden" name="id_arquivo" id="id_arquivo" value="<?php echo $id_arquivo; ?>" required>
                        <div class="form-group">
                            <label for="titulo" class="col-sm-3 control-label">
                                Titulo:
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="titulo" id="titulo" required value="<?php echo $titulo; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arquivo" class="col-sm-3 control-label">
                                Arquivo:
                            </label>
                            <div class="col-sm-9">
                                <input type="file" name="arquivo" id="arquivo" required value="" class="form-control">
                                <span id="helpBlock" class="help-block">
                                    Ao escolher uma nova imagem a antiga será apagada.
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group text-center">
                            <input type="submit" value="Enviar" 
                                   id="botao_submit" class="btn btn-primary" >
                            <input type="reset" value="Limpar" 
                                   id="botao_limpar" class="btn btn-primary" >
                        </div>
                    </form>
                </div>
                <div class="col-sm-5">
                    <figure>
                        <img class="img-responsive img-rounded"  src="<?php echo $caminho; ?>" alt="<?php echo $nome; ?>" />
                        <figcaption><?php echo $nome; ?></figcaption>
                    </figure>
                </div>
            </div>

            <?php
            require 'menu.php';
            ?>

            <?php
            $filename = 'arquivos/';
            if (!is_writable($filename)) {
                ?>
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="alert alert-danger" role="alert">
                        <h2>Atenção!</h2>
                        <p>O diretório <code>arquivos/</code> não possui permissões de gravação.</p>
                        <p><b><u>Não será possível enviar arquivos!</u></b></p>
                        <p>
                            Caso você esteja usando um servidor apache2 padrão sugere-se o uso do comando:
                            <br>
                            <code>
                                sudo chown www-data:www-data arquivos/
                            </code>
                        </p>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

    </body>
</html>