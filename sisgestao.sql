/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : protocolo

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-01 16:05:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cad_documento`
-- ----------------------------
DROP TABLE IF EXISTS `cad_documento`;
CREATE TABLE `cad_documento` (
  `id_documento` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `status` char(1) NOT NULL COMMENT '1 - Ativo; 0 - Inativo',
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cad_documento
-- ----------------------------
INSERT INTO `cad_documento` VALUES ('1', 'Imposto de Renda', '1');
INSERT INTO `cad_documento` VALUES ('2', 'Carta Registrada', '1');

-- ----------------------------
-- Table structure for `cad_orgao`
-- ----------------------------
DROP TABLE IF EXISTS `cad_orgao`;
CREATE TABLE `cad_orgao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `cidade` varchar(120) NOT NULL,
  `uf` char(2) NOT NULL,
  `cep` char(9) NOT NULL,
  `contato1` varchar(15) NOT NULL,
  `contato2` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `brasao` varchar(200) NOT NULL DEFAULT 'noimage.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cad_orgao
-- ----------------------------
INSERT INTO `cad_orgao` VALUES ('1', 'Prefeitura Municipal de Pau dos Ferros', 'Av. Getúlio Vargas, 1323, Centro', 'Pau dos Ferros', 'RN', '59900-000', '(84) 3351-2316', '(84) 9999509216', 'contato@paudosferros.rn.gov.br', 'www.paudosferros.rn.gov.br', 'noimage.jpg');

