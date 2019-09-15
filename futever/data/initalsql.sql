GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'futever'@'localhost' IDENTIFIED BY PASSWORD '*D20690E9102A48ABF56DEB171DD6C1CE76626281';

drop database if exists futever;

create database futever CHARACTER SET utf8mb4 collate utf8mb4_unicode_ci;

create table teams (
  id int auto_increment not null,
  Name varchar(100),
  Liga varchar(100),
  Land varchar(100),
  Primary Key (id)
);

CREATE TABLE users (
  id int auto_increment NOT NULL,
  Benutzername varchar(50),
  Mail varchar(100),
  Passwort varchar(255),
  futever_score int,
  favteam_id int,
  Primary Key (id),
  Foreign Key (favteam_id) references teams (id)
);

create table matches (
  id int auto_increment not null,
  datum date,
  gespielt bit,
  team1_id int,
  team1_tore int,
  team2_id int,
  team2_tore int,
  Primary Key (id),
  Foreign Key (team1_id) references teams (id),
  Foreign Key (team2_id) references teams (id)
);

create table userprognose (
  id int auto_increment not null,
  user_id int,
  match_id int,
  team1_tore int,
  team2_tore int,
  Primary Key (id),
  Foreign Key (user_id) references users (id),
  Foreign Key (match_id) references matches (id)
);


insert into teams (Name, Liga, Land)
  values ('Athletic Bilbao', 'La Liga', 'Spanien'),
  ('Atlético Madrid', 'La Liga', 'Spanien'),
  ('Betis Sevilla', 'La Liga', 'Spanien'),
  ('CD Leganés', 'La Liga', 'Spanien'),
  ('Celta Vigo', 'La Liga', 'Spanien'),
  ('Deportivo Alavés', 'La Liga', 'Spanien'),
  ('Espanyol Barcelona', 'La Liga', 'Spanien'),
  ('FC Barcelona', 'La Liga', 'Spanien'),
  ('FC Getafe', 'La Liga', 'Spanien'),
  ('FC Girona', 'La Liga', 'Spanien'),
  ('FC Sevilla', 'La Liga', 'Spanien'),
  ('FC Valencia', 'La Liga', 'Spanien'),
  ('FC Villareal', 'La Liga', 'Spanien'),
  ('Rayo Vallecano', 'La Liga', 'Spanien'),
  ('Real Madrid', 'La Liga', 'Spanien'),
  ('Real Sociedad', 'La Liga', 'Spanien'),
  ('Real Valladolid', 'La Liga', 'Spanien'),
  ('SD Eibar', 'La Liga', 'Spanien'),
  ('SD Huesca', 'La Liga', 'Spanien'),
  ('UD Levante', 'La Liga', 'Spanien');
