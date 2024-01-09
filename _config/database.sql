-- ************************************** `users`

CREATE TABLE `users`
(
    `id`         int NOT NULL auto_increment unique,
    `first_name` varchar(45) NULL ,
    `last_name`  varchar(45) NULL ,
    `email`      varchar(255) NOT NULL ,
    `password`   text NOT NULL ,
    `role`       enum('author', 'admin') NOT NULL ,

    PRIMARY KEY (`id`)
);

-- ************************************** `categories`

CREATE TABLE `categories`
(
    `id`   int NOT NULL auto_increment unique,
    `name` varchar(255) NOT NULL ,
    `create_at`   timestamp(0) NOT NULL DEFAULT NOW(),
    `edit_at`     timestamp(0) NULL ,

    PRIMARY KEY (`id`)
);

-- ************************************** `tags`

CREATE TABLE `tags`
(
    `id`   int NOT NULL auto_increment unique,
    `name` varchar(255) NOT NULL ,

    PRIMARY KEY (`id`)
);

-- ************************************** `articles`

CREATE TABLE `articles`
(
    `id`          int NOT NULL auto_increment unique,
    `title`       varchar(255) NOT NULL ,
    `content`     text NOT NULL ,
    `create_at`   timestamp(0) NOT NULL DEFAULT NOW(),
    `edit_at`     timestamp(0) NULL ,
    `status`      enum('published', 'archived') NOT NULL ,
    `id_user`     int NOT NULL ,
    `id_category` int NOT NULL ,

    PRIMARY KEY (`id`),
    KEY `FK_1` (`id_user`),
    CONSTRAINT `FK_1` FOREIGN KEY `FK_1` (`id_user`) REFERENCES `users` (`id`),
    KEY `FK_2` (`id_category`),
    CONSTRAINT `FK_2` FOREIGN KEY `FK_2` (`id_category`) REFERENCES `categories` (`id`)
);

-- ************************************** `articles_tags`

CREATE TABLE `articles_tags`
(
    `id_article` int NOT NULL ,
    `id_tag`     int NOT NULL ,

    KEY `FK_1` (`id_article`),
    CONSTRAINT `FK_3` FOREIGN KEY `FK_1` (`id_article`) REFERENCES `articles` (`id`),
    KEY `FK_2` (`id_tag`),
    CONSTRAINT `FK_4` FOREIGN KEY `FK_2` (`id_tag`) REFERENCES `tags` (`id`)
);