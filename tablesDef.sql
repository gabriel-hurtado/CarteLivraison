-- Requetes de creation de tables
-- ATTENTION: METTRE "pro" EN PREFIXE DE TABLE POUR SAVOIR QUE C EST UNE TABLE DE PROJET
-- Exemple :

-- CREATE TABLE proClients ( ........ );

CREATE TABLE proRoute(
	route_nom VARCHAR(50) PRIMARY KEY,
	type VARCHAR(15) NOT NULL,
	accessibilite VARCHAR(25) NOT NULL,
	CHECK(type IN ('RUE', 'ROUTE', 'AVENUE', 'IMPASSE', 'BOULEVARD', 'CHEMIN', 'RUELLE')),
	CHECK(accessibilite IN ('TRAFFIC NORMAL', 'TRAVAUX', 'ACCIDENT'))
);


CREATE TABLE proAdresse(
	numero_rue INTEGER,
	route_nom VARCHAR(50) REFERENCES proRoute(route_nom),
	batiment VARCHAR(25),
	etage INTEGER,
	digicode VARCHAR(15),
	PRIMARY KEY (numero_rue, route_nom)
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
	telephone INTEGER(10),
	email VARCHAR(50) UNIQUE NOT NULL,
	route_nom VARCHAR(50) REFERENCES proAdresse(route_nom) NOT NULL,
	numero_rue INTEGER REFERENCES proAdresse(numero_rue) NOT NULL
);

CREATE TABLE proDisponibilite(
	debut TIMESTAMP,
	dureeH DECIMAL(2,2),
	client INTEGER REFERENCES proClients(numero_client),
	PRIMARY KEY (debut, dureeH, client)
);