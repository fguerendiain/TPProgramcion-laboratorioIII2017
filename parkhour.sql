create table users(
    id int not null auto_increment primary key,
    googleid varchar(256) not null,
    email varchar(128) not null unique,
    displayname varchar(256) not null,
    avatar varchar(256),
    active boolean not null default false,
    admin boolean not null default false,
    deleted boolean not null default false
);

create table session(
    id int not null auto_increment primary key,
    token char(36) not null,
    owner int not null,
    intime bigint not null,
    deleted boolean not null default false,
    foreign key (owner) references users(id) on delete cascade
);

create table place(
    id int not null auto_increment primary key,
    name varchar(32) not null,
    floor int not null default 1,
    handicap boolean not null default false,
    active boolean not null default true,
    deleted boolean not null default false
);

create table vehicle(
    id int not null auto_increment primary key,
    license varchar(16) not null,
    alien boolean not null default false,
    colour varchar(16) not null,
    model varchar(32) not null,
    brand varchar(32) not null,
    deleted boolean not null default false
);

create table parking(
    id int not null auto_increment primary key,
    place int not null,
    vehicle int not null,
    inuser int not null,
    outuser int,
    intime bigint not null,
    outtime bigint,
    price int,
    foreign key (place) references place(id) on delete cascade,
    foreign key (vehicle) references vehicle(id) on delete cascade,
    foreign key (inuser) references users(id) on delete cascade,
    foreign key (outuser) references users(id) on delete cascade
);