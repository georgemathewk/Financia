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



create table transaction_mode(
	id	int	auto_increment primary key,
	code	varchar(100),
	name	varchar(100),
	remarks text
)engine=innodb;

create table voucher_type (
	id	int	auto_increment primary key,
	code	varchar(100)	unique,
	name	varchar(100),
	remarks	text
)engine=innodb;

create table voucher(
	id		int	auto_increment	primary key,
	voucher_no	varchar(100),
	voucher_date	timestamp	not null default now(),
	voucher_type_id	int,
	constraint uk unique(voucher_no,voucher_date),
	constraint v_fk1 foreign key(voucher_type_id) references voucher_type(id)
)engine=innodb;


create table voucher_details(
	id		int	auto_increment	primary key,
	voucher_id	int,
	accounthead_id	int,
	debit_credit 	int,
	amount		decimal(30,2),
	constraint vd_fk1 foreign key(voucher_id) references voucher(id),
	constraint vd_fk2 foreign key(accounthead_id) references accounthead(id)
)engine=innodb;


create table voucher_transaction_mode(
	id			int	auto_increment primary key,
	voucher_id		int,
	transaction_mode_id	int,
	amount			decimal(30,2),
	constraint vtm_fk1 foreign key(voucher_id) references voucher(id),
	constraint vtm_fk2 foreign key(transaction_mode_id) reference transaction_mode(id)

)engine=innodb;



