LOAD DATA LOCAL INFILE '~/data/actor1.del' into table Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'; 
LOAD DATA LOCAL INFILE '~/data/actor2.del' into table Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE '~/data/actor3.del' into table Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'; 
LOAD DATA LOCAL INFILE '~/data/director.del' into table Director
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'; 
LOAD DATA LOCAL INFILE '~/data/movie.del' into table Movie
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'; 
LOAD DATA LOCAL INFILE '~/data/movieactor1.del' into table MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'; 
LOAD DATA LOCAL INFILE '~/data/movieactor2.del' into table MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'; 
LOAD DATA LOCAL INFILE '~/data/moviedirector.del' into table MovieDirector
FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/moviegenre.del' into table MovieGenre
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
INSERT INTO MaxPersonID VALUES(69000);
INSERT INTO MaxMovieID VALUES(4750);













 
