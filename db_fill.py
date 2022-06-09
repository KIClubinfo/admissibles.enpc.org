import mysql.connector
import os
import random as rand
import prenoms
import string
from datetime import datetime, date, timedelta

def delete_and_restore_just_admin():
    # Supprime toutes les lignes et remet uniquement la ligne de l'admin dans eleves.

    # Pour savoir quoi renseigner dans "port", faire un "docker ps" et regarder dans "port" pour
    # l'image "mysql:8.0.20". Prendre celui qui precede "O.O.O.O:"
    connection = mysql.connector.connect(host='localhost',
                                         port=6036,
                                         database='admissibles',
                                         user='root',
                                         password='NotSecretPassword')

    delete_all_chambre = "DELETE FROM chambre;"
    delete_all_demande = "DELETE FROM demande;"
    delete_all_eleves = "DELETE FROM eleves;"
    delete_all_reservation = "DELETE FROM reservation;"
    reset_auto_increment_chambre = "ALTER TABLE chambre AUTO_INCREMENT = 1;"
    reset_auto_increment_demande = "ALTER TABLE demande AUTO_INCREMENT = 1;"
    reset_auto_increment_eleves = "ALTER TABLE eleves AUTO_INCREMENT = 1;"
    add_admin = "INSERT INTO eleves (id, prenom, nom, gender, password, mail, tel, distance, boursier, admin, a_reserve, change_password, activation_code) " \
                         "VALUES (1, 'admin', 'admin', 3, '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'admin@enpc.org', '00000000', 0, 0, 1, 0, 'no', 'activated')"

    cursor = connection.cursor()
    cursor.execute(delete_all_chambre)
    cursor.execute(delete_all_demande)
    cursor.execute(delete_all_eleves)
    cursor.execute(delete_all_reservation)
    cursor.execute(reset_auto_increment_chambre)
    cursor.execute(reset_auto_increment_demande)
    cursor.execute(reset_auto_increment_eleves)
    cursor.execute(add_admin)
    connection.commit()

def random_dates():
    # Genere de facon "coherente" des dates et heures d'arrivee et de depart et une date de realisation de demande,
    # dans le bon format

    # Initializing start date
    beginning_of_inscriptions = date(2021, 6, 14)

    # Arrival date
    arr_date = beginning_of_inscriptions + timedelta(days=rand.randint(0, 30))
    res_arr_date = arr_date.strftime("%Y-%m-%d")

    # Departure date
    dep_date = arr_date + timedelta(days=rand.randint(0, 2))
    res_dep_date = dep_date.strftime("%Y-%m-%d")

    # Heures
    if (dep_date == arr_date):
        arr_hour = rand.randint(0, 22)
        dep_hour = rand.randint(arr_hour, 23)
    else:
        arr_hour = rand.randint(0, 23)
        dep_hour = rand.randint(0, 23)

    # Minutes
    arr_min = rand.randint(0, 59)
    dep_min = rand.randint(0, 59)

    arr_hour_min = str(arr_hour).rjust(2, "0") + ":" + str(arr_min).rjust(2, "0")
    dep_hour_min = str(dep_hour).rjust(2, "0") + ":" + str(dep_min).rjust(2, "0")

    # Date de demande
    # On doit mettre une date de demande anterieure a la date d'arrivee
    nb_jours_entre_demande_arrivee = rand.randint(0, 15)
    demand_date = max(arr_date - timedelta(days=nb_jours_entre_demande_arrivee), beginning_of_inscriptions)
    if (demand_date == arr_date) :
        demand_hour = rand.randint(0, arr_hour)
        if (demand_hour == arr_hour) :
            demand_min = rand.randint(0, arr_min)
        else:
            demand_min = rand.randint(0, 59)
    else:
        demand_hour = rand.randint(0, 23)
        demand_min = rand.randint(0, 59)

    pre_demand_time = datetime(demand_date.year, demand_date.month, demand_date.day, demand_hour, demand_min)
    demand_time = (pre_demand_time-datetime(1970,1,1)).total_seconds()
    # La date demande en secondes depuis le 1er janvier 1970

    return(res_arr_date, arr_hour_min, res_dep_date, dep_hour_min, demand_time)

