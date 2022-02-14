CREATE DATABASE challenge_clinic

USE challenge_clinic


CREATE TABLE schedules(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    specialty_id INTEGER,
    professional_id INTEGER,
    name VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    source_id INTEGER,
    birthdate DATETIME,
    created DATETIME DEFAULT CURRENT_TIMESTAMP

);