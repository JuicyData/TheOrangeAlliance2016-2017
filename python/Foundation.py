#! /usr/bin/python

#Import
from pymongo import MongoClient
from pprint import pprint
import os
import json

class Foundation(object):
	'I am a CLASSSSSS!'

	def __init__(self, collectionName, debug = False):
		self.InitFoundation(collectionName, debug)

	def InitFoundation(self, collectionName, debug = False):
		print '-----START OF FOUNDATION-----'

		#Configuring MongoDB host
		path = os.path.dirname(os.path.realpath(__file__))
		host = ""
		port = ""
		try:
			file = open(path+"/mongodb_config.json", 'r')
			config = json.load(file)
			host = config["host"]
			port = config["port"]
		except IOError:
			file = open(path+"/mongodb_config.json", 'w')
			file.write('{\n\t"host": "",\n\t"port": ""\n}')
		file.close()

		#MongoStuff
		if (not host == ""):
			client = MongoClient("mongodb://"+host+":"+port)
			print "connecting to mongodb://"+host+":"+port
		else:
			client = MongoClient()
		db = client.TheOrangeAlliance
		self.teamCollection = db.Teams
		self.collectionDataValidation = db.DataValidation
		self.collectionRaw = eval("db."+collectionName + "Raw")
		self.collection = eval("db."+collectionName)

		#Varibles
		self.collectionName = collectionName
		self.debug = debug

		print '-----END OF FOUNDATION-----'

	#Functions
	def WhichMatchesDidThatTeamPlayAndWhatAlliance(self, teamList):
		matchesThatTeamPlayedAndAlliance = {}
		for document in self.collection.find({'MetaData.MetaData' : 'ScheduleInput'}):
			for team in teamList:
				matchListRed = []
				matchListBlue = []
				for matchNumber in range(1, len(document['Match'].values()) + 1):
					for alliance, teamOnThatAlliance in document['Match']['Match' + str(matchNumber)].items():
						if alliance == 'Red1' or alliance == 'Red2':
							if teamOnThatAlliance == team:
								matchListRed.append(matchNumber)
						if alliance == 'Blue1' or alliance == 'Blue2':
							if teamOnThatAlliance == team:
								matchListBlue.append(matchNumber)
				matchesThatTeamPlayedAndAlliance.update({team : {'Red' : matchListRed , 'Blue' : matchListBlue}})
			break
		return matchesThatTeamPlayedAndAlliance
		
	def Debugger(self, statment):
		"Enables debugging, prints statment if true"
		if self.debug == True:
			print(statment)
			
	def GenerateUniqueList(self, ununiqueList):
		"Generates a unique list based off the not unique list"
		uniqueList = []
		for indexUnuniqueList in range(len(ununiqueList)):
			if not ununiqueList[indexUnuniqueList] in uniqueList:
				uniqueList.append(ununiqueList[indexUnuniqueList])
		return uniqueList

	def UniqueTeamList(self):
		"Produces the unique list of teams from schedule"
		ununiqueTeamList = []
		for document in self.collection.find({'MetaData.MetaData' : 'ScheduleInput'}):
			for match in document['Match'].values():
				for team in match.values():
					ununiqueTeamList.append(int(team))
			break
		return self.GenerateUniqueList(ununiqueTeamList)

	def TotalMatches(self):
		"Returns the amount of matches in schedule int"
		self.Debugger('FUNCTION: Total Mathes')
		totalMatches = 0
		for document in self.collection.find({'MetaData.MetaData' : 'ScheduleInput'}):
			totalMatches = len(document['Match'])
			break
		self.Debugger('Total Matches return: ' + str(totalMatches))
		return totalMatches

	def TeamName(self, teamNumber):
		#MongoStuff
		teamName = 'NO NAME FOUND'
		for document in self.teamCollection.find({'MetaData.MetaData' : 'TeamList'}):
			for teamNumberValue, teamNameValue in document['TeamInformation'].items():
				if str(teamNumber) == teamNumberValue:
					teamName = teamNameValue
					return teamName