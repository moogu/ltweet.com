-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tempo de Geração: Fev 12, 2011 as 02:10 PM
-- Versão do Servidor: 5.0.37
-- Versão do PHP: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Banco de Dados: `twittplus`
-- 

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `tb_log`
-- 

CREATE TABLE `tb_log` (
  `ID_LOG` int(11) NOT NULL auto_increment,
  `NM_USER` varchar(255) collate latin1_general_ci NOT NULL,
  `DT_LOG` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ID_LOG`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- 
-- Extraindo dados da tabela `tb_log`
-- 

INSERT INTO `tb_log` VALUES (1, 'teste', '2011-02-12 15:56:21');