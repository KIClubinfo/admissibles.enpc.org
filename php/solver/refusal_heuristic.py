import operator
import random
from data_conversion import json_to_objects_rooms, json_to_objects_requests,json_to_objects_attributions, dictionary_from_requests, dictionary_from_rooms
from local_solver import refusal_solver, compute_score
from import_data import fetch_data
from export_data import export
from params import parameters

print("========================================= PREPARING HEURISTIC ========================================")

print("Loading requests and rooms...")

demandes_to_json, chambres_to_json, attributions_to_json = fetch_data()

requests = json_to_objects_requests(demandes_to_json)
rooms = json_to_objects_rooms(chambres_to_json)
attributions = json_to_objects_attributions(attributions_to_json,requests,rooms)
print("Loaded attributions...")
requests.sort(key=operator.methodcaller('get_absolute_score', parameters), reverse=True)
random.shuffle(rooms)
requests_dictionary = dictionary_from_requests(requests)
rooms_dictionary = dictionary_from_rooms(rooms)

GROUP_SIZE = 40
n = 2000

requests_groups = []

for k, request in enumerate(requests):
    if k % GROUP_SIZE == 0:
        if k > 0:
            requests_groups.append(group)
        group = []
    group.append(request)
requests_groups.append(group)

number_of_groups = len(requests_groups)

ROOM_GROUPS_SIZE = len(rooms) // number_of_groups
room_groups = [[] for k in range(number_of_groups)]

room_index = 0
group_index = 0
capacity = 0
objective = 0
while room_index < len(rooms) and group_index < number_of_groups:
    if objective == 0:
        objective = len(requests_groups[group_index])

    if capacity < objective:
        room_groups[group_index].append(rooms[room_index])
        capacity += rooms[room_index].capacity
        room_index += 1
    else:
        objective = 0
        capacity = 0
        group_index += 1

print("Solving attributions")

attributions.sort(key=lambda attribution: attribution.request.demand_id)
attributions = refusal_solver(attributions, requests_dictionary, rooms_dictionary, n)

# save attributions in database
export(attributions)
