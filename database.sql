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

CREATE table subscriptions(
    id int PRIMARY KEY,
    premium int,
    creator int,
    created_at timestamp,
    updated_at timestamp,
    FOREIGN KEY(creator) REFERENCES creators(id) on delete cascade,
    FOREIGN KEY(premium) REFERENCES premiums(id) on delete cascade,
    UNIQUE(premium),
    INDEX ab_premium(premium),
    INDEX ab_creator(creator));

CREATE table old_subscriptions(
    id int PRIMARY KEY,
    premium int,
    creator int,
    created_at timestamp,
    updated_at timestamp,
    UNIQUE(premium, creator, created_at),
    FOREIGN KEY(premium) REFERENCES premiums(id) on update cascade,
    FOREIGN KEY(creator) REFERENCES creators(id) on update cascade,
    INDEX ap_premium(premium),
    INDEX ap_creator(creator));

CREATE table followers(
    id int PRIMARY KEY,
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
    id int PRIMARY KEY,
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

create procedure abbonamenti_fatti (IN hash_premium int)
  begin
	drop table if exists abbonamenti_t;
	create temporary table abbonamenti_t(
		creator int,
		username varchar(16),
		created_at timestamp,
		updated_at timestamp,
		fine timestamp);
	insert into abbonamenti_t
		select a.creator, c.username, a.created_at, a.created_at, null from subscriptions a join creators c on a.creator = c.id
			where a.premium=hash_premium;
	insert into abbonamenti_t
		select a.creator, c.username, a.created_at, a.created_at, a.fine from old_subscriptions a join creators c on a.creator = c.id
			where a.premium=hash_premiums;
	select * from abbonamenti_t;
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

create trigger aggiorna_abbonamenti
	after delete on subscriptions
    for each row
		insert into old_subscriptions values (old.premium, old.creator, old.created_at, current_date());

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