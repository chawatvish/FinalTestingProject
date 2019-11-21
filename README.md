# deposit-integration-test
 
1) create database name = "integration"

2) insert default account 

-- --------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `integration`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `no` char(10) NOT NULL,
  `pin` char(4) NOT NULL,
  `name` char(50) NOT NULL,
  `balance` int(11) NOT NULL,
  `waterCharge` int(11) NOT NULL,
  `electricCharge` int(11) NOT NULL,
  `phoneCharge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1212312121', '9999', 'Mary Happy', 1006596, 500, 1290, 560),
('9999999999', '1111', 'Test Real', 900000, 500, 199, 222)
('9999900001', '3346', 'Elenore Hasson', 239845, 200, 300, 500),
('9999900002', '9716', 'Mona Willgoose', 326716, 0, 0, 0),
('9999900003', '4730', 'Eadmund Toplis', 82014, 0, 0, 0),
('9999900004', '5747', 'Maura Hastewell', 495642, 0, 0, 0),
('9999900005', '3317', 'Woodrow Swigg', 149440, 0, 0, 0),
('9999900006', '5633', 'Minor Laweles', 391771, 0, 0, 0),
('9999900007', '9353', 'Rudyard Phinnessy', 463172, 0, 0, 0),
('9999900008', '2688', 'Cal Faircliffe', 285416, 0, 0, 0),
('9999900009', '2741', 'Uriel Temporal', 203219, 0, 0, 0),
('9999900010', '9004', 'Trstram Cristea', 311738, 0, 0, 0),
('9999900011', '3662', 'Jenn Petrulis', 114387, 0, 0, 0),
('9999900012', '1863', 'Man Lofthouse', 486418, 0, 0, 0),
('9999900013', '2141', 'Fairlie Poulsen', 320381, 0, 0, 0),
('9999900014', '4824', 'Dianemarie Hacker', 336190, 0, 0, 0),
('9999900015', '2966', 'Ulrick Pavlitschek', 280843, 0, 0, 0),
('9999900016', '9796', 'Umeko Spalding', 334400, 0, 0, 0),
('9999900017', '6263', 'Lucretia Puller', 42623, 0, 0, 0),
('9999900018', '9046', 'Batholomew Colvie', 134014, 0, 0, 0),
('9999900019', '8867', 'Minni Lincke', 384051, 0, 0, 0);
COMMIT;
