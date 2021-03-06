CREATE
DATABASE fridgedb;
    USE
fridgedb;
create table IngredientsCategory
(
    id   int auto_increment
        primary key,
    name varchar(20) not null
);

create table ingredients
(
    id       int auto_increment
        primary key,
    name     varchar(100) not null,
    category int null,
    constraint ingredients_IngredientsCategory_id_fk
        foreign key (category) references IngredientsCategory (id)
            on delete set null
);

create table users
(
    id       int auto_increment
        primary key,
    username tinytext not null,
    password text     not null,
    email    text null,
    constraint users_id_uindex
        unique (id),
    constraint users_username_uindex
        unique (username(32)),
    constraint ch_email
        check (`email` like '%@%')
);

create table recipes
(
    id          int auto_increment
        primary key,
    name        varchar(255) not null,
    userId      int null,
    rating      tinyint null,
    preptime    int null,
    easeOfPrep  varchar(20) null,
    photo       varchar(1000) null,
    description varchar(2000) null,
    constraint fk_user_id
        foreign key (userId) references users (id)
            on delete set null,
    constraint ch_time
        check (`preptime` > 0)
);

create table fav
(
    id     int auto_increment
        primary key,
    user   int null,
    recipe int null,
    constraint fav_recipes_id_fk
        foreign key (recipe) references recipes (id)
            on delete cascade,
    constraint fav_users_id_fk
        foreign key (user) references users (id)
            on delete cascade
);

create table ingredientsList
(
    id     int auto_increment
        primary key,
    ingred int null,
    recipe int null,
    constraint ingredientsList_ingredients_id_fk
        foreign key (ingred) references ingredients (id)
            on delete cascade,
    constraint ingredientsList_recipes_id_fk
        foreign key (recipe) references recipes (id)
            on delete cascade
);

