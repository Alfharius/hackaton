create table if not exists forms
(
    id     int auto_increment
    primary key,
    name   varchar(256) not null,
    fields json         not null
    )
    collate = utf8mb4_unicode_ci;

create table if not exists news
(
    id          int auto_increment
    primary key,
    title       varchar(256) not null,
    description text         not null,
    picture     varchar(512) not null
    )
    collate = utf8mb4_unicode_ci;

create table if not exists thematics
(
    id   int auto_increment
    primary key,
    name varchar(256) not null
    )
    collate = utf8mb4_unicode_ci;

create table if not exists users
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

create table if not exists intensives
(
    id          int auto_increment
    primary key,
    name        text not null,
    description text not null,
    lector_id   int  not null,
    img         text null,
    constraint intensives_ibfk_1
    foreign key (lector_id) references users (id)
    )
    collate = utf8mb4_unicode_ci;

create index lector_id
    on intensives (lector_id);

create table if not exists intensives_thematics
(
    intensive_id int not null,
    thematic_id  int not null,
    constraint intensives_thematics_ibfk_1
    foreign key (intensive_id) references intensives (id),
    constraint intensives_thematics_ibfk_2
    foreign key (thematic_id) references thematics (id)
    )
    collate = utf8mb4_unicode_ci;

create index intensive_id
    on intensives_thematics (intensive_id);

create index thematic_id
    on intensives_thematics (thematic_id);

create table if not exists schedules
(
    id           int auto_increment
    primary key,
    name         varchar(256) not null,
    decsription  text         not null,
    start_time   timestamp    not null,
    end_time     timestamp    not null,
    intensive_id int          not null,
    constraint schedules_ibfk_1
    foreign key (intensive_id) references intensives (id)
    )
    collate = utf8mb4_unicode_ci;

create index intensive_id
    on schedules (intensive_id);

create table if not exists user_intensives
(
    user_id      int not null,
    intensive_id int not null,
    constraint user_intensives_ibfk_1
    foreign key (user_id) references users (id),
    constraint user_intensives_ibfk_2
    foreign key (intensive_id) references intensives (id)
    )
    collate = utf8mb4_unicode_ci;

create index intensive_id
    on user_intensives (intensive_id);

create index user_id
    on user_intensives (user_id);

create table if not exists users_forms_intensives
(
    user_id      int not null,
    form_id      int not null,
    intensive_id int not null,
    constraint users_forms_intensives_ibfk_1
    foreign key (form_id) references forms (id),
    constraint users_forms_intensives_ibfk_2
    foreign key (intensive_id) references intensives (id),
    constraint users_forms_intensives_ibfk_3
    foreign key (user_id) references users (id)
    )
    collate = utf8mb4_unicode_ci;

create index form_id
    on users_forms_intensives (form_id);

create index intensive_id
    on users_forms_intensives (intensive_id);

create index user_id
    on users_forms_intensives (user_id);