def requetes_chambres(nb):
    liste_queries = []
    liste_chambre = []
    while (len(liste_chambre) < nb):
        etage = rand.randint(0, 3)
        deux_derniers_num = rand.randint(1, 50)
        numero = 100*etage + deux_derniers_num
        if (not (numero in liste_chambre)):
            liste_chambre.append(numero)
    for numero in liste_chambre:
        type = rand.randint(1, 3)
        query = "INSERT INTO chambre (numero, type) VALUES (%d, %d);"%(numero, type)
        liste_queries.append(query)
    return liste_queries

def requetes_eleves_demandes(nb_eleves, nb_demandes_simples, nb_demandes_paires):
    if (nb_eleves<(nb_demandes_simples + 2*nb_demandes_paires)):
        raise("les nombres demandes sont incoherents")

    liste_queries_eleve = []
    liste_queries_demande = []
    liste_mails = []

    liste_eleves = []

    # Les eleves
    for i in range(2, nb_eleves+2):
        id = i
        prenom_nom = prenoms.get_nom_complet().split(" ")
        while(len(prenom_nom)!=2) :
            prenom_nom = prenoms.get_nom_complet().split(" ")
        prenom, nom = tuple(prenom_nom)
        gender = rand.randint(1, 3)
        password = "password"
        # === mail ===
        mail = prenom + "." + nom + "@gmail.com"
        num_mail=1
        while (mail in liste_mails) :
            num_mail +=1
            mail = prenom + "." + nom + str(num_mail) + "@gmail.com"
        # ======
        tel = "06"
        for k in range(8) :
            tel += str(rand.randint(0, 9))
        distance = rand.randint(5, 650) # Entre 5 et 650km parce que why not
        boursier = rand.randint(0, 1)
        admin = 0
        a_reserve = 0
        change_password = "no"
        activation_code = ''.join(rand.SystemRandom().choice(string.ascii_lowercase + string.digits) for _ in range(13))
        liste_eleves.append([id, prenom, nom, gender, password, mail, tel, distance, boursier, admin, a_reserve, change_password, activation_code])

    # Les demandes
    ids = [i for i in range(2, nb_eleves + 2)]  # Liste des ids d'eleves
    rand.shuffle(ids)  # On les melange pour eviter que tous les eleves voulant etre seuls soient en premier, puis ceux vouant etre par deux...

    # Les demandes simples
    for i in range(nb_demandes_simples):
        # id_demande = NULL
        id_eleve = ids.pop()  # Un eleve au hasard
        # === On indique que cet eleve a reserve ===
        liste_eleves[id_eleve-2][10] = 1
        # ======
        type_chambre = rand.randint(1, 3)
        remplace = rand.randint(0, 1)  # Peut-etre plus realiste de mettre une loi binomiale avec p=0.9...
        gender_choice = rand.randint(0, 1)
        arrival_date, arrival_time, departure_date, departure_time, demand_time = random_dates()
        mate = 0
        mate_email = "NULL"
        validee = 0
        demande_query="INSERT INTO demande (id_demande, id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee, demand_time)" \
                      "VALUES (NULL, %d, %d, %d, %d, '%s', '%s', '%s', '%s', %d, %s, %d, %d);"%(id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee, demand_time)
        liste_queries_demande.append(demande_query)

    # Les demandes par paires
    for i in range(nb_demandes_paires):
        # L'eleve 1
        id_eleve_1 = ids.pop()
        # === On indique que cet eleve a reserve ===
        liste_eleves[id_eleve_1 - 2][10] = 1
        # ======
        mail_eleve_1 = liste_eleves[id_eleve_1-2][5]
        genre_eleve_1 = liste_eleves[id_eleve_1-2][3]
        # Pour rappel, "gender_choice" est le genre avec lequel l'eleve ne veut pas etre, donc on mettre un 1 + %2 pour inverser

        # L'eleve 2
        id_eleve_2 = ids.pop()
        # === On indique que cet eleve a reserve ===
        liste_eleves[id_eleve_2 - 2][10] = 1
        # ======
        mail_eleve_2 = liste_eleves[id_eleve_2 - 2][5]
        genre_eleve_2 = liste_eleves[id_eleve_2 - 2][3]

        # criteres communs aux deux demandes
        type_chambre = rand.randint(1, 3)
        remplace = rand.randint(0, 1)  # Peut-etre pus realiste de mettre une loi binomiale avec p=0.9...
        arrival_date, arrival_time, departure_date, departure_time, demand_time = random_dates()  # On fait une simplification ici...
        mate = 1
        validee = 0

        # La demande de l'eleve 1
        demande_query="INSERT INTO demande (id_demande, id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee, demand_time)" \
                      "VALUES (NULL, %d, %d, %d, %d, '%s', '%s', '%s', '%s', %d, '%s', %d, %d);"%(id_eleve_1, type_chambre, remplace, 1 + genre_eleve_2%2, arrival_date, arrival_time, departure_date, departure_time, mate, mail_eleve_2, validee, demand_time)
        liste_queries_demande.append(demande_query)

        # La demande de l'eleve 2
        demande_query = "INSERT INTO demande (id_demande, id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee, demand_time)" \
                        "VALUES (NULL, %d, %d, %d, %d, '%s', '%s', '%s', '%s', %d, '%s', %d, %d);"%(id_eleve_2, type_chambre, remplace, 1 + genre_eleve_1%2, arrival_date, arrival_time, departure_date,departure_time, mate, mail_eleve_1, validee, demand_time)
        liste_queries_demande.append(demande_query)

    for i in range(nb_eleves):
        eleve_query = "INSERT INTO eleves (id, prenom, nom, gender, password, mail, tel, distance, boursier, admin, a_reserve, change_password, activation_code) " \
                      "VALUES (%d, '%s', '%s', %d, '%s', '%s', '%s', %d, %d, %d, %d, '%s', '%s');"%tuple(liste_eleves[i])
        liste_queries_eleve.append(eleve_query)

    return liste_queries_eleve, liste_queries_demande

