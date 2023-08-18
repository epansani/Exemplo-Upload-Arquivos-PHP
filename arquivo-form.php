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

            <form id="form_foto" action="arquivo-inserir.php" enctype="multipart/form-data" method="POST" class="form-horizontal" >
                <input type="hidden" name="id_arquivo" id="id_arquivo" value="" required>
                <div class="form-group">
                    <label for="titulo" class="col-sm-2 control-label">
                        Titulo:
                    </label>
                    <div class="col-sm-5">
                        <input type="text" name="titulo" id="titulo" required value="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="arquivo" class="col-sm-2 control-label">
                        Arquivo:
                    </label>
                    <div class="col-sm-5">
                        <input type="file" name="arquivo" id="arquivo" required value="" class="form-control">
                    </div>
                </div>
                <div class="col-sm-9 form-group text-center">
                    <input type="submit" value="Enviar" 
                           id="botao_submit" class="btn btn-primary" >
                    <input type="reset" value="Limpar" 
                           id="botao_limpar" class="btn btn-primary" >
                </div>
            </form>

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