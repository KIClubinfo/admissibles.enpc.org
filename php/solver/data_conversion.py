from objects import Request, Room, Attribution


def dictionary_from_requests(requests):
    requests_dictionary = {}
    for request in requests:
        requests_dictionary[str(request.demand_id)] = request
    return requests_dictionary


def dictionary_from_rooms(rooms):
    rooms_dictionary = {}
    for room in rooms:
        rooms_dictionary[str(room.room_id)] = room
    return rooms_dictionary


def json_to_objects_requests(requests_raw):
    """
    Converts a json database into a list of python "Request" objects. Conventions on encoding are converted from those
    of the database to those of the python classes; see the classes documentation for details.
    :param requests_file: a json containing the inner join of 'demande' and 'eleve'.
    :return: the list of Request python objects created from the json file.
    """
    requests_list = []
    nb_requests = len(requests_raw)
    print("Nombre de demandes :", nb_requests )

    # Work out shotgun ranks
    demand_times = [(demand_id, int(requests_raw[demand_id]["demand_time"])) for demand_id in range(nb_requests)]
    demand_times.sort(key=lambda time: time[1])
    shotgun_ranks = [0 for _ in range(nb_requests)]
    for rank in range(nb_requests):
        demand_id = demand_times[rank][0]
        shotgun_ranks[demand_id] = rank

    gender_convention_conversion = [1, -1, 0]

    for (request_i, request) in enumerate(requests_raw):
        demand_id = int(request["id_demande"])
        gender = gender_convention_conversion[int(request["gender"]) - 1]
        scholarship = bool(int(request["boursier"]))
        distance = int(request["distance"])
        prefered_room_type = int(request["type_chambre"]) - 1
        accept_other_type = bool(int(request["remplace"]))
        shotgun_rank = shotgun_ranks[request_i]
        has_mate = bool(int(request["mate"]))
        mate_id = None
        if has_mate:
            mate_email = request["mate_email"]
            consistent_mate_request = False
            for other_resquest in requests_raw:
                if other_resquest["mail"] == mate_email:
                    consistent_mate_request = (
                            bool(int(other_resquest["mate"]))
                            and other_resquest["mate_email"] == request["mail"]
                    )
                    mate_id = int(other_resquest["id_demande"])
                    break
            has_mate = consistent_mate_request
            if not consistent_mate_request:
                mate_id = None

        request_object = Request(demand_id, gender, scholarship, distance, prefered_room_type, accept_other_type,
                                 has_mate, mate_id, shotgun_rank)
        requests_list.append(request_object)

    return requests_list


def json_to_objects_rooms(rooms_raw):
    """
    Converts a json database into a list of python "Room" objects. Conventions on encoding are converted from those
    of the database to those of the python classes; see the classes documentation for details.
    :param requests_file: a json containing the content of the "room" database.
    :return: the list of Room python objects created from the json file.
    """
    rooms_list = [Room(int(room["numero"]), int(room["type"]) - 1) for room in rooms_raw]
    return rooms_list
    
def json_to_objects_attributions(attributions_raw,requests,rooms):
    """
    Converts a json database into a list of python "Attribution" objects. Conventions on encoding are converted from those
    of the database to those of the python classes; see the classes documentation for details.
    :param attributions_raw: a json containing content of the reservation database.
    	   requests:the list of Request python returned by json_to_objects_requests
    	   requests:the list of Rooms python returned by json_to_objects_rooms
    :return: the list of Attribution python objects created from the json file.
    """
    attributions_list = []

    for(attribution_i, attribution) in enumerate(attributions_raw):
        request_id = int(attribution["id_demande"])
        for request_temp in requests:
            if request_temp.demand_id == request_id :
                request = request_temp
        room_number = int(attribution["numero_chambre"])
        
        for room_temp in rooms:
            if room_temp.room_id == room_number :
                room = room_temp
        
        if attribution["mate_id"] == None:
            mate_id = None
        else:
            print(attribution["mate_id"])
            mate_id = int(attribution["mate_id"])

        attribution_object = Attribution(request, room, mate_id)
        attributions_list.append(attribution_object)

    return attributions_list
