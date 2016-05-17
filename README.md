# CarteLivraison

_TODO:_

* Créer les tables
	* ~~Client~~
	* ~~Disponibilité~~
	* ~~Adresse~~
	* ~~Commande~~
	* ~~Marchandise~~
	* ~~MarchandiseCommande~~
	* ~~Route~~
	* ~~Jonction~~
	* ~~JontionRoutes~~

* Traduire en requete SQL :
    * Quels sont les clients en attente de livraison ?

    * Quels sont les routes avec beaucoup de clients en attente ?

    * Quels clients peuvent être livrés aujourd'hui ?

    * Un livreur est actuellement à une jonction, quels sont les clients pouvant être livrés depuis cette dernière ?

    * ~~Quelles sont les marchandises en rupture de stock ?~~

    * __Exemples de mises à jour à prendre en compte__ :

    * Quand une marchandise a été livrée, les données sur le client et la marchandise doivent être mise à jour

    * Quand un client passe une commande, sa fiche client doit être mise à jour

    * En cas de réapprovisionnement, les données sur les marchandises doivent être mise à jour

    ~~* Pouvoir ajouter de nouveaux clients~~

    ~~* Pouvoir mettre à jour les informations d'accessibilité des routes~~

* Interface WEB :

~~Fenêtre découpée en 2 frames :~~
* ~~Frame 1 : Main content à droite (80%)~~
* ~~Frame 2 : Menu à gauche (20%) ~~
	* ~~Gestion des clients (Tout les clients, add/supp clients, clients en attente, etc...~~
	* ~~Gestion des marchandises (Toutes les marchandises, rupture de stock, Réapprovisionnement ...)~~
	* ~~Gestion des commandes~~

* ~~Nouveau client : implémenter les disponibilités à l'inscription~~
* Liste clients : afficher un bouton "Fiche client" pour chaque client allant sur une page récapitulant : nom prenom, tel, adresse, email, et liste des commandes déjà passées et leur contenu.

4 Vues
4 Insertions : Nouveau client / Nouveau produit / Nouvelle Commande / Nouvelle route / Nouvelle Jonction
4 Suppressions
4 Update : Modifier client / Modifier accessibilité / Reapprovisionnement
4 Recherche Liste Client / Liste des produits / Rupture de stock / Livraison proche d'une jonction / Repartition des commandes / Clients en attente
4 Agregats
