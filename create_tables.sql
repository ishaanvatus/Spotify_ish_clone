CREATE TABLE users (
    user_id int primary key auto_increment,
    user_name varchar(32),
    email varchar(32),
    password varchar(255),
    gender varchar(2)
);
create table artists(
  artist_id int primary key, 
  artist_name varchar(32), 
  artist_alias varchar(32), 
  country varchar(16), 
  continent varchar(16), 
  genre varchar(16), 
  birth_date date
);
create table tracks (
  track_id int primary key auto_increment, 
  track_name varchar(32), 
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
  label_name varchar(32), 
  country varchar(16), 
  continent varchar(16)
);
create table events (
  event_id int primary key, 
  event_name varchar(32), 
  location varchar(64), 
  event_date date, 
  description varchar (64)
);
create table playlists(
  playlist_id int primary key AUTO_INCREMENT, 
  playlist_name varchar(16)
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