def generate_lines(nb_chambres, nb_eleves, nb_demandes_simples, nb_demandes_paires):
    # On indique le nombre de chambres, d'eleves et de demandes simples pour par paires d'eleves vouant etre ensemble
    # La fonction genere alors le bon nombre de lignes, de facon a peu pres coherente avec qq simplifications.

    delete_and_restore_just_admin()

    try:
        # Pour savoir quoi renseigner dans "port", faire un "docker ps" et regarder dans "port" pour
        # l'image "mysql:8.0.20". Prendre celui qui precede "O.O.O.O:"
        connection = mysql.connector.connect(host='localhost',
                                             port=6036,
                                             database='admissibles',
                                             user='root',
                                             password='NotSecretPassword')

        liste_queries_chambre = requetes_chambres(nb_chambres)
        liste_queries_eleve, liste_queries_demande = requetes_eleves_demandes(nb_eleves, nb_demandes_simples, nb_demandes_paires)

        cursor = connection.cursor()
        for query in liste_queries_chambre:
            cursor.execute(query)
        for query in liste_queries_eleve:
            cursor.execute(query)
        for query in liste_queries_demande:
            cursor.execute(query)
        connection.commit()
        print(cursor.rowcount, "Record inserted successfully into Laptop table")
        cursor.close()

    except mysql.connector.Error as error:
        print("Failed to insert record into Laptop table {}".format(error))

    finally:
        if connection.is_connected():
            connection.close()
            print("MySQL connection is closed")

generate_lines(100, 500, 300, 75)
# Il se peut que le programme plante parce qu'un des noms contient une apostrophe.
# Dans ce cas, relancer le programme jusqu'à ce que ça n'arrive pas...
