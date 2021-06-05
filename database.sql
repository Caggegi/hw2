drop database if exists videotube_vt;
create database videotube_vt;
use videotube_vt;
SET sql_mode = '';
-- creazione tabelle
CREATE table spectators(
    id int auto_increment PRIMARY KEY,
    name varchar(32),
    surname varchar(32),
    username varchar(32),
    email varchar(64),
    password varchar(64),
    profile_pic varchar(255),
    created_at timestamp,
    updated_at timestamp,
    INDEX index_hash(id));

insert into spectators(name, surname, username, email, password, profile_pic)
  values ('Mario', 'Rossi', 'mrossi', 'mariorossi@gmail.com', 'd1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04', 'https://bit.ly/3w8Fa4W'),
         ('Giuseppe', 'Verdi', 'greenG', 'ilverdi@gmail.com', 'd1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04', 'https://bit.ly/3opewC8');

CREATE table creators(
    id int auto_increment PRIMARY KEY,
    name varchar(32),
    surname varchar(32),
    username varchar(32),
    email varchar(64),
    password varchar(64),
    profile_pic varchar(255),
    n_followers int,
    created_at timestamp,
    updated_at timestamp,
    INDEX index_hash(id));

insert into creators(name, surname, username, email, password, profile_pic)
  values ('Riot','Games','RiotGames','riot@riot.com','86caecb0afacb8361ac7b2a84b71f30e5757470f4dc77be0880f745521ea9cb1','https://riot.com/3eWZq3P'),
         ('Mihoyo','','Mihoyo','tousu@mihoyo.com','2c168da20b2a8f34944edcce76120f0a150829ca8505af5fe1882dfaa576a3a4','https://bit.ly/3uSaaGd'),
         ('CD-Projekt RED','','CDP','projektred@cd.com','5a25c5b4d069a6c99ba5a1e0db3dba088f6be3e23f84f5e8e36bac74c0d7fdb4','https://bit.ly/2QuGoZe'),
         ('Disney','','Disney','topolino@disney.com','d1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04','https://bit.ly/347zKeN'),
         ('Disney Pixar','','Pixar','pixar@disney.com','d1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04','https://bit.ly/3ftEuAl'),
         ('CGI','','CGI','cgianimated@cgi.com','d1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04','https://bit.ly/3ynefo7'),
         ('Francesca','Calearo','Madame','sonolamadame@gmail.com','d1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04','https://bit.ly/3bzpxMg'),
         ('Andrea','Molteni','Axos','axos.studio@gmail.com','d1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04','https://bit.ly/3v1a0MV'),
         ('Michele','Salvemini','Caparezza','caparezza@gmail.com','d1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04','https://bit.ly/3tYcRVv'),
         ('Universe Science Italy','','UniverseScienceItaly','usitaly@cd.com','d1fdc211f5414e6974317921f57c89e9a7c41def55d3fc7befa436efb8ac7c04','https://bit.ly/3ytVsHR');

CREATE table premiums(
    id int PRIMARY KEY,
    costo decimal,
    mensile decimal,
    tipo varchar(16),
    created_at timestamp,
    updated_at timestamp,
    FOREIGN KEY(id) REFERENCES spectators(id) on delete cascade,
    INDEX index_premiums(id));

CREATE table videos(
    titolo varchar(20),
    immagine varchar(255),
    creator int,
    descrizione varchar(255),
    id int auto_increment PRIMARY KEY,
    tipo varchar(32),
    src varchar(255),
    likes int default 0,
    created_at timestamp,
    updated_at timestamp,
    FOREIGN KEY(creator) REFERENCES creators(id) on delete cascade,
    INDEX index_video(id));

