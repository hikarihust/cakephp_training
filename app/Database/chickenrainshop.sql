/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     20/5/2013 10:10:18 PM                        */
/*==============================================================*/


drop table if exists books;

drop table if exists books_writers;

drop table if exists categories;

drop table if exists comments;

drop table if exists coupons;

drop table if exists groups;

drop table if exists orders;

drop table if exists users;

drop table if exists writers;

/*==============================================================*/
/* Table: books                                                 */
/*==============================================================*/
create table books
(
   id                   int not null auto_increment,
   category_id          int,
   title                varchar(100) not null,
   slug                 varchar(255) not null,
   image                varchar(255),
   info                 text not null,
   price                int not null,
   sale_price           int not null,
   pages                int not null,
   publisher            varchar(100) not null,
   publish_date         date not null,
   link_download        varchar(255) not null,
   published            bool default 0,
   created              datetime,
   modified             datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: books_writers                                         */
/*==============================================================*/
create table books_writers
(
   book_id              int not null,
   writer_id            int not null,
   primary key (book_id, writer_id)
);

/*==============================================================*/
/* Table: categories                                            */
/*==============================================================*/
create table categories
(
   id                   int not null auto_increment,
   name                 varchar(100) not null,
   slug                 varchar(255) not null,
   description          text,
   created              datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: comments                                              */
/*==============================================================*/
create table comments
(
   id                   int not null auto_increment,
   user_id              int not null,
   book_id              int not null,
   content              text not null,
   created              datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: coupons                                               */
/*==============================================================*/
create table coupons
(
   id                   int not null auto_increment,
   code                 varchar(255) not null,
   percent              float(3) not null,
   description          text,
   time_start           datetime not null,
   time_end             datetime not null,
   created              datetime,
   modified             datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: groups                                                */
/*==============================================================*/
create table groups
(
   id                   int not null auto_increment,
   name                 varchar(100) not null,
   description          text,
   created              datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: orders                                                */
/*==============================================================*/
create table orders
(
   id                   int not null auto_increment,
   user_id              int not null,
   customer_info        text not null,
   order_info           text not null,
   payment_info         text not null,
   status               int default 1,
   created              datetime,
   modified             datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users
(
   id                   int not null auto_increment,
   group_id             int not null,
   username             varchar(100) not null,
   password             varchar(100) not null,
   email                varchar(100) not null,
   firstname            varchar(100) not null,
   lastname             varchar(100) not null,
   address              varchar(255),
   phone_number         char(13),
   created              datetime,
   modified             datetime,
   primary key (id)
);

/*==============================================================*/
/* Table: writers                                               */
/*==============================================================*/
create table writers
(
   id                   int not null auto_increment,
   name                 varchar(100) not null,
   slug                 varchar(255) not null,
   biography            text,
   created              datetime,
   primary key (id)
);

alter table books add constraint fk_categories_books foreign key (category_id)
      references categories (id) on delete restrict on update restrict;

alter table books_writers add constraint fk_books_writers foreign key (book_id)
      references books (id) on delete restrict on update restrict;

alter table books_writers add constraint fk_books_writers2 foreign key (writer_id)
      references writers (id) on delete restrict on update restrict;

alter table comments add constraint fk_books_comments foreign key (book_id)
      references books (id) on delete restrict on update restrict;

alter table comments add constraint fk_users_comments foreign key (user_id)
      references users (id) on delete restrict on update restrict;

alter table orders add constraint fk_users_orders foreign key (user_id)
      references users (id) on delete restrict on update restrict;

alter table users add constraint fk_groups_users foreign key (group_id)
      references groups (id) on delete restrict on update restrict;

