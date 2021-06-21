-- PROJECT

SELECT a.id_agente id, a.nome, a.foto_arquivo foto, ac.password, ac.estado_conta estado
FROM agente_conta ac 
JOIN agente a ON ac.id_agente = a.id_agente 
WHERE ac.nip =  1921765;

SELECT ap.id_posto posto, ap.cargo 
FROM agente_conta ac 
JOIN agente_posto ap ON ac.id_agente = ap.id_agente 
WHERE ac.id_agente =  1;

-- Caso 
SELECT acm.id_cm, acm.cargo 
FROM agente_conta ac 
JOIN agente_comando_municipal acm ON ac.id_agente = acm.id_agente 
WHERE ac.id_agente =  1;

-- Criar agente

INSERT INTO `sird-db`.`agente`
(`id_agente`, `nome`,
`sobrenome`,
`foto_arquivo`,
`data_nasc`,
`genero`)
VALUES
(NULL,
'Vic',
'Kioz',
'usuario.png',
'2021-04-01',
'Masculino');

-- Adicionar dados de conta

INSERT INTO `sird-db`.`agente_conta`
(`id_agente`,
`nip`,
`password`,
`estado_conta`,
`data_cadastro`)
VALUES
(3,
1231543,
'fdkuagdkuagdkugwdg',
0,
CURRENT_TIMESTAMP);

-- Adicionar Agente a um posto

INSERT INTO `sird-db`.`agente_posto`
(`id_agente`,
`id_posto`)
VALUES
(1,
1);

-- Adicionando agente a um comando municipal

INSERT INTO `sird-db`.`agente_comando_municipal`
(`id_agente`,
`id_cm`,
`cargo`)
VALUES
(7,
1,
1);




SELECT nip FROM agente_conta WHERE nip =  1921765;

INSERT INTO `sird-db`.`agente_comando_municipal`
(`id_agente`,
`id_cm`,
`cargo`)
VALUES
(7,
1,
2);

-- Cadastros

SELECT a.id_agente id, a.nome, a.sobrenome, a.genero, ac.nip 
FROM agente a 
JOIN agente_conta ac ON ac.id_agente = a.id_agente 
WHERE ac.estado_conta = 0;

-- Permitir

SELECT a.nome, a.sobrenome, a.genero, a.data_nasc data_nascimento, ac.nip, a.foto_arquivo foto 
FROM agente_conta ac 
JOIN agente a ON ac.id_agente = a.id_agente 
WHERE a.id_agente = 1;

SELECT id_posto, nome, tipo FROM posto WHERE estado_actividade = 1;

SELECT id_agente FROM agente_conta WHERE estado_conta > 0 AND id_agente = 17;

SELECT id_agente FROM agente WHERE  id_agente = 17;

DELETE FROM agente WHERE id_agente = 17;
DELETE FROM agente_conta WHERE id_agente = 17;

SELECT foto_arquivo foto FROM agente WHERE id_agente = 16;

SELECT a.nome, a.sobrenome, p.nome, p.tipo,  ac.nip
                    FROM agente_conta ac 
                    JOIN agente a ON ac.id_agente = a.id_agente
                    JOIN agente_posto ap ON ac.id_agente = ap.id_agente
                    JOIN posto p ON ap.id_posto = p.id_posto;
                    
-- Postos

CREATE VIEW listar_postos AS SELECT p.id_posto, p.tipo, p.nome, pl.distrito, b.bairro, pl.rua, cml.municipio
FROM posto p 
JOIN posto_localizacao pl ON p.id_posto = pl.id_posto
JOIN bairro b ON b.id_bairro= pl.bairro
JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm 
WHERE p.estado_actividade = 1;

select * from listar_postos;

CREATE VIEW ver_posto AS SELECT p.id_posto, p.tipo, p.data_criacao, p.nome, pl.distrito, b.bairro, pl.rua, cml.municipio
FROM posto p 
JOIN posto_localizacao pl ON p.id_posto = pl.id_posto
JOIN bairro b ON b.id_bairro= pl.bairro
JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm WHERE p.estado_actividade = 1;

select * from listar_postos  WHERE id_posto = 1 ;

SELECT * FROM ver_posto WHERE id_posto = 1;