insert into videos(titolo, immagine, creator, descrizione, tipo, src)
  values ('Genshin Impact', 'https://bit.ly/3eYB35Y', 2, 'Prologue:  The Outlander Who Caught the Wind I: Farewell, Archaic Lord II:  Omnipresence Over Mortals', 'gameplay', 'TAlKhARUcoY'),
         ('Warriors - LoL', 'https://bit.ly/2S16YcW', 1, 'Noi siamo guerrieri. La stagione 2020 è iniziata.', 'gameplay', 'aR-KAldshAE'),
         ('Cyberpunk 2077', 'https://bit.ly/3u3769a', 3, 'CD PROJEKT RED ha mostrato oggi un nuovo video di Cyberpunk 2077 dando ai giocatori un nuovo sguardo...', 'gameplay', '2qGCax2Chik'),
         ('Il re leone', 'https://bit.ly/3fpvk89', 4, 'Ivana Spagna is awesome. Circle of Life, in Italian.', 'film', 'rsL15hjSELM'),
         ('Bao', 'https://bit.ly/3eXGWAk', 5, 'Follow US on Social Media!', 'film', '7xTmyUdqDfM'),
         ('Scrambled', 'https://bit.ly/3fnjKdE', 6, 'CGI 3D Animated Short Film: Scrambled Animated Short Film by Polder Animation. Featured on CGMeetup https://www.cgmeetup.com/polderanimation ', 'film', '9JBNmGlEdLY'),
         ('VOCE', 'https://bit.ly/3otsDGL', 7, 'Ascolta “MADAME”, il primo album di Madame: https://SugarMusic.lnk.to/_MADAME', 'musica', 'cFAtUbi7a8w'),
         ('SCICCHERIE', 'https://bit.ly/33VaGY4', 7, 'Ascolta “MADAME”, il primo album di Madame: https://SugarMusic.lnk.to/_MADAME', 'musica', '5zxDFB6CS3g'),
         ('La Scelta', 'https://bit.ly/3fwbuYX', 9, 'Ascolta ora La Scelta http://pld.lnk.to/lascelta Preordina il nuovo album in uscita il 7 Maggio qui https://pld.lnk.to/ExuviaID', 'musica', 'D8ZVhvXqUzI'),
         ('Settimo Cielo', 'https://bit.ly/3weltsp', 8, 'Provided to YouTube by Universal Music Group Settimo Cielo · Axos · Ghemon', 'musica', 'SwL81onti2I'),
         ("L'Era dei Mammiferi", 'https://bit.ly/3v2ownr', 10, "I crediti di qualsiasi artista che abbia realizzato le immagini utilizzate, sono riportate in basso a sinistra nel video. Qualunque altra immagine riportata senza credito, o è senza copyright oppure non siamo riusciti a trovare l'autore dell'immagine, se sapete eventualmente di chi sono le immagini senza credito, per piacere segnalatecelo nei commenti e noi lo aggiungeremo nella descrizione del video.", 'altro', '5rEhSYf_WL0');

CREATE table subscriptions(
    id int auto_increment PRIMARY KEY,
    premium int,
    creator int,
    created_at timestamp,
    updated_at timestamp,
    FOREIGN KEY(creator) REFERENCES creators(id) on delete cascade,
    FOREIGN KEY(premium) REFERENCES premiums(id) on delete cascade,
    UNIQUE(premium),
    INDEX ab_premium(premium),
    INDEX ab_creator(creator));

CREATE table followers(
    id int auto_increment PRIMARY KEY,
    spectator int,
    creator int,
    created_at timestamp,
    updated_at timestamp,
    UNIQUE(spectator, creator),
    FOREIGN KEY(creator) REFERENCES creators(id) on delete cascade,
    FOREIGN KEY(spectator) REFERENCES spectators(id) on delete cascade,
    INDEX s_spectator(spectator),
    INDEX s_creator(creator));


CREATE table favourites(
    id int auto_increment PRIMARY KEY,
    spectator int,
    video int,
    created_at timestamp,
    updated_at timestamp,
    UNIQUE(spectator, video),
    FOREIGN KEY(spectator) REFERENCES spectators(id) on delete cascade,
    FOREIGN KEY(video) REFERENCES videos(id) on delete cascade,
    INDEX p_video(video),
    INDEX p_spectator(spectator));


delimiter //

  create procedure is_supporter (IN hash_premium int)
  begin
    SELECT creator FROM subscriptions where premium=hash_premium;
  end //

delimiter ;
create trigger add_follower
	after insert on followers
    for each row
	update creators
        set n_followers = n_followers+1 where id = new.creator;

create trigger remove_follower
	after delete on followers
    for each row
	update creators
        set n_followers = n_followers-1 where id = old.creator;

create trigger add_like
	after insert on favourites
    for each row
	update videos
        set likes = likes+1 where id = new.video;

create trigger remove_like
	after delete on favourites
    for each row
	update videos
        set likes = likes-1 where id = old.video;

delimiter //
create trigger is_premiums
	before insert on subscriptions
    for each row
    begin
		declare msg varchar(255);
		if new.premium not in (select id from premiums)
			then set msg = "L'utente non e\' premiums, quindi non può sottoscrivere un subscriptions";
				signal sqlstate '45000' set message_text=msg;
		end if;
	end //

  create trigger gia_abbonato
	before insert on subscriptions
    for each row
    begin
		declare msg varchar(255);
		if new.premium in (select premium from subscriptions)
			then set msg = "L'utente e\' gia\' abbonato ad un canale, prima disdire la sub";
				signal sqlstate '45000' set message_text=msg;
		end if;
	end //

create trigger controllo_costi
	before insert on premiums
    for each row
    begin
		declare msg varchar(255);
        set msg = "errore nel conteggio del costo, rivedi l'immissione";
		if new.tipo='mensile'
			then if new.costo <> new.mensile
					then signal sqlstate '45000' set message_text=msg;
					end if;
		elseif new.tipo='annuale'
			then if new.costo <> new.mensile*12
					then signal sqlstate '45000' set message_text=msg;
					end if;
		elseif new.tipo='settimanale'
			then if new.costo <> new.mensile/4
					then signal sqlstate '45000' set message_text=msg;
					end if;
		else
			set msg = "non esiste questo tipo di subscriptions";
			signal sqlstate '45000' set message_text=msg;
		end if;
	end //
delimiter ;
