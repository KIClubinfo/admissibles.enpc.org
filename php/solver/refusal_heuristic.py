import operator
import random
from data_conversion import json_to_objects_rooms, json_to_objects_requests,json_to_objects_attributions, dictionary_from_requests, dictionary_from_rooms
from local_solver import refusal_solver, compute_score,list_of_rooms_not_full
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
requests_dictionary = dictionary_from_requests(requests)
rooms_dictionary = dictionary_from_rooms(rooms)


print("Solving attributions")

n = 2000

attributions.sort(key=lambda attribution: attribution.request.demand_id)

print(list_of_rooms_not_full(attributions,rooms_dictionary))

added_attributions = []	
new_attribution, attributions = refusal_solver(attributions, requests_dictionary, rooms_dictionary, n)

while(new_attribution != None):
	added_attributions.append(new_attribution)
	new_attribution, attributions = refusal_solver(attributions, requests_dictionary, rooms_dictionary, n)
print("Attributions : ", attributions)
print(added_attributions)


# save attributions in database
if added_attributions != []  :
	export(added_attributions)
