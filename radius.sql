-- Table structure for table `hotspots`

CREATE TABLE `hotspots` (
  `id` bigint NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mac` varchar(200) DEFAULT NULL,
  `geocode` varchar(200) DEFAULT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `email_owner` varchar(200) DEFAULT NULL,
  `manager` varchar(200) DEFAULT NULL,
  `email_manager` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `phone1` varchar(200) DEFAULT NULL,
  `phone2` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `companywebsite` varchar(200) DEFAULT NULL,
  `companyemail` varchar(200) DEFAULT NULL,
  `companycontact` varchar(200) DEFAULT NULL,
  `companyphone` varchar(200) DEFAULT NULL,
  `creationdate` datetime DEFAULT '0000-00-00 00:00:00',
  `creationby` varchar(128) DEFAULT NULL,
  `updatedate` datetime DEFAULT '0000-00-00 00:00:00',
  `updateby` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotspots`
--

INSERT INTO `hotspots` (`id`, `name`, `mac`, `geocode`, `owner`, `email_owner`, `manager`, `email_manager`, `address`, `company`, `phone1`, `phone2`, `type`, `companywebsite`, `companyemail`, `companycontact`, `companyphone`, `creationdate`, `creationby`, `updatedate`, `updateby`) VALUES
(1, 'hotel', 'b4:b6:76:92:b0:c6', '0.5197942479661117,35.27273297309876', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(2, 'cystarap2', 'gf:hj:yu:hj:h', '0.5200718451690693,35.27292206883431', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL);
(3, 'kfcl', 'ba:dc:45:89:hi', '-0.2864781755118488, 36.06318395568022', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL);

SELECT name, mac, geocode FROM hotspots;
-- --------------------------------------------------------