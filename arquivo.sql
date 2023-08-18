CREATE TABLE arquivo
(
   id_arquivo          int          NOT NULL AUTO_INCREMENT,
   titulo              varchar(300) NOT NULL,   
   nome                varchar(300) NOT NULL,   
   caminho             varchar(300) NOT NULL,   
   datacriacao         DATETIME     NOT NULL DEFAULT   CURRENT_TIMESTAMP,   
   PRIMARY KEY (id_arquivo)
) ENGINE = InnoDB;  
