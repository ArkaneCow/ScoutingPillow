CREATE TABLE users (id int(11) NOT NULL AUTO_INCREMENT, email varchar(100) NOT NULL, rank int(11) NOT NULL, password varchar(100), openid varchar(100), PRIMARY KEY(id), UNIQUE KEY email (email));
CREATE TABLE registers(id int(11) NOT NULL AUTO_INCREMENT, email varchar(100) NOT NULL, rank int(11) NOT NULL, password varchar(100), openid varchar(100), PRIMARY KEY(id));
CREATE TABLE events(id int(11) NOT NULL AUTO_INCREMENT, name varchar(100) NOT NULL, form varchar(100) NOT NULL, process varchar(100) NOT NULL, sql varchar(100) NOT NULL, PRIMARY KEY(id));
CREATE TABLE [event name]_permissions
CREATE TABLE [event name]_matches
CREATE TABLE [event name]_data
CREATE TABLE [event name]_teams(id int(11) NOT NULL AUTO_INCREMENT, team int(11) NOT NULL, name varchar(100) NOT NULL, PRIMARY KEY(id));
CREATE TABLE [event name]_prescout