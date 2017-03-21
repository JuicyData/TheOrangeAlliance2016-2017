#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class Output(Foundation):
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)
		
		teamList = self.UniqueTeamList()
		matchesThatTeamPlayedAndAlliance = self.WhichMatchesDidThatTeamPlayAndWhatAlliance(teamList)
		
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
		AverageScoresOutput["MetaData"]["InputID"] = "rainbow"
		AverageScoresOutput["AverageScores"] = {}
		
		MatchOutput = {}
		MatchOutput["MetaData"] = {}
		MatchOutput["MetaData"]["MetaData"] = "MatchOutput"
		MatchOutput["MetaData"]["TimpStamp"] = 7
		MatchOutput["MetaData"]["DatePlace"] = collectionName
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
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"] = {}
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["Parking"] = {}
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["Parking"]["NoParking"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["Parking"]["NoParking"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["Parking"]["PartiallyCenter"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["Parking"]["PartiallyCenter"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["Parking"]["PartiallyCorner"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["Parking"]["PartiallyCorner"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["Parking"]["FullyCenter"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["Parking"]["FullyCenter"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["Parking"]["FullyCorner"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["Parking"]["FullyCorner"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["CenterParticles"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["CenterParticles"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["CornerParticles"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["CornerParticles"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["CapBall"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["CapBall"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["AUTO"]["Beacons"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["AUTO"]["Beacons"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["DRIVER"] = {}
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["DRIVER"]["CenterParticles"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["DRIVER"]["CenterParticles"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["DRIVER"]["CornerParticles"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["DRIVER"]["CornerParticles"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["END"] = {}
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["END"]["Beacons"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["END"]["Beacons"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["END"]["CapBall"] = {}
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["END"]["CapBall"]["CapBallOnFloor"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["END"]["CapBall"]["CapBallOnFloor"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["END"]["CapBall"]["CapBallRaised"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["END"]["CapBall"]["CapBallRaised"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["END"]["CapBall"]["CapBallAboveCenter"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["END"]["CapBall"]["CapBallAboveCenter"]
				AverageScoresOutput["AverageScores"]["TeamNumber" + str(team)]["END"]["CapBall"]["CapBallInCenter"] = document["AverageScores"]["TeamNumber" + str(team)]["AverageScores"]["END"]["CapBall"]["CapBallInCenter"]

		for team in teamList:
			tempBlue = matchesThatTeamPlayedAndAlliance[team]["Blue"]
			tempRed = matchesThatTeamPlayedAndAlliance[team]["Red"]
			MatchOutput["MatchHistory"]["TeamNumber" + str(team)] = {}
			for matchNumber in tempBlue:
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["TeamNumber"] = team
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["MatchNumber"] = matchNumber
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["Alliance"] = "Blue"
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["OPR"] = savedOPR[str(team)]
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["TeamName"] = self.TeamName(team)
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["TeamRank"] = savedRank[str(team)]
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"] = {}
				
				if (matchNumber in resultsInputData):
					documentResults = resultsInputData[matchNumber]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["ResultRed"] = documentResults["Score"]["Total"]["Red"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["ResultBlue"] = documentResults["Score"]["Total"]["Blue"]

				if ("TeamNumber" + str(team) + "MatchNumber" + str(matchNumber) in matchInputData):
					documentResults = matchInputData["TeamNumber" + str(team) + "MatchNumber" + str(matchNumber)]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["Parking"] = documentResults["GameInformation"]["AUTO"]["RobotParking"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CenterParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CornerParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCorner"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CapBall"] = documentResults["GameInformation"]["AUTO"]["CapBall"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["Beacons"] = documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"]["CenterParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"]["CornerParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"]["Beacons"] = documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"]["CapBall"] = documentResults["GameInformation"]["END"]["CapBall"]

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
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["Score"] = score

			for matchNumber in tempRed:
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["TeamNumber"] = team
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["MatchNumber"] = matchNumber
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["Alliance"] = "Red"
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["OPR"] = savedOPR[str(team)]
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["TeamName"] = self.TeamName(team)
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["TeamRank"] = savedRank[str(team)]
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"] = {}
				MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"] = {}

				if (matchNumber in resultsInputData):
					documentResults = resultsInputData[matchNumber]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["ResultRed"] = documentResults["Score"]["Total"]["Red"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["ResultBlue"] = documentResults["Score"]["Total"]["Blue"]

				if ("TeamNumber" + str(team) + "MatchNumber" + str(matchNumber) in matchInputData):
					documentResults = matchInputData["TeamNumber" + str(team) + "MatchNumber" + str(matchNumber)]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["Parking"] = documentResults["GameInformation"]["AUTO"]["RobotParking"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CenterParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CornerParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCorner"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CapBall"] = documentResults["GameInformation"]["AUTO"]["CapBall"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["Beacons"] = documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"]["CenterParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"]["CornerParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"]["Beacons"] = documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"]["CapBall"] = documentResults["GameInformation"]["END"]["CapBall"]

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
					MatchOutput["MatchHistory"]["TeamNumber" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["Score"] = score
		
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