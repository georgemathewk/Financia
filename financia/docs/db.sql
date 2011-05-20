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
