/*
	All the table alteration scripts come here
*/

create table costcenter (
	id			int		auto_increment	primary key,
	code		varchar(100)	unique,
	name		varchar(100),
	remarks		text		

)engine=innodb;