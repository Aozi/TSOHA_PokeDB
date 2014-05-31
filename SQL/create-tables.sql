CREATE TABLE db_user (
    user_id             integer NOT NULL PRIMARY KEY,
    username            varchar(20) NOT NULL,
    password            char(64) NOT NULL
);

CREATE TABLE Pokemon (
    poke_id             integer NOT NULL PRIMARY KEY,
    poke_name           varchar(20) NOT NULL,
    height              integer NOT NULL,
    weight              integer NOT NULL,
    hp                  integer NOT NULL,
    attack              integer NOT NULL,
    defense             integer NOT NULL,
    sp_atk              integer NOT NULL,
    sp_def              integer NOT NULL,
    speed               integer NOT NULL,
    ev_yield            integer NOT NULL
);

CREATE TABLE trainer_pokemon (
    cust_id             SERIAL PRIMARY KEY,
    poke_id             integer NOT NULL,
    trainer_id          integer references db_user(user_id) NOT NULL,
    poke_name           varchar(20),
    height              integer NOT NULL,
    weight              integer NOT NULL,
    hp                  integer NOT NULL,
    attack              integer NOT NULL,
    defense             integer NOT NULL,
    sp_atk              integer NOT NULL,
    sp_def              integer NOT NULL,
    speed               integer NOT NULL,
    poke_level          integer NOT NULL,
    ev_yield            integer NOT NULL,
    on_team             boolean
);


CREATE TABLE types(
    type_id             integer NOT NULL PRIMARY KEY,
    type_name           varchar(20) NOT NULL
);

CREATE TABLE poke_type (
    poke_id             integer references Pokemon(poke_id) NOT NULL,
    type1               integer references types(type_id) NOT NULL,
    type2               integer references types(type_id)
);

CREATE TABLE type_effectivness (
    attack_type         integer references types(type_id) NOT NULL,
    defense_type        integer references types(type_id) NOT NULL,
    damage_rate         integer NOT NULL
);

CREATE TABLE moves (
    move_id             integer NOT NULL PRIMARY KEY,
    move_name           varchar(30) NOT NULL,
    description         varchar(5000),
    power               integer NOT NULL,
    move_PP             integer NOT NULL,
    accuarcy            integer NOT NULL
);

CREATE TABLE poke_moves (
    poke_id             integer references Pokemon(poke_id) NOT NULL,
    move_id             integer references moves(move_id) NOT NULL
);
