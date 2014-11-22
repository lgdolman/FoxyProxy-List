CREATE TABLE IF NOT EXISTS `List` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `Domain` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `Tld` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Enabled` varchar(1) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `Count` int(2) NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=70 ;
