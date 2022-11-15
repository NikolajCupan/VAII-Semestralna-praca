create table users
(
    id       int auto_increment
        primary key,
    username varchar(50) not null,
    password char(60)    not null,
    role     char        not null,
    email    varchar(50) not null
);

