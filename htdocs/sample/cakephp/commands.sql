
create table posts (
	id int not null auto_increment primary key,
	title varchar(50),
	body textk,
	created datetime default null,
	modified datetime default null
);

insert into posts (title,body,created,modified) values
('title1','body1',now(),now()),
('title2','body2',now(),now()),
('title3','body3',now(),now());
