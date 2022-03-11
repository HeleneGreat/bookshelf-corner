CREATE TABLE `Admins` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`pseudo` varchar(255) NOT NULL,
	`mail` varchar(255) NOT NULL,
	`mdp` varchar(255) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Comments` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`user_id` varchar(255) NOT NULL,
	`book_id` varchar(255) NOT NULL,
	`created_at` DATETIME(6) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`title` varchar(255) NOT NULL,
	`content` varchar(255) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Users` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`pseudo` varchar(255) NOT NULL,
	`mail` varchar(255) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Books` (
	`ID` INT NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`created_at` DATETIME(6) NOT NULL AUTO_INCREMENT,
	`author` varchar(255) NOT NULL,
	`notation` INT(1) NOT NULL,
	`genre` varchar(255) NOT NULL,
	`catchphrase` varchar(255) NOT NULL,
	`content` varchar NOT NULL,
	`edition` varchar(255) NOT NULL,
	`linkEdition` varchar(500) NOT NULL,
	`picture` varchar(255) NOT NULL,
	`location` varchar(255) NOT NULL,
	`published_at` DATETIME(6) NOT NULL,
	PRIMARY KEY (`ID`)
);

ALTER TABLE `Comments` ADD CONSTRAINT `Comments_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`ID`);

ALTER TABLE `Comments` ADD CONSTRAINT `Comments_fk1` FOREIGN KEY (`book_id`) REFERENCES `Books`(`ID`);





