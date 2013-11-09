CREATE TABLE `posts` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
    `post_author` varchar(16) NOT NULL,
    `post_title` varchar(100) NOT NULL,
    `post_content` varchar(10000) NOT NULL,
    `post_date` varchar(10) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `users` (
	`id` int(100) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(16) NOT NULL,
	`user_password` varchar(256) NOT NULL,
	`user_posts` int(10) NOT NULL,
	PRIMARY KEY (id)
);