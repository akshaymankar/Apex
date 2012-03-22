SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `userpending`;
CREATE TABLE IF NOT EXISTS `userpending` (
  `requestnumber` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `location` varchar(20) NOT NULL,
  PRIMARY KEY (`requestnumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `userpending` (`requestnumber`, `firstname`, `lastname`, `email`, `phone`, `username`, `password`, `location`) VALUES
(1, 'Nitin', 'Gandhe', 'n@g.com', '1234567890', 'ngandhe', '*D8C92C7F30AAA958A1C323E1FE47C1BA027D1F94', 'TIFR-Mumbai'),
(2, 'Mihir', 'Modak', 'm@m.com', '0987654321', 'mmodak', '*AA470C11C201A5A1845A4122E57528696945E12C', 'TIFR-Mumbai'),
(3, 'Jayesh', 'Hegde', 'j@h.com', '2347862874', 'jhegde', '*EA2920D8C1ED843FC7EE97849996BEB36B120854', ''),
(4, 'Pritish', 'Tardalkar', 'p@t.com', '6794538754', 'ptard', PASSWORD('ptard'), 'TIFR-ooty');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
