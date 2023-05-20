-- phpMyAdmin SQL Dump
-- version 2.11.5.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 11-11-22 11:39 
-- 서버 버전: 5.1.45
-- PHP 버전: 5.2.9p2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 데이터베이스: `webs_sandt`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `mw_popup`
--

CREATE TABLE IF NOT EXISTS `g4_popup` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `gr_id` varchar(20) NOT NULL,
  `mb_id` varchar(20) NOT NULL,
  `pp_start` date NOT NULL,
  `pp_end` date NOT NULL,
  `pp_use` char(1) NOT NULL,
  `pp_left` int(11) NOT NULL,
  `pp_top` int(11) NOT NULL,
  `pp_width` int(11) NOT NULL,
  `pp_height` int(11) NOT NULL,
  `pp_type` char(1) NOT NULL,
  `pp_time` tinyint(4) NOT NULL,
  `mb_level` tinyint(4) NOT NULL,
  `pp_subject` varchar(255) NOT NULL,
  `pp_content` text NOT NULL,
  `pp_datetime` datetime NOT NULL,
  PRIMARY KEY (`pp_id`),
  KEY `mb_id` (`mb_id`),
  KEY `pp_use` (`pp_use`,`pp_start`,`pp_end`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 테이블의 덤프 데이터 `mw_popup`
--

INSERT INTO `g4_popup` (`pp_id`, `gr_id`, `mb_id`, `pp_start`, `pp_end`, `pp_use`, `pp_left`, `pp_top`, `pp_width`, `pp_height`, `pp_type`, `pp_time`, `mb_level`, `pp_subject`, `pp_content`, `pp_datetime`) VALUES
(1, '', 'admin', '2011-10-19', '2011-11-30', '1', 10, 10, 640, 430, '1', 1, 1, '테스트', '<IMG src="http://sandt.subnara.info/data/geditor/1110/1935510532_d546892c_ticket1.jpg"><BR>', '2011-10-19 15:51:07');
