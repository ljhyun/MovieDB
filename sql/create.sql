/*
1. All the ID fields should be a primary key (Movie ID, Director ID, Actor ID
2. The reference tables should check if the reference subject exist (ie: MovieActor table should check both Movie and the Actor exist)
3. All fields should not include invalid characters (ie: name="abc@123")
4. DOB should be > current date
5. Sex can only be male or female
6. Genre can only contain selected categories (ie: Comedy)
7. Rating can only be G,PG,PG-13,NC-17,surrendere
*/

-- Movie ID should be primary key AND Movie Rating should be one of the six categories
CREATE TABLE Movie(id int, title varchar(100), year int, rating varchar(10), company varchar(50), PRIMARY KEY(id), CHECK(rating='PG-13' OR 'R' OR 'PG' OR 'NC-17' OR 'surrendere' OR 'G')) ENGINE=InnoDB;
-- Actor should either be male or female and dob should be less then today's date AND Actor ID should be primary key
CREATE TABLE Actor(id int, last varchar(20), first varchar(20),sex varchar(6), dob date, dod date, PRIMARY KEY(id), CHECK(sex in ('Male', 'Female')), CHECK(dob > sysdate)) ENGINE=InnoDB;
-- Director dob should be less then today's date AND Director ID should primary key
CREATE TABLE Director(id int, last varchar(20), first varchar(20), dob date, dod date, PRIMARY KEY(id), CHECK(dob > sysdate)) ENGINE=InnoDB;
-- Movie ID should exist in the movie table
CREATE TABLE MovieGenre(mid int NOT NULL, genre varchar(20), FOREIGN KEY (mid) references Movie(id)) ENGINE=InnoDB;
-- Movie ID and Director ID should exist in both tables
CREATE TABLE MovieDirector(mid int NOT NULL, did int NOT NULL, FOREIGN KEY(mid) references Movie(id), FOREIGN KEY(did) references Director(id), UNIQUE(mid, did)) ENGINE=InnoDB;
-- Movie ID and Actor ID should exist in bot tables
CREATE TABLE MovieActor(mid int NOT NULL, aid int NOT NULL, role varchar(50), FOREIGN KEY(mid) references Movie(id), FOREIGN KEY(aid) references Actor(id), UNIQUE(mid, aid, role)) ENGINE=InnoDB;
CREATE TABLE Review(name varchar(20), time timestamp, mid int NOT NULL, rating int, comment varchar(500)) ENGINE=InnoDB;
CREATE TABLE MaxPersonID(id int) ENGINE=InnoDB;
CREATE TABLE MaxMovieID(id int) ENGINE=InnoDB;
DELIMITER //
CREATE TRIGGER actor_after_insert AFTER INSERT ON Actor
FOR EACH ROW BEGIN
UPDATE MaxPersonID SET id = id+1 WHERE TRUE;
END;
//

CREATE TRIGGER director_after_insert AFTER INSERT ON Director
FOR EACH ROW BEGIN
UPDATE MaxPersonID SET id = id+1 WHERE TRUE;
END;
//

CREATE TRIGGER movie_after_insert AFTER INSERT ON Movie
FOR EACH ROW BEGIN
UPDATE MaxMovieID SET id = id+1 WHERE TRUE;
END;
//
delimiter ;






