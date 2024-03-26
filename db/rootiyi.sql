
CREATE TABLE IF NOT EXISTS `challenge` (
  `challengeId` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `categoryId` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL DEFAULT '',
  `urlChallenge` varchar(255) NOT NULL DEFAULT '',
  `flag` varchar(40) NOT NULL DEFAULT '',
  `nbPoints` int NOT NULL DEFAULT '5',
  `difficulty` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`challengeId`)
);

CREATE TABLE IF NOT EXISTS `message` (
  `messageId` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `contenu` varchar(500) NOT NULL DEFAULT '',
  `senderId` smallint(3) unsigned NOT NULL DEFAULT '0',
  `discussionId` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`messageId`)
);

CREATE TABLE IF NOT EXISTS `discussion` (
  `discussionId` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `challengeId` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`discussionId`)
);

CREATE TABLE IF NOT EXISTS `user` (
  `userId` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL DEFAULT '',
  `mail` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `nbPoints` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`)
);

CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`categoryId`)
);

INSERT INTO `category` (`title`) VALUES
('frontend security'),
('backend security');


CREATE TABLE IF NOT EXISTS `resolution` (
  `userId` smallint(5) unsigned NOT NULL DEFAULT '0',
  `challengeId` smallint(5) unsigned NOT NULL DEFAULT '0',
  `resolved` BOOLEAN DEFAULT '0',
  PRIMARY KEY (`userId`,`challengeId`)
);
