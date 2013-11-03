CREATE TABLE `posts` {
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`post_author` varchar(20) NOT NULL,
	`post_title` varchar(100) NOT NULL,
	`post_content` varchar(10000) NOT NULL,
	`post_date` varchar(10) NOT NULL,
	PRIMARY KEY (id)
}

CREATE TABLE `users` {
	`id` int AUTO_INCREMENT NOT NULL,
	`user_name` varchar(16) NOT NULL,
	`user_password` varchar(256) NOT NULL,
	`user_posts` int NOT NULL,
	PRIMARY KEY (id)
}