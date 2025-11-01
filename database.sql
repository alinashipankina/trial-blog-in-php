CREATE DATABASE blog;
CREATE USER 'blog'@'localhost' IDENTIFIED BY 'blog';
GRANT ALL PRIVILEGES ON blog.* TO 'blog'@'localhost';

CREATE TABLE `user` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `email` varchar(255) NOT NULL,
                     `password` varchar(255) NOT NULL,
                     `name` varchar(255) DEFAULT NULL,
                     `surname` varchar(255) DEFAULT NULL,
                     `about` TEXT DEFAULT NULL,
                     `phone` varchar(255) DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `article` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `userId` int(20) unsigned NOT NULL,
                     `title` varchar(255) NOT NULL,
                     `content` TEXT NOT NULL,
                     `img` varchar(255) DEFAULT NULL,
                     `createdAt` DATETIME DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE user ADD isAdmin TINYINT DEFAULT 0;
UPDATE user SET isAdmin = 1 WHERE id = 2;

CREATE TABLE `comment` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `userId` int(20) unsigned DEFAULT NULL,
                     `articleId` int(20) unsigned NOT NULL,
                     `content` TEXT NOT NULL,
                     `isModerated` TINYINT unsigned DEFAULT 0,
                     `createdAt` DATETIME DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `category` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `name` varchar(255) NOT NULL,
                     `createdAt` DATETIME DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE article ADD categoryId INT(11) DEFAULT NULL;

ALTER TABLE article ADD isPublished TINYINT DEFAULT 1;
