--COMMANDES A EXECUTER : ------------------------------------------------------------------------------------

--création de la base de donnée
create database bdd;

-- selectionner notre base de donnée
use bdd;

--CREATION DE LA TABLE "membres"
--clé primaire(id) : renseigne l'id d'un membre
--pseudo : renseigne le pseudo de connexion d'un membre
--mail : renseigne le mail d'un membre
--mdp : renseigne le mot de passe de connexion d'un membre
CREATE TABLE membres (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
pseudo VARCHAR(25) NOT NULL,
mail VARCHAR(25) NOT NULL,
mdp CHAR(32) NOT NULL);
--
--
--
--CREATION DE LA TABLE "todolists"
--todolist : renseigne le titre d'une todolist
--status : renseigne le status de la todolist (0 : en cours, 1 : terminé)
--membre : réfèrence à un membre parmit les membres
--clé étrangère(membre) : faire référence à la clé primaire membres(id)
CREATE TABLE todolists (
membre INT NOT NULL,
todolist VARCHAR(100) NOT NULL,
status INT NOT NULL,
FOREIGN KEY(membre) REFERENCES membres(id));
--
--
--
--CREATION DE LA TABLE "taches"
--membre : réfèrence à un membre parmit les membres
--todolist : refère à une todolist parmit les todolists
--tache : renseigne une tache de la todolist
--status : renseigne le status d'une tache (0 : en cours, 1 : terminé)
--clé étrangère(membre) : faire référence à la clé primaire membres(id)
CREATE TABLE taches (
membre INT NOT NULL,
todolist VARCHAR(100) NOT NULL,
tache VARCHAR(255) NOT NULL,
status INT NOT NULL,
FOREIGN KEY(membre) REFERENCES membres(id));

--COMMANDES UTILES : ------------------------------------------------------------------------------------

--list of all tables and views
show tables;

--list of all tables and views with tables types
show full tables;

--description d'une table
describe membres;

--voir tous les utilisateurs
select * from membres;

--voir toutes les todolists
select * from todolists;

--voir toutes les taches
select * from taches;


--COMMANDES AUTRES : ------------------------------------------------------------------------------------

--ajouter une colonne  :
ALTER TABLE nom_table
ADD nom_colonne type_donnees

--supprimer une colonne :
ALTER TABLE nom_table
DROP nom_colonne

--modifier une colonne:
ALTER TABLE nom_table
MODIFY nom_colonne type_donnees

--renommer une colonne :
ALTER TABLE nom_table
CHANGE colonne_ancien_nom colonne_nouveau_nom type_donnees

--ajouter des valeurs (colonne) :
INSERT INTO nom_table (nom_colonne_1, nom_colonne_2, ...)
VALUES ('valeur 1', 'valeur 2', ...)
--exemple :
--ajouter des membres
INSERT INTO membres (pseudo, mail, mdp) VALUES ("alex", "alexandre@supinfo.com", md5("ZITOUNI"));
INSERT INTO membres (pseudo, mail, mdp) VALUES ("tom", "thomas@supinfo.com", md5("SENSE"));
--ajouter des todolists
INSERT INTO todolists (membre, todolist, status) VALUES (1, "Faire les courses", 0);
INSERT INTO todolists (membre, todolist, status) VALUES (2, "Planning", 0);
--ajouter des taches
INSERT INTO taches (membre, todolist, tache, status) VALUES (1, "Faire les courses", "pommes", 0);
INSERT INTO taches (membre, todolist, tache, status) VALUES (1, "Faire les courses", "poires", 0);
INSERT INTO taches (membre, todolist, tache, status) VALUES (1, "Faire les courses", "orange", 0);
INSERT INTO taches (membre, todolist, tache, status) VALUES (2, "Planning", "courir", 0);
INSERT INTO taches (membre, todolist, tache, status) VALUES (2, "Planning", "travailler", 0);
INSERT INTO taches (membre, todolist, tache, status) VALUES (2, "Planning", "dormir", 0);

--mettre à jour une ligne :
UPDATE table_name
SET column1 = value1, column2 = value2, ...
WHERE condition;

--exemple, changer le détenteur d'une todolist :
UPDATE todolists SET membre = 2 WHERE todolist="Planning";
UPDATE taches SET membre = 2 WHERE todolist = "Planning";

--supprimer une ligne :
DELETE FROM nom_table WHERE condition;

--exemple, supprimer un membre :
DELETE FROM membres WHERE pseudo="alick";

--exemple, supprimer une todolist :
DELETE FROM todolists WHERE todolist="todo_name";

--supprimer une table :
DROP TABLE nom_table;

--reset l'auto increment :
SELECT MAX( `id` ) FROM `membres` ; -- selectionne l'id max
ALTER TABLE `membres` AUTO_INCREMENT = number; -- // ou réinitialisation => 0