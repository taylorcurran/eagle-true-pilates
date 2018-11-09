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

SELECT user.id,
  first_name,
  last_name,
  email,
FROM user
JOIN user_group on user_group.user_id = user.id;


CREATE TABLE permission (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64) NOT NULL
);

CREATE TABLE group_permission (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
group_id INT NOT NULL,
permission_id INT NOT NULL
);

CREATE TABLE class (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
instructor_id INT,
class_name_id INT NOT NULL,
start DATETIME NOT NULL,
end DATETIME NOT NULL,
max_occupancy INT,
occupancy INT
);

INSERT INTO class (instructor_id, class_name_id, start, end, max_occupancy) VALUES (1, 1, '2018-11-07 9:00:00', '2018-11-07 10:00:00', 20);

CREATE TABLE class_user (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
class_id INT NOT NULL,
user_id INT NOT NULL
);

INSERT INTO class_user (class_id, user_id) VALUES (1, 1);

CREATE TABLE message (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(64) NOT NULL,
last_name VARCHAR(64) NOT NULL,
country VARCHAR(64),
message VARCHAR(256)
);

INSERT INTO message (first_name, last_name, country, message) VALUES ('adam', 'curran', 'usa', 'I need to schedule classes');

CREATE TABLE class_name (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64) NOT NULL
);

INSERT INTO class_name (name) VALUES ('PIYO');
INSERT INTO class_name (name) VALUES ('Restorative/Yin Yoga');
INSERT INTO class_name (name) VALUES ('Ariel Yoga');
INSERT INTO class_name (name) VALUES ('Traditional Pilates');
INSERT INTO class_name (name) VALUES ('Mat Class');


SELECT class.id as id,
  user.first_name as instructor,
  class_name.name as class_name,
  start,
  end,
  max_occupancy,
  occupancy
FROM class
JOIN user ON class.instructor_id = user.id
JOIN class_name ON class.class_name_id = class_name.id;