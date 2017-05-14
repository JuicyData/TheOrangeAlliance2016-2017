#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class Output(Foundation):
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)
		print '-----OUTPUT-----'

		teamList = self.UniqueTeamList()
		matchesThatTeamPlayedAndAlliance = self.WhichMatchesDidThatTeamPlayAndWhatAlliance(teamList)

		season = self.Season()
		gameObjectives = self.GameObjectives(season)
		gameFields = gameObjectives["DisplayOrder"]["Fields"]
		
		rankingsDocument = None
		for document in self.collection.find({'MetaData.MetaData' : 'RankingsData'}):
			rankingsDocument = document
			break

		OPRCCWMDocument = None
		for document in self.collection.find({'MetaData.MetaData' : 'OPRCCWMData'}):
			OPRCCWMDocument = document
			break

		statisticsDocument = None
		for document in self.collection.find({'MetaData.MetaData' : 'StatisticsData'}):
			statisticsDocument = document
			break

		averageScoresDocument = None
		for document in self.collection.find({'MetaData.MetaData' : 'AverageScoresData'}):
			averageScoresDocument = document
			break

		resultsInputData = {}
		for document in self.collection.find({'MetaData.MetaData': 'ResultsInput'}):
			resultsInputData[int(document["ResultsInformation"]["MatchNumber"])] = document

		matchInputData = {}
		for document in self.collection.find({'MetaData.MetaData': 'MatchInput'}):
			matchInputData["TeamNumber" + str(document["MatchInformation"]["TeamNumber"]) + "MatchNumber" + str(document["MatchInformation"]["MatchNumber"])] = document

		RankingsOutput = {}
		RankingsOutput["MetaData"] = {}
		RankingsOutput["MetaData"]["MetaData"] = "RankingsOutput"
		RankingsOutput["MetaData"]["TimpStamp"] = 7
		RankingsOutput["MetaData"]["DatePlace"] = collectionName
		RankingsOutput["MetaData"]["InputID"] = "rainbow"
		RankingsOutput["Rankings"] = {}
		
		AverageScoresOutput = {}
		AverageScoresOutput["MetaData"] = {}
		AverageScoresOutput["MetaData"]["MetaData"] = "AverageScoresOutput"
		AverageScoresOutput["MetaData"]["TimpStamp"] = 7
		AverageScoresOutput["MetaData"]["DatePlace"] = collectionName
		AverageScoresOutput["MetaData"]["Season"] = season
		AverageScoresOutput["MetaData"]["InputID"] = "rainbow"
		AverageScoresOutput["AverageScores"] = {}
		
		MatchOutput = {}
		MatchOutput["MetaData"] = {}
		MatchOutput["MetaData"]["MetaData"] = "MatchOutput"
		MatchOutput["MetaData"]["TimpStamp"] = 7
		MatchOutput["MetaData"]["DatePlace"] = collectionName
		MatchOutput["MetaData"]["Season"] = season
		MatchOutput["MetaData"]["InputID"] = "rainbow"
		MatchOutput["MatchHistory"] = {}
		
		savedRank = {}
		if (rankingsDocument):
			document = rankingsDocument
			for team in teamList:
				RankingsOutput["Rankings"]["TeamNumber" + str(team)] = {}
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["TeamNumber"] = team
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["TeamName"] = self.TeamName(team)
				if document["Rankings"]["TeamNumber" + str(team)]["TeamNumber"] == team:
					savedRank[str(team)] = document["Rankings"]["TeamNumber" + str(team)]["Rank"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["Rank"] = document["Rankings"]["TeamNumber" + str(team)]["Rank"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RecordWin"] = document["Rankings"]["TeamNumber" + str(team)]["RecordWin"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RecordTie"] = document["Rankings"]["TeamNumber" + str(team)]["RecordTie"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RecordLose"] = document["Rankings"]["TeamNumber" + str(team)]["RecordLose"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["QP"] = document["Rankings"]["TeamNumber" + str(team)]["QP"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RP"] = document["Rankings"]["TeamNumber" + str(team)]["RP"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RP"] = document["Rankings"]["TeamNumber" + str(team)]["RP"]
		
		savedOPR = {}
		if (OPRCCWMDocument):
			document = OPRCCWMDocument
			for team in teamList:
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["CCWM"] = document["OPRCCWM"]["TeamNumber" + str(team)]["CCWM"]
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["OPR"] = document["OPRCCWM"]["TeamNumber" + str(team)]["OPR"]
				savedOPR[str(team)] = document["OPRCCWM"]["TeamNumber" + str(team)]["OPR"]
				
		if (statisticsDocument):
			document = statisticsDocument
			for team in teamList:
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["Growth"] = document["Statistics"]["Growth"]["TeamNumber" + str(team)]["Growth"]
					
		if (averageScoresDocument):
			document = averageScoresDocument
			for team in teamList:
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["AverageAUTO"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageAuto"]
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["AverageDRIVER"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageDriver"]
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["AverageEND"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageEnd"]

				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)] = {}
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["TeamNumber"] = team
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["TeamName"] = self.TeamName(team)
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AverageScores"] = {}
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageScore"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageScore"]				
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageAuto"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageAuto"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageDriver"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageDriver"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageEnd"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AverageEnd"]
				
				for gamePeriod in gameFields:
					AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)][gamePeriod] = {}
					for field in gameFields[gamePeriod]:
						fieldType = gameObjectives["Scoring"][gamePeriod][field]["Type"]
						if fieldType == "String":
							AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)][gamePeriod][field] = {}
							for option in gameObjectives["DisplayOrder"]["Options"][gamePeriod][field]:
								AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)][gamePeriod][field][option] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"][gamePeriod][field][option]
						elif fieldType == "Number" or fieldType == "YesNo":
							AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)][gamePeriod][field] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"][gamePeriod][field]

		for team in teamList:
			MatchOutput["MatchHistory"]["TeamNumber" + str(team)] = {}
			for alliance in ["Red", "Blue"]:
				matchesPlayed = matchesThatTeamPlayedAndAlliance[team][alliance]
				for matchNumber in matchesPlayed:
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)] = {}
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance] = {}
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["TeamNumber"] = team
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["MatchNumber"] = matchNumber
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["Alliance"] = alliance
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["OPR"] = savedOPR[str(team)]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["TeamName"] = self.TeamName(team)
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["TeamRank"] = savedRank[str(team)]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["AUTO"] = {}
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["DRIVER"] = {}
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["END"] = {}
					
					if (matchNumber in resultsInputData):
						documentResults = resultsInputData[matchNumber]
						MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["ResultRed"] = documentResults["Score"]["Total"]["Red"]
						MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["ResultBlue"] = documentResults["Score"]["Total"]["Blue"]

					if ("TeamNumber" + str(team) + "MatchNumber" + str(matchNumber) in matchInputData):
						documentResults = matchInputData["TeamNumber" + str(team) + "MatchNumber" + str(matchNumber)]
						for gamePeriod in gameFields:
							for field in gameFields[gamePeriod]:
								MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance][gamePeriod][field] = documentResults["GameInformation"][gamePeriod][field]

						score = 0
						for gamePeriod in gameFields:
							for field in gameFields[gamePeriod]:
								fieldType = gameObjectives["Scoring"][gamePeriod][field]["Type"]
								value = documentResults["GameInformation"][gamePeriod][field]
								if fieldType == "String":
									score += gameObjectives["Scoring"][gamePeriod][field]["Options"][value]
								elif fieldType == "Number":
									score += gameObjectives["Scoring"][gamePeriod][field]["Points"] * value
								elif fieldType == "YesNo" and value == "Yes":
									score += gameObjectives["Scoring"][gamePeriod][field]["Points"]
						MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["Alliance"+alliance]["Score"] = score
		
		#pprint(RankingsOutput)
		#pprint(MatchOutput)
		#pprint(AverageScoresOutput)
		
		self.collection.delete_many({"MetaData.MetaData": "RankingsOutput"})
		self.collection.delete_many({"MetaData.MetaData": "AverageScoresOutput"})
		self.collection.delete_many({"MetaData.MetaData": "MatchOutput"})
		self.collection.insert_one(RankingsOutput)
		self.collection.insert_one(AverageScoresOutput)
		self.collection.insert_one(MatchOutput)
		
if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = Output("Y201702255")