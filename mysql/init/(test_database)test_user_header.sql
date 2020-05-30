CREATE USER 'root'@'127.0.0.1' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON *.* to 'root'@'127.0.0.1' IDENTIFIED BY 'root';

CREATE DATABASE test_database;
use test_database;

CREATE TABLE IF NOT EXISTS test_user_header(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_name char(10) NOT NULL
) engine=innodb default charset=utf8;