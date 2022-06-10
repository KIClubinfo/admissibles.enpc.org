import mysql.connector
import os


def export(attributions):
    # getting environmnent variables
    MYSQL_DATABASE = os.getenv("MYSQL_DATABASE")
    MYSQL_USER = os.getenv("MYSQL_USER")
    MYSQL_PASSWORD = os.getenv("MYSQL_PASSWORD")

    # opening connection to database
    cnx = mysql.connector.connect(user=MYSQL_USER, password=MYSQL_PASSWORD, host='db', database=MYSQL_DATABASE)
    cursor = cnx.cursor()

    # saving attributions in database
    for attribution in attributions:
        cursor.execute("SELECT * FROM demande WHERE id_demande = {}".format(attribution.request.demand_id))
        demande=cursor.fetchall()[0]
        demande_to_json = {}
        for field in range(len(cursor.description)):
            demande_to_json[str(cursor.description[field][0])] = demande[field]
        operation = "INSERT INTO `reservation` (`id_eleves`, `numero_chambre`, `date_arrivee`, `date_depart`) VALUES (%s, %s, %s, %s)"
        values = (demande_to_json["id_eleve"], attribution.room.room_id, demande_to_json["arrival_date"], demande_to_json["departure_date"])
        cursor.execute(operation, values)

    # closing connection
    cnx.commit()
    cnx.close()

    return 0
