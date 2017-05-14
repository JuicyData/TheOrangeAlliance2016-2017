#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class AverageScoresData(Foundation):

	def formatNumber(self, number):
		return format(number, '.2f').rstrip('0').rstrip('.')

	def formatPercent(self, number):
		return format(number*100, '.2f').rstrip('0').rstrip('.') + "%"

	def getPercentCondition(self, teamNumber, section, value, condition):
		if teamNumber not in self.data:
			return ""
		total = 0;
		conditionCount = 0;
		for document in self.data[teamNumber]:
			total = total+1
			if document["GameInformation"][section][value] == condition:
				conditionCount = conditionCount+1
		return conditionCount/float(total)

	def getAverageNum(self, teamNumber, section, value):
		if teamNumber not in self.data:
			return ""
		total = 0;
		num = 0;
		for document in self.data[teamNumber]:
			total = total+1
			num = num + document["GameInformation"][section][value]
		return num/float(total)
				
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)
		print '-----AVERAGE SCORES DATA-----'

		self.data = {}
		teamNumbers = self.UniqueTeamList()
		for document in self.collection.find({'MetaData.MetaData': 'MatchInput'}):
			if str(document["MatchInformation"]["TeamNumber"]) not in self.data:
				self.data[str(document["MatchInformation"]["TeamNumber"])] = []
			self.data[str(document["MatchInformation"]["TeamNumber"])].append(document)

		season = self.Season()
		gameObjectives = self.GameObjectives(season)
		gameFields = gameObjectives["DisplayOrder"]["Fields"]

		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "AverageScoresData"
		finalDictionary["MetaData"]["TimeStamp"] = "anytime"
		finalDictionary["MetaData"]["DatePlace"] = collectionName
		finalDictionary["MetaData"]["Season"] = season
		finalDictionary["MetaData"]["InputID"] = "pi"
		finalDictionary["AverageScores"] = {};

		for teamNumber in teamNumbers:
			teamNumber = str(teamNumber)

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)] = {}
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["TeamNumber"] = teamNumber
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"] = {}

			averageScoresNumbers = {}

			for gamePeriod in gameFields:
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"][gamePeriod] = {}
				averageScoresNumbers[gamePeriod] = {}
				for field in gameFields[gamePeriod]:
					fieldType = gameObjectives["Scoring"][gamePeriod][field]["Type"]
					if fieldType == "String":
						finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"][gamePeriod][field] = {}
						averageScoresNumbers[gamePeriod][field] = {}
						for option in gameObjectives["DisplayOrder"]["Options"][gamePeriod][field]:
							averageScoresNumbers[gamePeriod][field][option] = self.getPercentCondition(teamNumber, gamePeriod, field, option)
							finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"][gamePeriod][field][option] = self.formatPercent(averageScoresNumbers[gamePeriod][field][option])
					elif fieldType == "Number":
						averageScoresNumbers[gamePeriod][field] = self.getAverageNum(teamNumber, gamePeriod, field)
						finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"][gamePeriod][field] = self.formatNumber(averageScoresNumbers[gamePeriod][field])
					elif fieldType == "YesNo":
						averageScoresNumbers[gamePeriod][field] = self.getPercentCondition(teamNumber, gamePeriod, field, "Yes")
						finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"][gamePeriod][field] = self.formatPercent(averageScoresNumbers[gamePeriod][field])

			if teamNumber not in self.data:
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageScore"] = ""
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] = ""
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] = ""
				finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] = ""
				continue
			
			averageScores = {}
			for gamePeriod in gameFields:
				averageScores[gamePeriod] = 0
				for field in gameFields[gamePeriod]:
					fieldType = gameObjectives["Scoring"][gamePeriod][field]["Type"]
					if fieldType == "String":
						for option in gameObjectives["DisplayOrder"]["Options"][gamePeriod][field]:
							averageScores[gamePeriod] += averageScoresNumbers[gamePeriod][field][option] * gameObjectives["Scoring"][gamePeriod][field]["Options"][option]
					elif fieldType == "Number" or fieldType == "YesNo":
						averageScores[gamePeriod] += averageScoresNumbers[gamePeriod][field] * gameObjectives["Scoring"][gamePeriod][field]["Points"]

			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageScore"] = self.formatNumber(averageScores["AUTO"] + averageScores["DRIVER"] + averageScores["END"])
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageAuto"] = self.formatNumber(averageScores["AUTO"])
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageDriver"] = self.formatNumber(averageScores["DRIVER"])
			finalDictionary["AverageScores"]["TeamNumber" + str(teamNumber)]["AverageScores"]["AverageEnd"] = self.formatNumber(averageScores["END"])

		self.collection.delete_many({'MetaData.MetaData': 'AverageScoresData'})
		self.collection.insert_one(finalDictionary)
		for document in self.collection.find({'MetaData.MetaData': 'AverageScoresData'}):
			#pprint(document)
			pass
			
if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = AverageScoresData("Y201702255")