#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint

client = MongoClient()
db = client.TheOrangeAlliance
if (not "GameObjectives" in db.collection_names()):
	db.create_collection("GameObjectives")
collection = db.GameObjectives

velocityVortex = {
	"MetaData": {"MetaData": "GameObjectives"},
	"SeasonInfo": {
		"Season": "2016-2017",
		"Name": "Velocity Vortex"
	},
	"Scoring": {
		"AUTO": {
			"Parking": {
				"Type": "String",
				"Options": {"NoParking": 0, "PartiallyCenter": 5, "PartiallyCorner": 5, "FullyCenter": 10, "FullyCorner": 10},
				"Default": "NoParking" #Always the option worth zero points
			},
			"CenterParticles": {
				"Type": "Number",
				"Points": 15
			},
			"CornerParticles": {
				"Type": "Number",
				"Points": 5
			},
			"Beacons": {
				"Type": "Number",
				"Points": 30
			},
			"CapBall": {
				"Type": "YesNo", #This implies that the two possible options are "Yes" (worth specified points) and "No" (0 points)
				"Points": 5
			}
		},
		"DRIVER": {
			"CenterParticles": {
				"Type": "Number",
				"Points": 5
			},
			"CornerParticles": {
				"Type": "Number",
				"Points": 1
			}
		},
		"END": {
			"CapBall": {
				"Type": "String",
				"Options": {"CapBallOnFloor": 0, "CapBallRaised": 10, "CapBallAboveCenter": 20, "CapBallInCenter": 40},
				"Default": "CapBallOnFloor" #Always the option worth zero points
			},
			"Beacons": {
				"Type": "Number",
				"Points": 10
			}
		}
	},
	"DisplayOrder": { #This is necessary because dictionaries do not care about order. Arrays are used to specify the order.
		"Fields": {
			"AUTO" : ["Parking", "CenterParticles", "CornerParticles", "CapBall", "Beacons"],
			"DRIVER": ["CenterParticles", "CornerParticles"],
			"END": ["Beacons", "CapBall"]
		},
		"Options": {
			"AUTO" : {
				"Parking": ["NoParking", "PartiallyCenter", "PartiallyCorner", "FullyCenter", "FullyCorner"]
			},
			"DRIVER": {},
			"END": {
				"CapBall": ["CapBallOnFloor", "CapBallRaised", "CapBallAboveCenter", "CapBallInCenter"]
			}
		}
	},
	"DisplayNames": { #Specifies names to be displayed on the website
		"Fields": {
			"AUTO": {
				"Parking": "Parking",
				"CenterParticles": "Center Particles",
				"CornerParticles": "Corner Particles",
				"CapBall": "Cap Ball",
				"Beacons": "Beacons"
			},
			"DRIVER": {
				"CenterParticles": "Center Particles",
				"CornerParticles": "Corner Particles"
			},
			"END": {
				"Beacons": "Beacons",
				"CapBall": "Cap Ball"
			}
		},
		"Options": {
			"AUTO": {
				"Parking": {
					"NoParking": "Did Not Park",
					"PartiallyCenter": "Partially Center",
					"PartiallyCorner": "Partially Corner",
					"FullyCenter": "Fully Center",
					"FullyCorner": "Fully Corner"
				},
				"CapBall": { #This is where "Yes" and "No" can be translated to mean something else, if need be, such as "On" and "Off"
					"Yes": "Yes",
					"No": "No"
				}
			},
			"DRIVER": {},
			"END": {
				"CapBall": {
					"CapBallOnFloor": "On The Ground",
					"CapBallRaised": "Raised Off Floor",
					"CapBallAboveCenter": "Raised Above Vortex",
					"CapBallInCenter": "In Center Vortex"
				}
			}
		}
	}
}
collection.delete_many({'MetaData.MetaData': 'GameObjectives', 'SeasonInfo.Season': '2016-2017'})
collection.insert_one(velocityVortex)

for document in collection.find({'MetaData.MetaData': 'GameObjectives'}):
	pprint(document)
	#pass