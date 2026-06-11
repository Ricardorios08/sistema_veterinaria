
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `fecha` datetime NOT NULL default '0000-00-00 00:00:00',
  `usuario` varchar(15) NOT NULL default '',
  `mensaje` text NOT NULL
) ;
