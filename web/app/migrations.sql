create table times
(
    id    int auto_increment,
    title varchar(10) not null,
    constraint times_pk
        primary key (id)
);

INSERT INTO times (id, title) VALUES (1, '9:00');
INSERT INTO times (id, title) VALUES (2, '10:00');
INSERT INTO times (id, title) VALUES (3, '11:00');
INSERT INTO times (id, title) VALUES (4, '12:00');
INSERT INTO times (id, title) VALUES (5, '13:00');
INSERT INTO times (id, title) VALUES (6, '14:00');
INSERT INTO times (id, title) VALUES (7, '15:00');
INSERT INTO times (id, title) VALUES (8, '16:00');
INSERT INTO times (id, title) VALUES (9, '17:00');
INSERT INTO times (id, title) VALUES (10, '18:00');

create table users
(
    id       int auto_increment,
    username varchar(40)  not null,
    password varchar(100) not null,
    name     varchar(50)  not null,
    constraint users_pk
        primary key (id),
    constraint users_username_unique
        unique (username)
);
INSERT INTO users (id, username, password, name) VALUES (1, 'habib', '123456', 'habib saleh');
INSERT INTO users (id, username, password, name) VALUES (1, 'test', '123456', 'test testi');

create table appointments
(
    id      int auto_increment,
    time_id int         not null,
    date    varchar(10) not null,
    user_id int         not null,

    constraint appointments_fk_time_id
        primary key (id),
    constraint appointments_unique
        unique (date, time_id),
    constraint appointments_times_id_fk
        foreign key (time_id) references times (id),
    foreign key (user_id) references users (id)
);