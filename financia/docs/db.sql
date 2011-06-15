/*
	All the table alteration scripts come here
*/

create table costcenter (
	id			int		auto_increment	primary key,
	code		varchar(100)	unique,
	name		varchar(100),
	remarks		text		

)engine=innodb;


create table financialperiod (
	id		int		auto_increment	primary key,
	code	varchar(100)	unique,
	name	varchar(100),
	fdate	date,
	tdate	date,
	remarks	text
	)engine=innodb;

create table accounthead (
	id			int		auto_increment	primary key,
	code		varchar(100)	unique,
	name		varchar(100),
	parent_id	int,
	remarks	text,
	foreign key (parent_id) references accounthead(id)
	)engine=innodb;
	
alter table accounthead drop foreign key accounthead_ibfk_1;

alter table accounthead add constraint fk1 foreign key(parent_id) references accounthead(id) on delete cascade;

create table user (
      id     int auto_increment primary key,
      user   varchar(100),
      passwd varchar(100)
)engine=innodb;



