[mysql]
db_username = root
db_password = 11111
db_server = localhost
db_name = prepwork

[tables]
user.id = "id int(11) not null auto_increment"
user.email = "email varchar(65) not null"
user.username = "username varchar(30) not null"
user.password = "password varchar(30) not null"
user.usertype = "usertype varchar(30) not null"
user.primary = "primary key(id)"