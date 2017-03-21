#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class AverageScoresData(Foundation):

	def formatNumber(self, number):
		return format(number, '.2f').rstrip('0').rstrip('.')

	def unformatNumber(self, string):
		return float(string.rstrip('%'))

	def getPercentCondition(self, teamNumber, section, value, condition):
		if teamNumber not in self.data:
			return ""
		total = 0;
		conditionCount = 0;
		for document in self.data[teamNumber]:
			total = total+1
			if document["GameInformation"][section][value] == condition:
				conditionCount = conditionCount+1
		return self.formatNumber((conditionCount/float(total))*100) + "%"

	def getAverageNum(self, teamNumber, section, value):
		if teamNumber not in self.data:
			return ""
		total = 0;
		num = 0;
		for document in self.data[teamNumber]:
			total = total+1
			num = num + document["GameInformation"][section][value]
		return self.formatNumber(num/float(total))
				
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)

		self.data = {}
		teamNumbers = self.UniqueTeamList()
		for document in self.collection.find({'MetaData.MetaData': 'MatchInput'}):
			if str(document["MatchInformation"]["TeamNumber"]) not in self.data:
				self.data[str(document["MatchInformation"]["TeamNumber"])] = []
			self.data[str(document["MatchInformation"]["TeamNumber"])].append(document)

		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "AverageScoresData"
		finalDictionary["MetaData"]["TimeStamp"] = "anytime"
		finalDictionary["MetaData"]["DatePlace"] = collectionName
		finalDictionary["MetaData"]["InputID"] = "pi"
		finalDictionary["AverageScores"] = {};
		
		for teamNumber in teamNumbers:
			teamNumber = str(teamNumber)

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)] = {}
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["TeamNumber"] = teamNumber
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"] = {}

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"] =  {}
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"] = {}
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["NoParking"] = self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Did Not Park")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["PartiallyCenter"] = self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Partially Center")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["PartiallyCorner"] = self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Partially Corner")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["FullyCenter"] = self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Fully Center")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["FullyCorner"] = self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Fully Corner")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["CenterParticles"] = self.getAverageNum(teamNumber, "AUTO", "ParticlesCenter")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["CornerParticles"] = self.getAverageNum(teamNumber, "AUTO", "ParticlesCorner")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["CapBall"] = self.getPercentCondition(teamNumber, "AUTO", "CapBall", "Yes")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Beacons"] = self.getAverageNum(teamNumber, "AUTO", "ClaimedBeacons")

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["DRIVER"] = {}
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["DRIVER"]["CenterParticles"] = self.getAverageNum(teamNumber, "DRIVER", "ParticlesCenter")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["DRIVER"]["CornerParticles"] = self.getAverageNum(teamNumber, "DRIVER", "ParticlesCorner")

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"] = {}
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["Beacons"] = self.getAverageNum(teamNumber, "END", "AllianceClaimedBeacons")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"] = {}
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"]["CapBallOnFloor"] = self.getPercentCondition(teamNumber, "END", "CapBall", "On The Ground")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"]["CapBallRaised"] = self.getPercentCondition(teamNumber, "END", "CapBall", "Raised Off Floor")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"]["CapBallAboveCenter"] = self.getPercentCondition(teamNumber, "END", "CapBall", "Raised Above Vortex")
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"]["CapBallInCenter"] = self.getPercentCondition(teamNumber, "END", "CapBall", "In Center Vortex")

			if teamNumber not in self.data:
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageScore"] = ""
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] = ""
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] = ""
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] = ""
				continue
			
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] = 0
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["PartiallyCenter"])/100 * 5
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["PartiallyCorner"])/100 * 5
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["FullyCenter"])/100 * 10
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Parking"]["FullyCorner"])/100 * 10
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["CenterParticles"]) * 15
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["CornerParticles"]) * 5
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["CapBall"])/100 * 5
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AUTO"]["Beacons"]) * 30

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] = 0
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["DRIVER"]["CenterParticles"]) * 5
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["DRIVER"]["CornerParticles"]) * 1

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] = 0
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["Beacons"]) * 10
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"]["CapBallRaised"])/100 * 10
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"]["CapBallAboveCenter"])/100 * 20
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] += self.unformatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["END"]["CapBall"]["CapBallInCenter"])/100 * 40

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageScore"] = self.formatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] + finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] + finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"])
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] = self.formatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"])
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] = self.formatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"])
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] = self.formatNumber(finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"])

		self.collection.delete_many({'MetaData.MetaData': 'AverageScoresData'})
		self.collection.insert_one(finalDictionary)
		for document in self.collection.find({'MetaData.MetaData': 'AverageScoresData'}):
			#pprint(document)
			pass
			
if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = AverageScoresData("Y201702255")