USE master

DROP DATABASE if exists cookbook;
CREATE DATABASE cookbook;
GO

USE cookbook;
GO


CREATE TABLE Categories (
    id INT IDENTITY(1,1),
    category_name VARCHAR(30),
    day_time_category_name VARCHAR(30),
    CONSTRAINT pk_categories_id PRIMARY KEY(id),
);

CREATE TABLE Users (
    id INT IDENTITY(1,1),
    username VARCHAR(32) NOT NULL,
    [password] VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    CONSTRAINT pk_users_id PRIMARY KEY(id)
);

CREATE TABLE Ingredients (
    id INT IDENTITY(1,1),
    [name] VARCHAR(100) NOT NULL,
    CONSTRAINT pk_ingredients_id PRIMARY KEY(id)
);

CREATE TABLE Recipes (
    id INT IDENTITY(1,1),
    category_id INT,
    [user_id] INT,
    ingredients_id INT,
    [name] VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    rating INT,
    cookbook VARCHAR(100),
    preptime INT,
    ease_of_prep VARCHAR(20),
    photo VARCHAR(1000),
    CONSTRAINT pk_recipe_id PRIMARY KEY(id),
    CONSTRAINT fk_category_id FOREIGN KEY (category_id) REFERENCES Categories(id) ON DELETE SET NULL,
    CONSTRAINT fk_user_id FOREIGN KEY ([user_id]) REFERENCES Users(id) ON DELETE SET NULL,
    CONSTRAINT fk_ingredients_id FOREIGN KEY (ingredients_id) REFERENCES Ingredients(id)
);

CREATE TABLE Lists (
    id int IDENTITY(1,1),
    user_id_list INT,
    favourite VARCHAR(255),
    lists VARCHAR(50),
    CONSTRAINT pk_lists_id PRIMARY KEY(id),
    CONSTRAINT fk_user_id_lists FOREIGN KEY (user_id_list) REFERENCES Users(id) ON DELETE SET NULL
);

CREATE TABLE Ingredients_category (
    id INT IDENTITY(1,1),
    ingredients_id_2 INT,
    [name] VARCHAR(20) NOT NULL,
    CONSTRAINT pk_ingredients_category_id PRIMARY KEY(id),
    CONSTRAINT fk_ingredients_id_2 FOREIGN KEY (ingredients_id_2) REFERENCES ingredients(id)
);