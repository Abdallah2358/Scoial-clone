-- 1. mysql 

-- 2. gender , users , chats , posts , comments ,likes 
-- 2. following the rule of creating the table with the one to many realations frist 
-- since it is the only way to do it, if i want to eliminate the need to alter my tables later

-- 3. one to many , because one users can make many posts , buy a post can onlly have one user

-- 4. one to many  , because one users can have one gender but many people can have same gender

-- 5. one to many , a comment can have one post but a post can have many comments

-- 6. there is no many to many relations .
CREATE schema `social`;

CREATE TABLE `genders` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(10) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(60) NOT NULL,
    `last_name` VARCHAR(60) NOT NULL,
    `username` VARCHAR(75) NULL,
    `email` VARCHAR(100) NULL,
    `password` VARCHAR(125) NULL,
    `birth_date` DATE NULL,
    `gender_id` INT(10) UNSIGNED NOT NULL,
    `adress` TEXT NULL,
    `bio` TEXT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `id_idx` (`gender_id` ASC) VISIBLE,
    CONSTRAINT `id` FOREIGN KEY (`gender_id`) REFERENCES `social`.`genders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE `chats` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `message` text,
    `from_user_id` int unsigned NOT NULL,
    `to_user_id` int unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `id_idx` (`from_user_id`, `to_user_id`) USING BTREE,
    KEY `to_idx` (`to_user_id`),
    CONSTRAINT `from` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`),
    CONSTRAINT `to` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `posts` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `comment` text,
    `user_id` int unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_posts_1_idx` (`user_id`),
    CONSTRAINT `fk_posts_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `comments` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `content` text,
    `user_id` int unsigned NOT NULL,
    `post_id` int unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_comments_1_idx` (`post_id`),
    KEY `fk_comments_2_idx` (`user_id`),
    CONSTRAINT `fk_comments_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
    CONSTRAINT `fk_comments_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `likes` (
    `id` int NOT NULL AUTO_INCREMENT,
    `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user_id` int unsigned NOT NULL,
    `post_id` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_new_1_idx` (`post_id`),
    KEY `fk_new_2_idx` (`user_id`),
    CONSTRAINT `fk_new_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
    CONSTRAINT `fk_new_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
)