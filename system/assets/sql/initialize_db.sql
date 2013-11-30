CREATE TABLE `posts` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
    `post_author` varchar(16) NOT NULL,
    `post_title` varchar(100) NOT NULL,
    `post_content` varchar(10000) NOT NULL,
    `post_date` varchar(10) NOT NULL,
    `post_status` varchar(15) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `users` (
	`id` int(100) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(16) NOT NULL,
	`user_password` varchar(256) NOT NULL,
	`user_email` varchar(30) NOT NULL,
	`user_rank` varchar(30) NOT NULL,
	`user_posts` int(10) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE `comments` (
	`id` int(100) NOT NULL AUTO_INCREMENT,
	`comment_post` int(10) NOT NULL,
	`comment_is_moderated` varchar(10) NOT NULL,
	`comment_poster` varchar(16) NOT NULL,
	`comment_date` varchar(10) NOT NULL,
	`comment_content` varchar(200) NOT NULL,
	PRIMARY KEY (id)
);