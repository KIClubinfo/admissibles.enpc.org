# admissible logement
Site pour l'attribution des chambres de Meunier aux admissibles, pour leurs oraux.

# Configuration des emails

## SendGrid et emails config

Pour envoyer des e-mails, on utilise l'API de [SendGrid](https://sendgrid.com/) qui nécéssite une configuration particulière. Rendez-vous tout d'abord sur le site [https://sendgrid.com/](https://sendgrid.com/). Après connexion à votre compte, autorisez un _sender_ ou un _domain_ et créez une API-KEY si vous n'en avez pas déjà une. Copiez l'API-KEY et **conservez la précieusement**.

  

Remplissez ensuite vos informations dans le fichier  [config.php](/php/config.php).  en précisant les champs :

*  `SENDGRID_API_KEY` : l'API-KEY SendGrid généré précédamment;

*  `EMAIL_SENDER` : l'email d'envoie (qui doit être autorisé au préalable sur [SendGrid](https://sendgrid.com/) );

*  `NAME_SENDER` : le nom de l'expediteur (qui apparaitra dans la boite mail) ;

*  `EMAIL_REPLY` : l'email de réception (qui doit être autorisé au préalable sur [SendGrid](https://sendgrid.com/) );

*  `NAME_REPLY` : le nom associé à l'email de récéption (qui apparaitra dans la boite mail).

  

## SendGrid install

Une fois le Docker-compose up, il faut installer les dépendances SendGrid. Pour ce faire, accédez au shell du Docker en entrant la commande `docker exec -it admissibles_php_74 /bin/bash` (le nom du Docker _admissibles_php_74_ peut varier). Une fois dans la console, vérifiez que vous vous situez dans `/var/www/html`.

  

Pour installer SendGrid, nous allons utiliser [Composer](https://getcomposer.org/). Pour l'installer, executez dans le shell du Docker le script [composer_install.sh](/php/composer_install.sh) avec la commande `bash ./composer_install.sh`. Finalement, executez la commande `php ./composer.phar update`.

## SendGrid test
Pour tester si tout fonctionne bien, modifiez tout d'abord les variables `$receiver_email` et `$receiver_name` du fichier  [send_first_email.php](/php/send_first_email.php). Il vous suffit finalement de l’exécuter dans un navigateur en accédant à l'URL [http://localhost:8123/send_first_email.php](http://localhost:8123/send_first_email.php).

Si vous avez reçu un e-mail de la part de `EMAIL_SENDER` à l'adresse `$receiver_email`, c'est que tout fonctionne ;) !


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
