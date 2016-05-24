-- Requetes de creation de tables
-- ATTENTION: METTRE "pro" EN PREFIXE DE TABLE POUR SAVOIR QUE C EST UNE TABLE DE PROJET
-- Exemple :
-- SE CONNECTER:
--	psql -h tuxa.sme.utc -d dbnf17p072 -U nf17p072
-- LISTER LES TABLES :
-- select * from pg_tables where tablename not like 'pg_%' AND tableowner='nf17p072';

CREATE TABLE proRoute(
	route_nom VARCHAR(50) PRIMARY KEY,
	type VARCHAR(15) NOT NULL,
	accessibilite VARCHAR(25) NOT NULL,
	CHECK(type IN ('RUE', 'ROUTE', 'AVENUE', 'IMPASSE', 'BOULEVARD', 'CHEMIN', 'RUELLE')),
	CHECK(accessibilite IN ('TRAFFIC NORMAL', 'TRAVAUX', 'ACCIDENT'))
);


CREATE TABLE proAdresse(
	id SERIAL PRIMARY KEY,
	numero_rue INTEGER NOT NULL,
	route_nom VARCHAR(50) REFERENCES proRoute(route_nom) NOT NULL,
	batiment VARCHAR(25),
	etage VARCHAR(5),
	digicode VARCHAR(15)
);

CREATE TABLE proJonction(
	id SERIAL PRIMARY KEY,
	type VARCHAR(25),
	CHECK(type IN ('CARREFOUR', 'INTERSECTION', 'ROND-POINT'))
);

CREATE TABLE proJonctionRoute(
	jonction_id INTEGER REFERENCES proJonction(id),
	route_nom VARCHAR(50) REFERENCES proRoute(route_nom),
	PRIMARY KEY (jonction_id, route_nom)
);

CREATE TABLE proClients(
	numero_client SERIAL PRIMARY KEY,
	prenom VARCHAR(25) NOT NULL,
	nom VARCHAR(25) NOT NULL,
	telephone VARCHAR(10),
	email VARCHAR(50) UNIQUE NOT NULL,
	adresse INTEGER REFERENCES proAdresse(id) NOT NULL
);

CREATE TABLE proDisponibilite(
	debut TIMESTAMP,
	fin TIMESTAMP,
	client INTEGER REFERENCES proClients(numero_client),
	PRIMARY KEY (debut, fin, client)
);

CREATE TABLE proMarchandise(
	id SERIAL PRIMARY KEY,
	denomination VARCHAR NOT NULL,
	prix DECIMAL(5,2) NOT NULL,
	stock INTEGER NOT NULL,
	delai_reapprovisionnement DATE
);

CREATE TABLE proCommande(
	id SERIAL PRIMARY KEY,
	livree BOOLEAN NOT NULL,
	date_livraison TIMESTAMP NOT NULL,
	date_commande TIMESTAMP NOT NULL,
	enquete_satisfaction_envoyee BOOLEAN NOT NULL,
	reponse_enquete_satisfaction VARCHAR,
	numero_client INTEGER REFERENCES proClients(numero_client)
);
--Projection(Commande, id) inclus ou egal a Projection(Marchandise_Commande, commande_id)

CREATE TABLE proMarchandiseCommande(
	numero_id INTEGER REFERENCES proMarchandise(id),
	commande_id INTEGER REFERENCES proCommande(id),
	quantite INTEGER,
	PRIMARY KEY (numero_id, commande_id)
);

CREATE VIEW ouLivrer AS 
SELECT cl.nom, cl.prenom, c.date_livraison, c.id , a.route_nom, a.numero_rue 
from proCommande c, proClients cl, proAdresse a 
WHERE c.numero_client = cl.numero_client AND cl.adresse=a.id AND c.livree=FALSE 
ORDER BY cl.nom;
