CREATE DATABASE IF NOT EXISTS app_hosto;
USE app_hosto;

CREATE TABLE IF NOT EXISTS categorie_user(
    id int primary key auto_increment,
    nom varchar(30)not null,
    grade varchar(30)not null,
    fonction varchar(55)not null,
    adresse varchar(55)not null 
)engine=innodb;

CREATE TABLE IF NOT EXISTS user(
    id int primary key auto_increment,
    nom varchar(30)not null,
    email varchar(55) not null unique,
    password varchar(255)not null,
    role varchar(55)not null,
    id_cate int,
    CONSTRAINT fk_cate_id FOREIGN KEY (id_cate) REFERENCES categorie_user(id)
)engine=innodb;

CREATE TABLE IF NOT EXISTS patients(
    nom_pat varchar(30)not null,
    postnom_pat varchar(30)not null,
    adresse varchar(55)not null,
    genre_pat varchar(15)not null,
    poids_pat varchar(20)not null,
    id_inter_sys varchar(255) not null primary key,
    id_user int
)engine=innodb;

CREATE TABLE IF NOT EXISTS consultation(
    nom_consult varchar(30)not null,
    motif_consult varchar(55)not null,
    date_consult datetime,
    id_user int,
    id_pat varchar(255),
    id_inter_sys varchar(255) not null primary key,
    CONSTRAINT fk_ident_pat FOREIGN KEY (id_pat) REFERENCES patients(id_inter_sys)
    
)engine=innodb;

CREATE TABLE IF NOT EXISTS prescription(
    nom_prescrip varchar(30)not null,
    libelle_prescrip varchar(55)not null,
    date_prescript datetime,
    id_consult varchar(255)not null,
    id_inter_sys varchar(255) not null primary key,
    CONSTRAINT fk_ident_consult FOREIGN KEY (id_consult) REFERENCES consultation(id_inter_sys)

)engine=innodb;



-- Inssertion categorie
INSERT INTO categorie_user(id,nom,grade,fonction,adresse) VALUES(null,'agent', 'médecin directeur', 'pédiatre', 'Nzuzi n°15 lemba');
-- Admin inssertion password=admin
INSERT INTO user(id, nom, email,password,role, id_cate) VALUES(null, "kienge", 'kienge@gmail.com', '$2y$10$stdpDRzwS3t5wXa2UCNq7.Ubw/Mz9DLzrAseLDMhP/tdSUomHgKR.', 'admin', 1);



-- Patients requests
-- INSERT INTO patients (id,nom_pat,postnom_pat,adresse,genre_pat,poids_pat, id_inter_sys,id_consult) VALUES(null, '?', '?','?','?','?','?');
-- UPDATE patients SET nom_pat='?', postnom_pat='?',adresse='?',genre_pat='?',poids_pat='?',id_user='?';
-- DELETE FROM patients WHERE id='?';

-- INSERT INTO prescription (id_prescrip,nom_prescrip,libelle_prescrip,date_prescript) VALUES(null, '?', '?','?','?');
-- UPDATE description SET nom_prescrip='?',libelle_prescrip='?',date_prescript='?';
-- DELETE FROM prescription WHERE id_descrption='?';

-- INSERT INTO consultation(id_consult,nom_consult,motif_consult,date_consult) VALUES(null, '?', '?','?','?');
-- UPDATE description SET nom_consult='?'motif_consult,='?',date_consult='?';
-- DELETE FROM consultation WHERE id_descrption='?';