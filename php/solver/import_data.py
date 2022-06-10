import mysql.connector
import os


def fetch_data(serie = 1):
    # getting environmnent variables
    MYSQL_DATABASE = os.getenv("MYSQL_DATABASE")
    MYSQL_USER = os.getenv("MYSQL_USER")
    MYSQL_PASSWORD = os.getenv("MYSQL_PASSWORD")

    # opening connection to database
    cnx = mysql.connector.connect(user=MYSQL_USER, password=MYSQL_PASSWORD, host='db', database=MYSQL_DATABASE)
    cursor = cnx.cursor()

    # fetching demands
    cursor.execute("SELECT * FROM demande INNER JOIN eleves ON demande.id_eleve = eleves.id  WHERE demande.arrival_date IN (SELECT s.arrival_date FROM serie s WHERE s.id_serie =  " + str(serie) + " )")
    demandes=cursor.fetchall()
    demandes_to_json = []
    for demande in demandes:
        demande_to_json = {}
        for field in range(len(cursor.description)):
            demande_to_json[str(cursor.description[field][0])] = demande[field]
        demandes_to_json.append(demande_to_json)

    # fetching rooms
    cursor.execute("SELECT * FROM chambre")
    chambres=cursor.fetchall()
    chambres_to_json = []
    for chambre in chambres:
        chambre_to_json = {}
        for field in range(len(cursor.description)):
            chambre_to_json[str(cursor.description[field][0])] = chambre[field]
        chambres_to_json.append(chambre_to_json)

    # closing connection
    cnx.close()

    return demandes_to_json, chambres_to_json
