create table Buildings
(
    building_id int auto_increment
        primary key,
    posX        int null,
    posY        int null,
    width       int null,
    height      int null
);

create table Zone
(
    building_id int null,
    zone_id     int auto_increment
        primary key,
    zone_posX   int null,
    zone_posY   int null,
    zone_width  int null,
    zone_height int null,
    constraint Zone_ibfk_1
        foreign key (building_id) references Buildings (building_id)
            on update cascade on delete cascade
);

create table Storage
(
    zone_id              int null,
    storage_id           int auto_increment
        primary key,
    Storage_posX         int null,
    Storage_posY         int null,
    StorageMassBois      int null,
    StorageMassPlastique int null,
    StorageMassPD        int null,
    constraint Storage_ibfk_1
        foreign key (zone_id) references Zone (zone_id)
            on update cascade on delete cascade
);

create index zone_id
    on Storage (zone_id);

create index building_id
    on Zone (building_id);