SELECT acm.id_cm, acm.cargo,acm.id_cm
                                        FROM agente_conta ac 
                                        JOIN agente_comando_municipal acm 
                                        ON ac.id_agente = acm.id_agente  
                                        WHERE ac.id_agente =  7;

select * FROM bairro;

SELECT * FROM ver_posto WHERE id_posto = 1;

-- Actualizar postos
UPDATE `sird-db`.`posto`
SET
`tipo` = ,
`nome` = 
WHERE `id_posto` = ;

UPDATE `sird-db`.`posto_localizacao`
SET
`distrito` = ,
`bairro` = ,
`rua` = 
WHERE `id_posto` = ;


-- Eliminar Posto

-- - Verificando a seleção
SELECT `agente_posto`.`id_agente`
FROM `sird-db`.`agente_posto`
WHERE id_posto = 6;

-- - Suspender a conta

UPDATE `sird-db`.`agente_conta`
SET
`estado_conta` = 2
WHERE id_agente = 19;

-- - Eliminando a relação
DELETE FROM `sird-db`.`agente_posto`
WHERE id_agente = 19;

-- - eliminando as operações

DELETE FROM `sird-db`.`operacao_posto`
WHERE id_posto = 6;

-- - Eliminando a localização do posto

DELETE FROM `sird-db`.`posto_localizacao`
WHERE id_posto = 6;

-- - Eliminando o Posto

DELETE FROM `sird-db`.`posto`
WHERE id_posto = 6;

-- Consultando registro de alterações

SELECT op.tipo, op.data, a.nome, a.sobrenome
FROM `sird-db`.operacao_posto op 
JOIN agente a ON a.id_agente = op.id_agente
WHERE id_posto = 1 order by data desc;

-- Consultando Bairros

select * FROM bairro;


-- Consultando categoria de documentos

SELECT * FROM categoria_documento;

-- Adicionando Bairro

INSERT INTO `sird-db`.`bairro`
(`bairro`)
VALUES
('Nova Vida');

SELECT `bairro`.`id_bairro`,
    `bairro`.`bairro`
FROM `sird-db`.`bairro`;

select * from bairro WHERE id_bairro = 2;

-- Editando bairro

UPDATE `sird-db`.`bairro`
SET
`bairro` = 'Danjaré'
WHERE `id_bairro` = 2;

-- eliminando bairro

DELETE FROM `sird-db`.`bairro`
WHERE id_bairro = 5;

-- Ver categorias

SELECT `categoria_documento`.`id_categoria_documento`,
    `categoria_documento`.`categoria`
FROM `sird-db`.`categoria_documento`;


