#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

#UNFINISHED
class Dashboard(Foundation):
				
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)
		print '-----DASHBOARD-----'

		teamNumbers = self.UniqueTeamList()

		#TODO: Don't use average scores, but use max score of the day. Best complementary team falls short of max scores the least, but any time max score is exceeded, that is not a factor since that is not complementing and probably impossible

		averageScoresAll = {}
		averageScoresAll["AUTOParkingPartiallyCenter"] = 0
		averageScoresAll["AUTOParkingPartiallyCorner"] = 0
		averageScoresAll["AUTOParkingFullyCenter"] = 0
		averageScoresAll["AUTOParkingFullyCorner"] = 0
		for teamNumber in teamNumbers:
			if(self.collection.find({'MetaData.MetaData': 'AverageScoresData'})[0]["AverageScores"][teamNumber]:
				averageScoresAll["AUTO"]["Parking"]["PartiallyCenter"]

		for teamNumber in teamNumbers:
			finalDictionary = {}
			finalDictionary["MetaData"] = {}
			finalDictionary["MetaData"]["MetaData"] = "TeamDashboard"
			finalDictionary["MetaData"]["TimeStamp"] = "anytime"
			finalDictionary["MetaData"]["DatePlace"] = collectionName
			finalDictionary["MetaData"]["InputID"] = "pi"
			self.collection.delete_many({'MetaData.MetaData': 'TeamDashboard'})
			self.collection.insert_one(finalDictionary)

if __name__ == '__main__': #prevents unnecessarily running if imported in another script				
	test = AverageScoresOutput("Y201702255")