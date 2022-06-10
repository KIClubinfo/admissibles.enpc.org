# admissible logement
Site pour l'attribution des chambres de Meunier aux admissibles, pour leurs oraux.

# Développement et test
## Login de l'administrateur du site admissible

| email | MdP |
|-------|-----|
| admin@enpc.org | test |

## Remplissage de la base de données
Le script `db_fill.py` rempli la base de données avec des données de test.

Il utilise les librairies suivantes :
 - mysql-connector
 - prenoms

Attention, il faut vérifier que le port donné dans la fonction `generate_lines`
soit celui du conteneur mysql.

# Configuration du solveur
## Gurobi
Le solveur utilise [Gurobi](https://www.gurobi.com/) qui nécessite une licence.
Le KI possède un compte Gurobi, le MdP est sur le Bitwarden. Les licences pour
les conteneurs doivent être gérées depuis le [*Web license
service*](https://www.gurobi.com/web-license-service/). C'est depuis ce site
que l'on peut ralonger la durée de la licence.

Pour que le solveur fonctionne, il faut télécharger la licence (fichier
`gurobi.lic`) et la placer dans le dossier `php/solver` *avant* de build les
conteneurs.