CREATE TABLE `distrito` (
  `id_bairro` smallint NOT NULL AUTO_INCREMENT,
  `bairro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_bairro`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


SELECT b.bairro, d.distrito FROM bairro b 
JOIN distrito d ON b.bairro;


CREATE TABLE `distrito` (
  `id_bairro` mediumint(7zzyyyy NOT NULL AUTO_INCREMENT,
  `bairro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_bairro`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


ALTER TABLE bairro ADD INDEX dis_d ( distrito );
ALTER TABLE bairro ADD CONSTRAINT distrito_d
FOREIGN KEY ( distrito ) REFERENCES distrito ( distrito ) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE Contact ADD INDEX par_ind ( Person_Id );
ALTER TABLE Contact ADD CONSTRAINT fk_person.
FOREIGN KEY ( Person_Id ) REFERENCES Person ( ID ) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE bairro ADD CONSTRAINT distrito_d FOREIGN KEY (distrito) REFERENCES distrito(id_distrito);


INSERT INTO `sird-db`.`distrito`
(`id_distrito`,
`distrito`)
VALUES
(<{id_distrito: }>,
<{distrito: }>);

UPDATE `sird-db`.`comando_municipal_localizacao`
SET

`distrito` = 1

WHERE id_cm = 1;


LOCK TABLES 
    propietario_documento WRITE,
    proprietario_telefone WRITE,
    entregador_proprietario WRITE,
    local_documento WRITE,
    documentos WRITE;



ALTER TABLE entregador_proprietario
    DROP FOREIGN KEY `id_proprietario-ep`,
    MODIFY id_proprietario MEDIUMINT UNSIGNED;
    
ALTER TABLE propietario_documento MODIFY id_proprietario MEDIUMINT UNSIGNED AUTO_INCREMENT;

ALTER TABLE entregador_proprietario
    ADD CONSTRAINT `id_proprietario-ep` FOREIGN KEY (id_proprietario)
          REFERENCES proprietario_documento (id_proprietario);

ALTER TABLE local_documento
    DROP FOREIGN KEY `id_proprietario-ld`,
    MODIFY id_proprietario MEDIUMINT UNSIGNED;
 
 ALTER TABLE local_documento
    ADD CONSTRAINT `id_proprietario-ld` FOREIGN KEY (id_proprietario)
          REFERENCES propietario_documento (id_proprietario);
          
    ALTER TABLE documentos
    DROP FOREIGN KEY `id_proprietario-d`,
    MODIFY id_proprietario MEDIUMINT UNSIGNED;

ALTER TABLE documentos
    ADD CONSTRAINT `id_proprietario-d` FOREIGN KEY (id_proprietario)
          REFERENCES propietario_documento (id_proprietario);
          
    ALTER TABLE proprietario_telefone
    DROP FOREIGN KEY `id_proprietario-pt`,
    MODIFY id_proprietario MEDIUMINT UNSIGNED;
  
  ALTER TABLE proprietario_telefone
    ADD CONSTRAINT `id_proprietario-pt` FOREIGN KEY (id_proprietario)
          REFERENCES propietario_documento (id_proprietario);
   
UNLOCK TABLES;


INSERT INTO `sird-db`.`operacao_documento`
(`id_operacao`,
`id_documento`,
`id_agente`,
`tipo`,
`data`)
VALUES(
NULL,
1,
1,
1,
CURRENT_TIMESTAMP);
-- Pubicar ocumento	

INSERT INTO `sird-db`.`propietario_documento`
                            (`id_proprietario`,
                            `nome_completo`)
                            VALUES
                            (1,
                            'victor');
                            
INSERT INTO `sird-db`.`proprietario_telefone`
                            (`id_proprietario`,
                            `telefone`)
                            VALUES
                            (1,
                            '923435643');
                            
SELECT id_proprietario FROM propietario_documento order by id_proprietario desc LIMIT 1;
                            
INSERT INTO `sird-db`.`entregador_documento`
                (`id_entregador`,
                `nome_completo`,
                `telefone`)
                VALUES
                (NULL,
                'mano',
                91145254);
INSERT INTO `sird-db`.`entregador_proprietario`
                            (`id_entregador`,
                            `id_proprietario`)
                            VALUES
                            (1,
                            1);
INSERT INTO `sird-db`.`documentos`
                            (`id_documento`,
                            `categoria_documento`,
                            `data_emissao`,
                            `identifacador`,
                            `id_proprietario`,
                            `estado`)
                            VALUES
                            (NULL,
                            3,
                            '2021-04-25',
                            'poohh5155',
                            99,
                            1);
INSERT INTO `sird-db`.`foto_documento`
(`id_foto`,
`id_documento`,
`arquivo`)
VALUES
(NULL,
1,
'no-img.png');


INSERT INTO `sird-db`.`local_documento`
                            (`tipo_local`,
                            `id_proprietario`,
                            `id_local`)
                            VALUES
                            ('posto',
                            1,
                            1);
INSERT INTO `sird-db`.`operacao_documento` 
                                    (`id_operacao`, 
                                    `id_agente`, 
                                    `id_documento`, 
                                    `tipo`, 
                                    `data`) 
                                    VALUES(NULL, 
                                    1, 
                                    1, 
                                    1, 
                                    CURRENT_TIMESTAMP);



















CREATE VIEW comando_municipal_informacao AS SELECT cm.data_criacao, cml.provincia, cml.municipio, cml.distrito, cml.bairro, cml.rua  FROM comando_municipal cm JOIN comando_municipal_localizacao cml ON cm.id_comando_municipal = cml.id_cm;
SELECT * FROM comando_municipal_informacao;

INSERT INTO comando_municipal VALUES(NULL, current_timestamp());
INSERT INTO comando_municipal_localizacao VALUES(1, "Luanda", "Talatona", "SIAC", "Belas", "4");

UPDATE comando_municipal_localizacao 
SET provincia = "Luanda", municipio = "Talatona", distrito = "SIAC", bairro = "Belas", rua = "5" WHERE id_cm = 1;
SELECT * FROM comando_municipal_informacao WHERE id_cm = 1;

INSERT INTO `sird-db`.`agente`
(
`nome`,
`sobrenome`,
`foto_arquivo`,
`data_nasc`,
`genero`)
VALUES
(
'João',
'Bastos',
'usuario.png',
'1990-01-04',
'Masculino');

INSERT INTO `sird-db`.`posto`
(`id_posto`,
`id_comando_municipal`,
`tipo`,
`nome`,
`data_criacao`,
`estado_actividade`)
VALUES
(null,
1,
1,
'Mbondo Chapé',
CURRENT_TIMESTAMP,
1);

INSERT INTO `sird-db`.`operacao_posto`
(`id_operacao`,
`id_agente`,
`id_posto`,
`tipo`,
`data`)
VALUES
(NULL,
1,
1,
1,
CURRENT_TIMESTAMP);

INSERT INTO `sird-db`.`posto_localizacao`
(`id_posto`,
`distrito`,
`bairro`,
`rua`)
VALUES
(1,
'Talatona',
'Mbondo Chapé',
'3');

INSERT INTO `sird-db`.`agente_posto`
(`id_agente`,
`id_posto`,
`cargo`)
VALUES
(1,
1,
1);

INSERT INTO `sird-db`.`agente_conta`
(`id_agente`,
`nip`,
`password`,
`estado_conta`,
`data_cadastro`)
VALUES
(1,
1921765,
'mbondochapé',
1,
current_timestamp());

INSERT INTO `sird-db`.`operacao_comando_municipal` (`id_operacao`, `id_agente`, `id_cm`, `tipo`, `data`) VALUES(NULL, 1, 1, 2, CURRENT_TIMESTAMP);

-- listar documentos
	SELECT * FROM listar_documentos;
SELECT d.categoria_documento, pd.id_proprietario, pd.nome_completo, od.data, 
GROUP_CONCAT( d.categoria_documento ) as "categoria_documentos" 
FROM propietario_documento pd 
JOIN documentos d 
ON d.id_proprietario = pd.id_proprietario
JOIN operacao_documento od 
ON d.id_documento = od.id_documento
group by pd.id_proprietario;

SELECT d.categoria_documento, DISTINCT(pd.id_proprietario), pd.nome_completo, od.data, 
GROUP_CONCAT( d.categoria_documento ) as "categoria_documentos" 
FROM propietario_documento AS pd
INNER JOIN documentos  AS d ON d.id_proprietario=pd.id_proprietario
INNER JOIN operacao_documento   AS od ON d.id_documento = od.id_documento
GROUP BY d.id_proprietario;

   SELECT pd.*,
          (SELECT GROUP_CONCAT(d.categoria_documento)
             FROM documentos d 
            WHERE d.id_proprietario = pd.id_proprietario) AS categorias
     FROM propietario_documento pd;
     
     SELECT DISTINCT pd.nome_completo, pd.id_proprietario, group_concat(cd.categoria) AS categorias
     FROM propietario_documento pd 
     JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
	 JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento WHERE d.estado = 1 GROUP BY pd.id_proprietario ;
     
     -- Pagina Principal
     
     -- Cidadao
     
     SELECT DISTINCT pd.nome_completo, pd.id_proprietario, group_concat(cd.categoria) 
     AS categorias,  group_concat(fd.arquivo) AS fotos,
     ld.*
     FROM propietario_documento pd 
     JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
	 JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
     JOIN foto_documento fd ON d.id_documento = fd.id_documento
     JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
     WHERE pd.id_proprietario = 1 GROUP BY pd.id_proprietario;
     
     SELECT p.nome, d.distrito, b.bairro, pl.rua, cml.municipio
	 FROM posto p 
	JOIN posto_localizacao pl ON p.id_posto = pl.id_posto
	JOIN bairro b ON b.id_bairro= pl.bairro
    JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`))
	JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm WHERE p.id_posto = 1;
     
	SELECT p.nome, d.distrito, b.bairro, pl.rua, cml.municipio
	 FROM posto p 
	JOIN posto_localizacao pl ON p.id_posto = pl.id_posto
	JOIN bairro b ON b.id_bairro= pl.bairro
    JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`))
	JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm WHERE p.id_posto = 1;
    

	SELECT cml.provincia, cml.municipio, d.distrito, b.bairro, cml.rua  
    FROM comando_municipal cm 
    JOIN comando_municipal_localizacao cml ON cm.id_comando_municipal = cml.id_cm
    JOIN bairro b ON b.id_bairro= pl.bairro
    JOIN distrito d ON ((d.id_distrito = cml.distrito));

			SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
                        AS categorias, group_concat(od.data) 
                        AS datas, group_concat(d.id_documento) 
                        AS ids,  group_concat(fd.arquivo) AS fotos,
                        ld.tipo_local, ld.id_local
                        FROM propietario_documento pd 
                        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                        JOIN operacao_documento od ON od.id_documento = d.id_documento
						JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                        JOIN foto_documento fd ON d.id_documento = fd.id_documento
                        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
                         WHERE d.estado = 1 AND pd.id_proprietario = 126 GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC;	
          
-- ver documento principal 

						CREATE VIEW ver_documento_principal AS SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
                        AS categorias, group_concat(od.data) 
                        AS datas, group_concat(d.id_documento) 
                        AS ids,
                        ld.tipo_local, ld.id_local
                        FROM propietario_documento pd 
                        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                        JOIN operacao_documento od ON od.id_documento = d.id_documento
						JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                        JOIN foto_documento fd ON d.id_documento = fd.id_documento
                        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
                         WHERE d.estado = 1 GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC;	
                         
                         SELECT * FROM ver_documento_principal LIMIT 1, 10;
                         
                         -- 
                         SELECT DISTINCT pd.nome_completo AS nome_proprietario, pd.id_proprietario, ed.nome_completo 
                         AS nome_entregador, ed.telefone AS telefone_entregador,  group_concat(cd.categoria) 
                        AS categorias, group_concat(od.data)
                        AS datas,   group_concat(fd.arquivo) AS fotos,
                        group_concat(pt.telefone) 
                        AS telefone_proprietario, group_concat(d.id_documento) 
                        AS ids,
                        ld.tipo_local, ld.id_local
                        FROM propietario_documento pd 
                        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                        JOIN operacao_documento od ON od.id_documento = d.id_documento
						JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                        JOIN foto_documento fd ON d.id_documento = fd.id_documento
                        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
                        JOIN proprietario_telefone pt ON pt.id_proprietario = pd.id_proprietario
                        JOIN entregador_proprietario ep ON ep.id_proprietario = pd.id_proprietario
                        JOIN entregador_documento ed ON ed.id_entregador = ep.id_entregador
                         WHERE d.estado = 1 GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC;
                         
                         -- entregues
                         
						CREATE VIEW ver_documentos_entregues AS SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
                        AS categorias, group_concat(od.data) 
                        AS datas, group_concat(d.id_documento) 
                        AS ids,
                        ld.tipo_local, ld.id_local
                        FROM propietario_documento pd 
                        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                        JOIN operacao_documento od ON od.id_documento = d.id_documento
						JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                        JOIN foto_documento fd ON d.id_documento = fd.id_documento
                        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
						WHERE d.estado = 3 GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC;
                        
                         
-- estatisticas da pagina principal - COMANDO MUNICIPAL
CREATE VIEW estatisticas_comando_municipal AS SELECT COUNT(*) AS total_documentos FROM documentos 
UNION SELECT COUNT(*) AS total_perdidos FROM documentos WHERE estado = 1 
UNION SELECT COUNT(*) AS total_perdidos FROM documentos WHERE estado = 3;

-- estatisticas da pagina principal - POSTO
SELECT COUNT(*) AS total_documentos FROM documentos 
UNION SELECT COUNT(*) FROM documentos WHERE estado = 1 
UNION SELECT COUNT(*) FROM documentos WHERE estado = 3;


SELECT COUNT(*) AS total_documentos
FROM propietario_documento pd 
JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
WHERE ld.tipo_local LIKE '%posto%' AND ld.id_local = 1 AND d.estado = 1
UNION
SELECT COUNT(*) AS total_documentos
FROM propietario_documento pd 
JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
WHERE ld.tipo_local LIKE '%posto%' AND ld.id_local = 1 AND d.estado = 3;
-- devolver documento 

UPDATE documentos SET estado = 3 WHERE id_documento = 114;

INSERT INTO `sird-db`.`operacao_documento` 
                                (`id_operacao`, 
                                `id_agente`, 
                                `id_documento`, 
                                `tipo`, 
                                `data`) 
                                VALUES(NULL, 
                                1, 
                                18, 
                                4, 
                                CURRENT_TIMESTAMP);

-- procurar documento

	SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
        AS categorias, group_concat(od.data) 
        AS datas,   group_concat(fd.arquivo) AS fotos,
        ld.tipo_local, ld.id_local
        FROM propietario_documento pd 
        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
        JOIN operacao_documento od ON od.id_documento = d.id_documento
        JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
        JOIN foto_documento fd ON d.id_documento = fd.id_documento
        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
        JOIN proprietario_telefone pt ON pt.id_proprietario = pd.id_proprietario
         WHERE d.estado = 3 AND d.identifacador LIKE '%a%' 
         OR pd.nome_completo LIKE '%a%' OR cd.categoria LIKE '%a%' 
         OR pt.telefone LIKE '%a%'
         GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC;

-- eliminar documento

SELECT id_documento FROM documentos WHERE id_proprietario = 126;

UPDATE documentos SET estado = 3 WHERE id_documento =;
INSERT INTO `sird-db`.`operacao_documento` 
                                (`id_operacao`, 
                                `id_agente`, 
                                `id_documento`, 
                                `tipo`, 
                                `data`) 
                                VALUES(NULL, 
                                7, 
                                32, 
                                2, 
                                CURRENT_TIMESTAMP);

-- editar perfil

UPDATE agente SET nome = 'Joao', sobrenome = 'bastos', data_nasc = '1990-01-05', genero = 'Masculino', foto_arquivo = 'usuario.png' WHERE id_agente = 1;

UPDATE agente SET nome = NOME, sobrenome = SOBRENOME, data_nasc = DATA, genero = GENERO WHERE id_agente = ID_AGENTE;


SELECT a.nome , a.sobrenome, 
                a.data_nasc as data_nascimento, a.genero, a.foto_arquivo as foto,
                 ac.nip, a.id_agente, ac.password
                FROM agente_conta ac 
                JOIN agente a ON ac.id_agente = a.id_agente;
                
SELECT 
            ac.password
            FROM agente_conta ac 
            WHERE ac.id_agente = 7;
            
UPDATE agente_conta SET password = '$2y$10$/rXOVS8ZJu9E/uVHln3ebuI57d4jjO.Zu6uanzioOkmmPWgESDuaa' WHERE id_agente = 7;

-- Criando Comando Provincial

CREATE TABLE `comando_provincial` (
  `id_comando_provincial` tinyint NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(70) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comando_provincial`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE `comando_provincial_localizacao` (
  `id_cp` tinyint NOT NULL,
  `provincia` mediumint NOT NULL,
  `municipio` mediumint NOT NULL,
  `distrito` mediumint NOT NULL,
  `bairro` smallint NOT NULL,
  `rua` varchar(40) DEFAULT NULL,
  KEY `id_cp_idx` (`id_cp`),
  CONSTRAINT `id_cp-cpl` FOREIGN KEY (`id_cp`) REFERENCES `comando_provincial` (`id_comando_provincial`),
  KEY `distrito_idx` (`distrito`),
  CONSTRAINT `distrito-cpl` FOREIGN KEY (`distrito`) REFERENCES `distrito` (`id_distrito`),
  KEY `bairro_idx` (`bairro`),
  CONSTRAINT `bairro-cpl` FOREIGN KEY (`bairro`) REFERENCES `bairro` (`id_bairro`),
  KEY `municipio_idx` (`municipio`),
  CONSTRAINT `municipio-cpl` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`id_municipio`),
  KEY `provincia_idx` (`provincia`),
  CONSTRAINT `provincia-cpl` FOREIGN KEY (`provincia`) REFERENCES `provincia` (`id_provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `posto_localizacao` (
  `id_posto` mediumint NOT NULL,
  `distrito` varchar(45) NOT NULL,
  `bairro` smallint NOT NULL,
  `rua` varchar(40) DEFAULT NULL,
  KEY `id_posto_idx` (`id_posto`),
  KEY `bairro-pl_idx` (`bairro`),
  CONSTRAINT `bairro-pl` FOREIGN KEY (`bairro`) REFERENCES `bairro` (`id_bairro`),
  CONSTRAINT `id_posto-pl` FOREIGN KEY (`id_posto`) REFERENCES `posto` (`id_posto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `agente_comando_provincial` (
  `id_agente` int NOT NULL,
  `id_comando_provincial` tinyint NOT NULL,
  `cargo` tinyint NOT NULL DEFAULT '1',
  KEY `id_oficial_idx` (`id_agente`),
  KEY `id_comando_provincial_idx` (`id_comando_provincial`),
  CONSTRAINT `id_agente-acp` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`),
  CONSTRAINT `id_comando_provincial-acp` FOREIGN KEY (`id_comando_provincial`) REFERENCES `comando_provincial` (`id_comando_provincial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `provincia` (
  `id_provincia` mediumint NOT NULL AUTO_INCREMENT,
  `provincia` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_provincia`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




























-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sird-db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sird-db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sird-db` DEFAULT CHARACTER SET utf8 ;
USE `sird-db` ;

-- -----------------------------------------------------
-- Table `sird-db`.`comando_municipal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`comando_municipal` (
  `id_comando_municipal` TINYINT(5) NOT NULL AUTO_INCREMENT,
  `data_criacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comando_municipal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`posto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`posto` (
  `id_posto` MEDIUMINT(5) NOT NULL,
  `id_comando_municipal` TINYINT NOT NULL,
  `tipo` TINYINT(2) NOT NULL DEFAULT 1,
  `nome` VARCHAR(55) NOT NULL,
  `data_criacao` DATETIME NOT NULL,
  `estado_actividade` TINYINT(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_posto`),
  INDEX `id_comando_municipal_idx` (`id_comando_municipal` ASC),
  CONSTRAINT `id_comando_municipal-p`
    FOREIGN KEY (`id_comando_municipal`)
    REFERENCES `sird-db`.`comando_municipal` (`id_comando_municipal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial` (
  `id_oficial` INT(10) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `sobrenome` VARCHAR(100) NOT NULL,
  `foto_arquivo` VARCHAR(200) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `oficial_info_id_oficial` INT(10) NOT NULL,
  `genero` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_oficial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial_conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial_conta` (
  `id_oficial` INT NOT NULL,
  `nip` MEDIUMINT(7) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `estado_conta` TINYINT(2) NOT NULL DEFAULT 1,
  `data_cadastro` DATETIME NOT NULL,
  UNIQUE INDEX `nip_UNIQUE` (`nip` ASC),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  CONSTRAINT `id_oficial-oc`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial_posto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial_posto` (
  `id_oficial` INT NOT NULL,
  `id_posto` MEDIUMINT NOT NULL,
  `cargo` TINYINT(2) NOT NULL DEFAULT 1,
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  INDEX `id_posto_idx` (`id_posto` ASC),
  CONSTRAINT `id_oficial-op`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_posto-op`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`permissao_edicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`permissao_edicao` (
  `id_permissao` INT(10) NOT NULL,
  `id_oficial` INT NOT NULL,
  `campo_editado` VARCHAR(60) NOT NULL,
  `novo_valor` VARCHAR(200) NOT NULL,
  `estado` TINYINT(2) NULL DEFAULT 1,
  PRIMARY KEY (`id_permissao`),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  CONSTRAINT `id_oficial-pe`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`propietario_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`propietario_documento` (
  `id_propietario` MEDIUMINT(8) NOT NULL,
  `nome_completo` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id_propietario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`propietario_telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`propietario_telefone` (
  `id_propietario` MEDIUMINT NOT NULL,
  `telefone` MEDIUMINT(20) NOT NULL,
  INDEX `id_propietario_idx` (`id_propietario` ASC),
  CONSTRAINT `id_propietario-pt`
    FOREIGN KEY (`id_propietario`)
    REFERENCES `sird-db`.`propietario_documento` (`id_propietario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`documentos` (
  `id_documento` INT(10) NOT NULL,
  `id_posto` MEDIUMINT NOT NULL,
  `tipo` VARCHAR(60) NOT NULL,
  `data_emissao` DATE NULL,
  `identifacador` VARCHAR(20) NULL,
  `id_propietario` MEDIUMINT NOT NULL,
  `estado` TINYINT(2) NOT NULL,
  PRIMARY KEY (`id_documento`),
  INDEX `id_posto_idx` (`id_posto` ASC),
  INDEX `id_propietario_idx` (`id_propietario` ASC),
  CONSTRAINT `id_posto-d`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_propietario-d`
    FOREIGN KEY (`id_propietario`)
    REFERENCES `sird-db`.`propietario_documento` (`id_propietario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`foto_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`foto_documento` (
  `id_foto` MEDIUMINT(8) NOT NULL,
  `id_documento` INT NOT NULL,
  `arquivo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_foto`),
  INDEX `id_documento_idx` (`id_documento` ASC),
  CONSTRAINT `id_documento-fd`
    FOREIGN KEY (`id_documento`)
    REFERENCES `sird-db`.`documentos` (`id_documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`operacao_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`operacao_documento` (
  `id_operacao` INT(10) NOT NULL,
  `id_documento` INT NOT NULL,
  `id_oficial` INT NOT NULL,
  `tipo` TINYINT(2) NOT NULL DEFAULT 1,
  `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_operacao`),
  INDEX `id_documento_idx` (`id_documento` ASC),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  CONSTRAINT `id_documento-od`
    FOREIGN KEY (`id_documento`)
    REFERENCES `sird-db`.`documentos` (`id_documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_oficial-od`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`posto_localizacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`posto_localizacao` (
  `id_posto` MEDIUMINT NOT NULL,
  `distrito` VARCHAR(45) NOT NULL,
  `bairro` VARCHAR(50) NOT NULL,
  `rua` VARCHAR(40) NULL,
  INDEX `id_posto_idx` (`id_posto` ASC),
  CONSTRAINT `id_posto-pl`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`operacao_posto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`operacao_posto` (
  `id_operacao` MEDIUMINT(8) NOT NULL,
  `id_oficial` INT NOT NULL,
  `id_posto` MEDIUMINT NOT NULL,
  `tipo` TINYINT(2) NOT NULL,
  `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_operacao`),
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  INDEX `id_posto_idx` (`id_posto` ASC),
  CONSTRAINT `id_oficial-opt`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_posto-opt`
    FOREIGN KEY (`id_posto`)
    REFERENCES `sird-db`.`posto` (`id_posto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`comando_municipal_localizacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`comando_municipal_localizacao` (
  `id_cm` TINYINT NOT NULL,
  `provincia` VARCHAR(65) NOT NULL,
  `municipio` VARCHAR(100) NOT NULL,
  `distrito` VARCHAR(100) NOT NULL,
  `bairro` VARCHAR(100) NOT NULL,
  `rua` VARCHAR(40) NULL,
  INDEX `id_cm_idx` (`id_cm` ASC),
  CONSTRAINT `id_cm-cml`
    FOREIGN KEY (`id_cm`)
    REFERENCES `sird-db`.`comando_municipal` (`id_comando_municipal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sird-db`.`oficial_comando_municipal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sird-db`.`oficial_comando_municipal` (
  `id_oficial` INT NOT NULL,
  `id_cm` TINYINT NOT NULL,
  `cargo` TINYINT(2) NOT NULL,
  INDEX `id_oficial_idx` (`id_oficial` ASC),
  INDEX `id_cm_idx` (`id_cm` ASC),
  CONSTRAINT `id_oficial-ocm`
    FOREIGN KEY (`id_oficial`)
    REFERENCES `sird-db`.`oficial` (`id_oficial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_cm-ocm`
    FOREIGN KEY (`id_cm`)
    REFERENCES `sird-db`.`comando_municipal` (`id_comando_municipal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
