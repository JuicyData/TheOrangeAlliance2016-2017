#! /usr/bin/python

#TODO Figure out how the whole thing works and draw a diagram. Then fix discontinuities.

import pymongo
from pymongo import MongoClient
from pprint import pprint

client = MongoClient()
db = client.TheOrangeAlliance
gameObjectives = None
for document in db.GameObjectives.find({'MetaData.MetaData': 'GameObjectives', 'SeasonInfo.Season': '2016-2017'}):
	gameObjectives = document
	break

fields = {
	"AUTO": {
		"Parking": "RobotParking",
		"CenterParticles": "ParticlesCenter",
		"CornerParticles": "ParticlesCorner",
		"CapBall": "CapBall",
		"Beacons": "ClaimedBeacons"
	},
	"DRIVER": {
		"CenterParticles": "ParticlesCenter",
		"CornerParticles": "ParticlesCorner"
	},
	"END": {
		"Beacons": "AllianceClaimedBeacons",
		"CapBall": "CapBall"
	}
}

options = {
	"AUTO": {
		"Parking": {
			"No Parking": "NoParking",
			"Did Not Park": "NoParking",
			"Partially Center": "PartiallyCenter",
			"Partially Corner": "PartiallyCorner",
			"Fully Center": "FullyCenter",
			"Fully Corner": "FullyCorner"
		},
		"CapBall": {
			"Yes": "Yes",
			"No": "No"
		}
	},
	"DRIVER": {},
	"END": {
		"CapBall": {
			"On The Ground": "CapBallOnFloor",
			"Raised Off Floor": "CapBallRaised",
			"Raised Above Vortex": "CapBallAboveCenter",
			"In Center Vortex": "CapBallInCenter"
		}
	}
}

docs =  []

for cname in ["Y201702255", "Y201702255Raw"]:
	c = eval("db."+cname)
	rawr = ""
	if cname[-3:] == "Raw":
		rawr = "Raw"
	for odocument in c.find({"MetaData.MetaData": "MatchInput"+rawr}):
		document = odocument.copy()
		for gamePeriod in gameObjectives["DisplayOrder"]["Fields"]:
			for field in gameObjectives["DisplayOrder"]["Fields"][gamePeriod]:
				if not field == fields[gamePeriod][field]:
					document["GameInformation"][gamePeriod][field] = document["GameInformation"][gamePeriod][fields[gamePeriod][field]]
					del document["GameInformation"][gamePeriod][fields[gamePeriod][field]]
				if gameObjectives["Scoring"][gamePeriod][field]["Type"] == "String":
					document["GameInformation"][gamePeriod][field] = options[gamePeriod][field][document["GameInformation"][gamePeriod][field]]
		docs.append(document)

	if not rawr:
		for odocument in c.find({"MetaData.MetaData": "MatchOutput"}):
			document = odocument.copy()
			document["MetaData"]["Season"] = "2016-2017"
			for gamePeriod in gameObjectives["DisplayOrder"]["Fields"]:
				for field in gameObjectives["DisplayOrder"]["Fields"][gamePeriod]:
					if gameObjectives["Scoring"][gamePeriod][field]["Type"] == "String":
						for team in document["MatchHistory"].keys():
							for match in document["MatchHistory"][team].keys():
								for alliance in document["MatchHistory"][team][match].keys():
									if document["MatchHistory"][team][match][alliance][gamePeriod]:
										document["MatchHistory"][team][match][alliance][gamePeriod][field] = options[gamePeriod][field][document["MatchHistory"][team][match][alliance][gamePeriod][field]]
			docs.append(document)
		c.delete_many({"MetaData.MetaData": "MatchOutput"})

	c.delete_many({"MetaData.MetaData": "MatchInput"+rawr})
	for doc in docs:
		c.insert_one(doc)
		pprint(doc)






