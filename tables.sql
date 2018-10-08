CREATE TABLE user (
id INT NOT NULL auto_increment PRIMARY KEY,
first_name VARCHAR(64) NOT NULL,
last_name VARCHAR(64) NOT NULL,
email VARCHAR(256) NOT NULL,
password VARCHAR(64) NOT NULL
);

CREATE TABLE groups (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64) NOT NULL
);

CREATE TABLE user_group (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
group_id INT NOT NULL
);

CREATE TABLE permission (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64) NOT NULL
);

CREATE TABLE group_permission (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
group_id INT NOT NULL,
permission_id INT NOT NULL
);
