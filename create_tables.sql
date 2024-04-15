CREATE TABLE users (
    user_id int primary key auto_increment,
    user_name varchar(32),
    email varchar(32),
    password varchar(255),
    gender varchar(2)
);
create table artists(
  artist_id int primary key, 
  artist_name varchar(30), 
  artist_alias varchar(20), 
  country varchar(20), 
  continent varchar(15), 
  genre varchar(15), 
  birth_date date
);
create table tracks (
  track_id int primary key, 
  track_name varchar(20), 
  `duration(mins)` int, 
  release_date date
);
create table subscription (
  user_id int, 
  type varchar(20), 
  start_date date, 
  end_date date, 
  foreign key(user_id) references users(user_id)
);
create table albums (
  album_id int primary key, 
  album_name varchar(20), 
  release_date date
);
create table labels(
  label_id int primary key, 
  label_name varchar(20), 
  country varchar(15), 
  continent varchar(15)
);
create table events (
  event_id int primary key, 
  event_name varchar(20), 
  location varchar(50), 
  event_date date, 
  description varchar (50)
);
create table playlists(
  playlist_id int primary key, 
  playlist_name varchar(15)
);
create table user_playlists(
  playlist_id int, 
  user_id int, 
  foreign key (playlist_id) references playlists(playlist_id), 
  foreign key (user_id) references users(user_id)
);
create table track_playlists(
  playlist_id int, 
  track_id int, 
  foreign key (playlist_id) references playlists(playlist_id), 
  foreign key (track_id) references tracks(track_id)
);
create table ratings(
  user_id int, 
  track_id int, 
  `ratings(out of 10)` int, 
  foreign key (user_id) references users(user_id), 
  foreign key (track_id) references tracks(track_id)
);
create table listens(
  user_id int, 
  track_id int, 
  foreign key (user_id) references users (user_id), 
  foreign key (track_id) references tracks(track_id)
);
create table artist_tracks(
  artist_id int, 
  track_id int, 
  foreign key (artist_id) references artists(artist_id), 
  foreign key (track_id) references tracks(track_id)
);
create table album_tracks(
  album_id int, 
  track_id int, 
  foreign key (album_id) references albums(album_id), 
  foreign key (track_id) references tracks(track_id)
);
create table labels_artists(
  label_id int, 
  artist_id int, 
  foreign key(label_id) references labels(label_id), 
  foreign key(artist_id) references artists(artist_id)
);
create table artist_albums (
  artist_id int, 
  album_id int, 
  foreign key(artist_id) references artists(artist_id), 
  foreign key (album_id) references albums(album_id)
);
create table attending (
  user_id int, 
  event_id int, 
  foreign key (user_id) references users(user_id), 
  foreign key(event_id) references events(event_id)
);
create table performing (
  artist_id int, 
  event_id int, 
  foreign key (artist_id) references artists(artist_id), 
  foreign key (event_id) references events(event_id)
);
insert into artists values (101, "Linkin Park", "LP", "USA", "North America", "Rock", "1976-03-20");
insert into artists values (102, "System Of A Down", "soad", "USA", "North America", "Metal", "1967-08-09");
insert into artists values (103, "Eminem", "Em", "USA", "North America", "Rap", "1972-10-17");

insert into albums values (201, "Meteora", "2003-03-25");
insert into albums values (202, "Hybrid Theory", "2000-10-24");
insert into albums values (203, "Minutes to Midnight", "2007-05-14");
insert into albums values (204, "Toxicity", "2001-09-04");
insert into albums values (205, "The Eminem Show", "2002-12-09");
insert into albums values (206, "Encore", "2004-11-12");

insert into tracks values (301, "Numb", 188,  "2003-03-25");
insert into tracks values (302, "Faint", 162,  "2003-03-25");
insert into tracks values (303, "Somewhere I belong", 214,  "2003-03-25");
insert into tracks values (304, "In the End", 217, "2000-10-24");
insert into tracks values (305, "Crawling", 209,  "2000-10-24");
insert into tracks values (306, "One Step Closer", 158,  "2000-10-24");
insert into tracks values (307, "Given Up", 189, "2007-05-14");
insert into tracks values (308, "Somehwere I belong", 206,"2007-05-14");
