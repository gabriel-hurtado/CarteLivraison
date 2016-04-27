# CarteLivraison

_TODO:_

* Créer les tables
	* Client
	* Disponibilité
	* Demande
	* Adresse
	* Commande
	* Marchandise
	* MarchandiseCommande
	* Route
	* Jonction
	* JontionRoutes

* Traduire en requete SQL : 
    * Quels sont les clients en attente de livraison ?

    * Quels sont les routes avec beaucoup de clients en attente ?

    * Quels clients peuvent être livrés aujourd'hui ?

    * Un livreur est actuellement à une jonction, quels sont les clients pouvant être livrés depuis cette dernière ?

    * Quelles sont les marchandises en rupture de stock ?

    * __Exemples de mises à jour à prendre en compte__ :

    * Quand une marchandise a été livrée, les données sur le client et la marchandise doivent être mise à jour

    * Quand un client passe une commande, sa fiche client doit être mise à jour

    * En cas de réapprovisionnement, les données sur les marchandises doivent être mise à jour

    * Pouvoir ajouter de nouveaux clients

    * Pouvoir mettre à jour les informations d'accessibilité des routes
