CREATE DATABASE fridgedb;
USE fridgedb;
create table categories
(
    id                     int auto_increment
        primary key,
    category_name          varchar(30) null,
    day_time_category_name varchar(30) null
);

create table ingredients
(
    id   int auto_increment
        primary key,
    name varchar(100) not null
);

create table IngredientsCategory
(
    id             int auto_increment
        primary key,
    ingredientsId2 int         null,
    name           varchar(20) not null,
    constraint fk_ingredients_id_2
        foreign key (ingredientsId2) references ingredients (id)
);

create table users
(
    id       int auto_increment
        primary key,
    username tinytext not null,
    password text     not null,
    email    text     null,
    constraint users_id_uindex
        unique (id),
    constraint users_username_uindex
        unique (username(32)),
    constraint ch_email
        check (`email` like '%@%.%')
);

create table lists
(
    id           int auto_increment
        primary key,
    user_id_list int          null,
    favourite    varchar(255) null,
    lists        varchar(50)  null,
    constraint fk_user_id_lists
        foreign key (user_id_list) references users (id)
            on delete set null
);

create table recipes
(
    id            int auto_increment
        primary key,
    categoryId    int           null,
    userId        int           null,
    ingredientsId int           null,
    name          varchar(255)  not null,
    rating        tinyint       null,
    cookbook      varchar(100)  null,
    preptime      int           null,
    easeOfPrep    varchar(20)   null,
    photo         varchar(1000) null,
    constraint fk_category_id
        foreign key (categoryId) references categories (id)
            on delete set null,
    constraint fk_ingredients_id
        foreign key (ingredientsId) references ingredients (id),
    constraint fk_user_id
        foreign key (userId) references users (id)
            on delete set null,
    constraint ch_time
        check (`preptime` > 0)
);
