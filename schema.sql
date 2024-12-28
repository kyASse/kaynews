-- Active: 1735301674851@@127.0.0.1@3306@portal_berita
-- Buat database
CREATE DATABASE IF NOT EXISTS `PORTAL_BERITA`;
USE `PORTAL_BERITA`;

-- Buat tabel users
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('admin', 'user') NOT NULL DEFAULT 'user',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Buat tabel categories
CREATE TABLE IF NOT EXISTS `categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Buat tabel articles
CREATE TABLE IF NOT EXISTS `articles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `body` text NOT NULL,
    `author_id` int(11) NOT NULL,
    `category_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `image_url` varchar(255),
    `published_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `category_id` (`category_id`),
    KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

ALTER TABLE articles
ADD CONSTRAINT fk_category_id FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE;

ALTER TABLE articles
ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE;

INSERT INTO `users` (`name`, `password`, `email`, `role`) VALUES
('admin', 'admin', 'admin@example.com', 'admin'),
('author1', 'author1', 'author1@example.com', 'author'), 
('reader1', 'reader1', 'reader1@example.com', 'reader');

INSERT INTO `categories` (`name`, `slug`) VALUES
('Nasional', 'nasional'),
('Internasional', 'internasional'),
('Ekonomi', 'ekonomi'),
('Teknologi', 'teknologi'),
('Olahraga', 'olahraga'),
('Hiburan', 'hiburan');

INSERT INTO `articles` (`title`, `body`, `author_id`, `category_id`, `image_url`, `published_at`) VALUES
('Indonesia Raih Medali Emas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 2, 1, 'img/article1.jpg', '2024-03-08 10:00:00'),
('Krisis Ekonomi Global', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 2, 3, 'img/article2.jpeg', '2024-03-07 14:30:00'),
('Terobosan Baru di Bidang AI', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 2, 4, 'img/article3.jpg', '2024-03-06 09:15:00'),
('Pertandingan Sepak Bola Sengit', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2, 5, 'img/article4.jpg', '2024-03-05 16:45:00');

SELECT * FROM users;
SELECT * FROM categories;
SELECT * FROM articles;

SET @id = 1;
UPDATE users SET id = (@id := @id + 1) - 1 WHERE id > 0;

SET @id = 0;
UPDATE articles SET id = (@id := @id + 1) WHERE id > 0;

UPDATE articles SET author_id = 1 WHERE author_id = 0;

UPDATE users SET role = 'user' WHERE id = 2;

UPDATE users SET password = '21232f297a57a5a743894a0e4a801fc3' WHERE name = 'admin';
UPDATE users SET password = 'b312ba4ffd5245fa2a1ab819ec0d0347' WHERE name = 'author1';
UPDATE users SET password = '6e6fba5122623ea1ec36af3336cdb70c' WHERE name = 'reader1';

DELETE FROM users WHERE id = 8;