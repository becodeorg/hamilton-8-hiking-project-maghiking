## create database
CREATE DATABASE `hiking_project`;

## create table
CREATE TABLE `Hikes` (
    ID int PRIMARY KEY AUTO_INCREMENT UNIQUE NOT NULL,
    name varchar(60) NOT NULL,
    distance float NOT NULL,
    duration time NOT NULL,
    elevation_gain float NOT NULL,
    description varchar(500) NOT NULL,
    created_at date NOT NULL,
    updated_at date NULL
);

CREATE TABLE `Users`(
    ID int PRIMARY KEY AUTO_INCREMENT UNIQUE NOT NULL,
    firstname varchar(60) NOT NULL,
    lastname varchar(60) NOT NULL,
    nickname varchar(60) UNIQUE NOT NULL,
    email varchar(60) UNIQUE NOT NULL,
    password varchar(300) NOT NULL
);

CREATE TABLE `Tags` (
    ID int PRIMARY KEY AUTO_INCREMENT UNIQUE NOT NULL,
    name varchar(60) UNIQUE NOT NULL
);