-- ----------------------------
-- Table structure for `cad_processo`
-- ----------------------------
DROP TABLE IF EXISTS `cad_processo`;
CREATE TABLE `cad_processo` (
  `id_processo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `status` char(1) NOT NULL COMMENT '1 - Ativo; 0 - Inativo',
  PRIMARY KEY (`id_processo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cad_processo
-- ----------------------------
INSERT INTO `cad_processo` VALUES ('1', 'Processo Licitatório', '1');
INSERT INTO `cad_processo` VALUES ('2', 'Imposto de Renda', '1');

-- ----------------------------
-- Table structure for `cad_setores`
-- ----------------------------
DROP TABLE IF EXISTS `cad_setores`;
CREATE TABLE `cad_setores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(15) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `cpfcnpj` varchar(30) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `contato` varchar(20) DEFAULT NULL,
  `email` varchar(180) DEFAULT NULL,
  `tipo` char(1) NOT NULL COMMENT '1 para setor interno e 2 para setor externo',
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `cad_usuario`
-- ----------------------------
DROP TABLE IF EXISTS `cad_usuario`;
CREATE TABLE `cad_usuario` (
  `id_cad_usuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `documento` varchar(30) DEFAULT NULL,
  `senha` varchar(50) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `apelido` varchar(80) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cep` int(8) DEFAULT NULL,
  `contato` varchar(45) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tipo_usuario` char(1) DEFAULT NULL COMMENT '1 = Admin Geral - 2 Gerente',
  `setor_lotacao` bigint(20) DEFAULT NULL,
  `id_instituicao` bigint(20) DEFAULT NULL,
  `app_access` varchar(10) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  `logoff` date DEFAULT NULL,
  PRIMARY KEY (`id_cad_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `protocolo_processo`
-- ----------------------------
DROP TABLE IF EXISTS `protocolo_processo`;
CREATE TABLE `protocolo_processo` (
  `id_protocolo` bigint(20) NOT NULL AUTO_INCREMENT,
  `origem_processo` char(1) NOT NULL COMMENT 'Verificar se o processo é Recebido ou Expedido',
  `numero_processo` varchar(50) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `assunto_processo` varchar(200) NOT NULL,
  `situacao_processo` char(1) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `unidade_origem` int(11) NOT NULL,
  `unidade_destino` int(11) NOT NULL,
  `codigo_rastreamento` varchar(50) DEFAULT NULL,
  `numero_documento` varchar(50) DEFAULT NULL,
  `data_documento_emissao` date DEFAULT NULL,
  `volumes` varchar(50) DEFAULT NULL,
  `paginas` varchar(50) DEFAULT NULL,
  `observacoes` text,
  `criadopor` varchar(30) NOT NULL COMMENT 'Pega o ID do usuário logado no sistema que está criando o protocolo',
  `visible` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_protocolo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of protocolo_processo
-- ----------------------------
INSERT INTO `protocolo_processo` VALUES ('1', '1', '0000001926012000', '2', 'Descrição do Processo', '4', '2017-01-26 16:06:46', '9', '8', '', '45678', '2017-01-26', '2', '100', '100', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('2', '1', '0000002930012017', '2', 'Descrição do Processo', '2', '2017-01-26 14:01:56', '9', '4', '', '45678', '2017-01-30', '2', '100', 'codeblock ', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('3', '1', '0000002930012016', '2', 'Descrição do Processo', '2', '2017-01-30 14:01:56', '9', '4', '', '45678', '2017-01-30', '2', '100', 'codeblock ', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('4', '1', '0000002930012015', '2', 'Descrição do Processo', '1', '2017-01-30 14:01:56', '2', '4', '', '45678', '2017-01-30', '2', '100', 'codeblock ', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('5', '1', '0000002930012014', '2', 'Descrição do Processo', '4', '2017-01-30 14:01:56', '6', '4', '', '45678', '2017-01-30', '2', '100', 'codeblock ', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('6', '1', '0000002930012013', '2', 'Descrição do Processo', '3', '2017-01-30 14:01:56', '5', '5', '', '45678', '2017-01-30', '2', '100', 'codeblock ', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('7', '1', '0000002930012012', '2', 'Descrição do Processo', '2', '2017-01-30 14:01:56', '4', '6', '', '45678', '2017-01-30', '2', '100', 'codeblock ', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('8', '1', '0000002930012011', '2', 'Descrição do Processo', '1', '2017-02-01 14:01:56', '3', '7', '', '45678', '2017-01-30', '2', '100', 'codeblock ', '01024890414', 'S');
INSERT INTO `protocolo_processo` VALUES ('9', '1', '0000009907022017', '2', 'Descrição do Processo', '2', '2017-02-07 20:17:37', '9', '8', '', '45678', '2017-02-07', '1', '1', '1', '01024890414', 'S');

-- ----------------------------
-- Table structure for `protocolo_tramite`
-- ----------------------------
DROP TABLE IF EXISTS `protocolo_tramite`;
CREATE TABLE `protocolo_tramite` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_protocolo` bigint(20) NOT NULL,
  `origem` int(11) NOT NULL,
  `origem_enviado` varchar(20) NOT NULL,
  `origem_data` datetime NOT NULL,
  `origem_despacho` text,
  `destino` bigint(20) NOT NULL,
  `destino_recebido` varchar(20) NOT NULL,
  `destino_data` datetime NOT NULL,
  `destino_despacho` text,
  `situacao` char(1) NOT NULL DEFAULT '1' COMMENT 'Recebe 1 para PENDENTE, recebe 2 para EM EXECUÇÃO, recebe 3 para AGUARDANDO RECEBIMENTO, recebe 4 para RECEBIDO, recebe 5 para CANCELADO, recebe 6 para CONCLUÍDO',
  `recebido` char(1) NOT NULL DEFAULT 'N' COMMENT 'S para RECEBIDO e N para NÃO RECEBIDO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of protocolo_tramite
-- ----------------------------
INSERT INTO `protocolo_tramite` VALUES ('1', '1', '9', '01024890414', '2017-01-26 16:06:46', '***', '8', '12345', '2017-01-26 17:52:43', 'recebido', '2', 'S');
INSERT INTO `protocolo_tramite` VALUES ('2', '1', '8', '12345', '2017-01-26 17:53:06', 'concluído pra testes', '0', '', '0000-00-00 00:00:00', null, '6', 'S');
INSERT INTO `protocolo_tramite` VALUES ('3', '2', '9', '01024890414', '2017-01-30 14:01:56', '***', '4', '12345', '2017-03-09 00:16:10', 'acabei recebendo', '2', 'S');
INSERT INTO `protocolo_tramite` VALUES ('4', '9', '9', '01024890414', '2017-02-07 20:17:37', '***', '8', '12345', '2017-02-07 21:38:59', 'teste', '2', 'S');
