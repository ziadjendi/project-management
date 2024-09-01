DROP USER IF EXISTS 'my_user'@'%';
CREATE USER 'my_user'@'%' IDENTIFIED WITH mysql_native_password BY 'my_password';
GRANT ALL PRIVILEGES ON my_database.* TO 'my_user'@'%';
FLUSH PRIVILEGES;
