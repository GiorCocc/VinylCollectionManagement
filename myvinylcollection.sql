create table IF NOT EXISTS records (
    id int(11) NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    artist int(11) NOT NULL,
    label int(11),
    year int(11),
    insert_date datetime,
    vinyl_condition varchar(3),
    sleeve_condition varchar(3),
    format int(2),
    speed int(2),
    notes text,
    songs text,

    PRIMARY KEY (id),
    FOREIGN KEY (artist) REFERENCES artists(id),
    FOREIGN KEY (label) REFERENCES labels(id),
);

create table IF NOT EXISTS artists (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    kind varchar(255),
    PRIMARY KEY (id)
);

create table IF NOT EXISTS labels (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

create tabel IF NOT EXISTS songs (
    id int(11) NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    artist int(11) NOT NULL,
    duration int(11),
    records int(11),
    PRIMARY KEY (id),
    FOREIGN KEY (artist) REFERENCES artists(id),
    FOREIGN KEY (records) REFERENCES records(id)
);

