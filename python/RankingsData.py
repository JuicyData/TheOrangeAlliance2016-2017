#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class RankingsData(Foundation):
		
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)
		print '-----RANKGINGS DATA-----'

		self.data = {}
		teamList = self.UniqueTeamList()
		matchesThatTeamPlayedAndAlliance = self.WhichMatchesDidThatTeamPlayAndWhatAlliance(teamList)
		for document in self.collection.find({'MetaData.MetaData': 'ResultsInput'}):
			self.data[int(document["ResultsInformation"]["MatchNumber"])] = document

		finalDictionary = {}
		finalDictionary["Rankings"] = {}
		
		for team in teamList:
			finalDictionary["Rankings"]["TeamNumber"+str(team)] = {}
			tempBlue = matchesThatTeamPlayedAndAlliance[team]["Blue"]
			tempRed = matchesThatTeamPlayedAndAlliance[team]["Red"]
			win = 0
			loss = 0
			tie = 0
			RP = 0
			for matchNumber in tempRed:
				if matchNumber in self.data:
					if self.data[matchNumber]["ResultsInformation"]['Winner'] == 'Red':
						RP += self.data[matchNumber]['Score']['Total']['Blue']
						win += 1
					elif self.data[matchNumber]["ResultsInformation"]['Winner'] == 'Blue':
						RP += self.data[matchNumber]['Score']['Total']['Red']
						loss += 1
					elif self.data[matchNumber]["ResultsInformation"]['Winner'] == 'Tie':
						RP += self.data[matchNumber]['Score']['Total']['Red']
						tie += 1
					else:
						win += 100000000
			for matchNumber in tempBlue:
				if matchNumber in self.data:
					if self.data[matchNumber]["ResultsInformation"]['Winner'] == 'Blue':
						RP += self.data[matchNumber]['Score']['Total']['Red']
						win += 1
					elif self.data[matchNumber]["ResultsInformation"]['Winner'] == 'Red':
						RP += self.data[matchNumber]['Score']['Total']['Blue']
						loss += 1
					elif self.data[matchNumber]["ResultsInformation"]['Winner'] == 'Tie':
						RP += self.data[matchNumber]['Score']['Total']['Blue']
						tie += 1
					else:
						win += 100000000

			finalDictionary["Rankings"]["TeamNumber"+str(team)]["TeamNumber"] = team
			finalDictionary["Rankings"]["TeamNumber"+str(team)]["RecordWin"]  = win
			finalDictionary["Rankings"]["TeamNumber"+str(team)]["RecordTie"]  = tie
			finalDictionary["Rankings"]["TeamNumber"+str(team)]["RecordLose"] = loss
			finalDictionary["Rankings"]["TeamNumber"+str(team)]["QP"]  = win * 2 + tie
			finalDictionary["Rankings"]["TeamNumber"+str(team)]["RP"]  = RP

		tempArray = {}
		count = 0
		otherCount = 0
		for team in teamList:
			tempArray[count] = (finalDictionary["Rankings"]["TeamNumber"+str(team)]["QP"] * 10000) + finalDictionary["Rankings"]["TeamNumber"+str(team)]["RP"]
			count += 1
		for team in teamList:
			teamRank = 1
			for i in range(len(tempArray)):
				if tempArray[otherCount] < tempArray[i]:
					teamRank += 1
			otherCount += 1
			finalDictionary["Rankings"]["TeamNumber"+str(team)]["Rank"] = teamRank
			
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "RankingsData"
		finalDictionary["MetaData"]["TimeStamp"] = "anytime"
		finalDictionary["MetaData"]["DatePlace"] = collectionName
		finalDictionary["MetaData"]["InputID"] = "8"

		self.collection.delete_many({"MetaData.MetaData": "RankingsData"})
		self.collection.insert_one(finalDictionary)
				
if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = RankingsData("Y201702255")