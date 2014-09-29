--use database solcity;

create table sc_user (
	userId int auto_increment not null,
	userName varchar(100) not null,
	password varchar(64) not null,
	firstName varchar(255),
	lastName varchar(255),
	email varchar(255),
	imageId int,
	primary key (userId)
);

create table sc_comment (
	commentId int auto_increment not null,
	comment text not null,
	userId int not null,
	articleId int not null,
	primary key (commentId)
);

create table sc_article (
	articleId int auto_increment not null,
	title text,
	article longtext,
	originLink text,
	userId int not null,
	subCategoryId int not null,
	primary key (articleId)
);

create table sc_image (
	imageId int auto_increment not null,
	physicalPath text not null,
	alternativeText text,
	articleId int,
	eventId int,
	primary key (imageId)
);

create table sc_category (
	categoryId int auto_increment not null,
	name varchar(255),
	description text,
	primary key (categoryId)
);

create table sc_subcategory (
	subCategoryId int auto_increment not null,
	name varchar(255),
	description text,
	categoryId int not null,
	primary key (subCategoryId)
);

create table sc_event (
	eventId int auto_increment not null,
	name text not null,
	description longtext,
	userId int not null,
	subCategoryId int not null,
	venueId int not null,
	primary key (eventId)
);

create table sc_venue (
	venueId int auto_increment not null,
	zipCode smallint(4),
	city varchar(255),
	address varchar(255),
	geoTagLatitude decimal(10,8),
	geoTagLongitude decimal(11,8),
	primary key (venueId)
);

alter table sc_user add constraint sc_user_sc_image1 foreign key (imageId) references sc_image (imageId);
alter table sc_comment add constraint sc_comment_sc_user1 foreign key (userId) references sc_user (userId);
alter table sc_comment add constraint sc_comment_sc_article1 foreign key (articleId) references sc_article (articleId);
alter table sc_article add constraint sc_article_sc_user1 foreign key (userId) references sc_user (userId);
alter table sc_article add constraint sc_article_sc_subcategory1 foreign key (subCategoryId) references sc_subcategory (subCategoryId);
alter table sc_image add constraint sc_image_sc_article1 foreign key (articleId) references sc_article (articleId);
alter table sc_image add constraint sc_image_sc_event1 foreign key (eventId) references sc_event (eventId);
alter table sc_subcategory add constraint sc_subcategory_sc_category1 foreign key (categoryId) references sc_category (categoryId);
alter table sc_event add constraint sc_event_sc_user1 foreign key (userId) references sc_user (userId);
alter table sc_event add constraint sc_event_sc_subcategory1 foreign key (subCategoryId) references sc_subcategory (subCategoryId);
alter table sc_event add constraint sc_event_sc_venue1 foreign key (venueId) references sc_venue (venueId);
