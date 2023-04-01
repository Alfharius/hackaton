create table if not exists intensive.forms
(
    id     int auto_increment
        primary key,
    name   varchar(256) not null,
    fields json         not null
)
    collate = utf8mb4_unicode_ci;

create table if not exists intensive.news
(
    id          int auto_increment
        primary key,
    title       varchar(256) not null,
    description text         not null,
    picture     varchar(512) not null
)
    collate = utf8mb4_unicode_ci;

create table if not exists intensive.thematics
(
    id   int auto_increment
        primary key,
    name varchar(256) not null
)
    collate = utf8mb4_unicode_ci;

create table if not exists intensive.users
(
    id         int auto_increment
        primary key,
    name       text          not null,
    email      varchar(256)  not null,
    password   varchar(256)  not null,
    type       int default 1 not null,
    surname    text          null,
    patronymic text          null
)
    collate = utf8mb4_unicode_ci;

create table if not exists intensive.intensives
(
    id          int auto_increment
        primary key,
    name        text not null,
    description text not null,
    lector_id   int  not null,
    img         text null,
    constraint intensives_ibfk_1
        foreign key (lector_id) references intensive.users (id)
)
    collate = utf8mb4_unicode_ci;

create table if not exists intensive.chats
(
    id           int auto_increment
        primary key,
    intensive_id int null,
    user_id      int null,
    constraint chats_intensives_id_fk
        foreign key (intensive_id) references intensive.intensives (id),
    constraint chats_users_id_fk
        foreign key (user_id) references intensive.users (id)
);

create index lector_id
    on intensive.intensives (lector_id);

create table if not exists intensive.intensives_thematics
(
    intensive_id int not null,
    thematic_id  int not null,
    constraint intensives_thematics_ibfk_1
        foreign key (intensive_id) references intensive.intensives (id),
    constraint intensives_thematics_ibfk_2
        foreign key (thematic_id) references intensive.thematics (id)
)
    collate = utf8mb4_unicode_ci;

create index intensive_id
    on intensive.intensives_thematics (intensive_id);

create index thematic_id
    on intensive.intensives_thematics (thematic_id);

create table if not exists intensive.messages
(
    id      int auto_increment
        primary key,
    chat_id int          null,
    user_id int          null,
    text    varchar(512) null,
    constraint messages_chats_id_fk
        foreign key (chat_id) references intensive.chats (id),
    constraint messages_users_id_fk
        foreign key (user_id) references intensive.users (id)
);

create table if not exists intensive.schedules
(
    id           int auto_increment
        primary key,
    name         varchar(256) not null,
    start_time   timestamp    not null,
    end_time     timestamp    not null,
    intensive_id int          not null,
    constraint schedules_ibfk_1
        foreign key (intensive_id) references intensive.intensives (id)
)
    collate = utf8mb4_unicode_ci;

create index intensive_id
    on intensive.schedules (intensive_id);

create table if not exists intensive.user_intensives
(
    user_id      int not null,
    intensive_id int not null,
    constraint user_intensives_ibfk_1
        foreign key (user_id) references intensive.users (id),
    constraint user_intensives_ibfk_2
        foreign key (intensive_id) references intensive.intensives (id)
)
    collate = utf8mb4_unicode_ci;

create index intensive_id
    on intensive.user_intensives (intensive_id);

create index user_id
    on intensive.user_intensives (user_id);

create table if not exists intensive.users_forms_intensives
(
    user_id      int not null,
    form_id      int not null,
    intensive_id int not null,
    constraint users_forms_intensives_ibfk_1
        foreign key (form_id) references intensive.forms (id),
    constraint users_forms_intensives_ibfk_2
        foreign key (intensive_id) references intensive.intensives (id),
    constraint users_forms_intensives_ibfk_3
        foreign key (user_id) references intensive.users (id)
)
    collate = utf8mb4_unicode_ci;

create index form_id
    on intensive.users_forms_intensives (form_id);

create index intensive_id
    on intensive.users_forms_intensives (intensive_id);

create index user_id
    on intensive.users_forms_intensives (user_id);

