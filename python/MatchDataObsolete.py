#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class MatchData(Foundation):
		
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)
		print '-----MATCH DATA-----'

		teamList = self.UniqueTeamList()
		matchesThatTeamPlayedAndAlliance = self.WhichMatchesDidThatTeamPlayAndWhatAlliance(teamList)
		
		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "MatchData"
		finalDictionary["MetaData"]["TimeStamp"] = 7
		finalDictionary["MetaData"]["DatePlace"] = collectionName
		finalDictionary["MetaData"]["InputID"] = "Data"
		finalDictionary["MatchHistory"] = {}
		
		for team in teamList:
			tempBlue = matchesThatTeamPlayedAndAlliance[team]["Blue"]
			tempRed = matchesThatTeamPlayedAndAlliance[team]["Red"]
			finalDictionary["MatchHistory"]["TeamNumber" + str(team)] = {}
			for matchNumber in tempBlue:
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["TeamNumber"] = team
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["MatchNumber"] = matchNumber
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["Alliance"] = "Blue"
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"] = {}
				
				cursorResults = self.collection.find({'MetaData.MetaData' : 'ResultsInput', "ResultsInformation.MatchNumber" : matchNumber })
				if (cursorResults.count() > 0):
					documentResults = cursorResults[0]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["ResultRed"] = documentResults["Score"]["Total"]["Red"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["ResultBlue"] = documentResults["Score"]["Total"]["Blue"]

				cursorResults = self.collection.find({'MetaData.MetaData' : 'MatchInput', "MatchInformation.MatchNumber" : matchNumber, "MatchInformation.TeamNumber" : team })
				if (cursorResults.count() > 0):
					documentResults = cursorResults[0]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["Parking"] = documentResults["GameInformation"]["AUTO"]["RobotParking"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CenterParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CornerParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCorner"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CapBall"] = documentResults["GameInformation"]["AUTO"]["CapBall"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["Beacons"] = documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"]["CenterParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"]["CornerParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"]["Beacons"] = documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"]["CapBall"] = documentResults["GameInformation"]["END"]["CapBall"]

					score = 0
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Partially Center":
						score += 5
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Partially Corner":
						score += 5
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Fully Center":
						score += 10
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Fully Corner":
						score += 10
					score += (documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]*15) + (documentResults["GameInformation"]["AUTO"]["ParticlesCorner"]*5)
					if documentResults["GameInformation"]["AUTO"]["CapBall"] == "Yes":
						score += 5
					score += (documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]*30)
					score += (documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]*5)
					score += (documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"])
					if documentResults["GameInformation"]["END"]["CapBall"] == "Raised Off  Floor":
						score += 10
					if documentResults["GameInformation"]["END"]["CapBall"] == "Raised Above Vortex":
						score += 20
					if documentResults["GameInformation"]["END"]["CapBall"] == "In Center Vortex":
						score += 40
					score += (documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]*10)
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["Score"] = score
					
			for matchNumber in tempRed:
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["TeamNumber"] = team
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["MatchNumber"] = matchNumber
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["Alliance"] = "Red"
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"] = {}
				finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"] = {}

				cursorResults = self.collection.find({'MetaData.MetaData' : 'ResultsInput', "ResultsInformation.MatchNumber" : matchNumber})
				if (cursorResults.count() > 0):
					documentResults = cursorResults[0]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["ResultRed"] = documentResults["Score"]["Total"]["Red"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["ResultBlue"] = documentResults["Score"]["Total"]["Blue"]

				cursorResults = self.collection.find({'MetaData.MetaData' : 'MatchInput', "MatchInformation.MatchNumber" : matchNumber, "MatchInformation.TeamNumber" : team })
				if (cursorResults.count() > 0):
					documentResults = cursorResults[0]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["Parking"] = documentResults["GameInformation"]["AUTO"]["RobotParking"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CenterParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CornerParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCorner"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CapBall"] = documentResults["GameInformation"]["AUTO"]["CapBall"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["Beacons"] = documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"]["CenterParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"]["CornerParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"]["Beacons"] = documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"]["CapBall"] = documentResults["GameInformation"]["END"]["CapBall"]

					score = 0
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Partially Center":
						score += 5
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Partially Corner":
						score += 5
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Fully Center":
						score += 10
					if documentResults["GameInformation"]["AUTO"]["RobotParking"] == "Fully Corner":
						score += 10
					score += (documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]*15) + (documentResults["GameInformation"]["AUTO"]["ParticlesCorner"]*5)
					if documentResults["GameInformation"]["AUTO"]["CapBall"] == "Yes":
						score += 5
					score += (documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]*30)
					score += (documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]*5)
					score += (documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"])
					if documentResults["GameInformation"]["END"]["CapBall"] == "Raised Off Floor":
						score += 10
					if documentResults["GameInformation"]["END"]["CapBall"] == "Raised Above Vortex":
						score += 20
					if documentResults["GameInformation"]["END"]["CapBall"] == "In Center Vortex":
						score += 40
					score += (documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]*10)
					finalDictionary["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["Score"] = score
		
		self.collection.delete_many({"MetaData.MetaData": "MatchData"})
		self.collection.insert_one(finalDictionary)
		#pprint(finalDictionary)
	
if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = MatchData("Y201702255")