#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
import numpy

class Opr(Foundation):

	def formatNumber(self, number):
		return format(number, '.2f').rstrip('0').rstrip('.')

	def __init__(self, collectionName):
		self.InitFoundation(collectionName)
		print '-----OPR/CCWM DATA-----'

		self.data = {}
		for document in self.collection.find({'MetaData.MetaData': 'ResultsInput'}):
			self.data[int(document["ResultsInformation"]["MatchNumber"])] = document

		teamNumbers = self.UniqueTeamList()
		numTeams = len(teamNumbers)

		print " "
		whoPlaysInWhichMatch = {}
		matchesAndAlliances = self.WhichMatchesDidThatTeamPlayAndWhatAlliance(teamNumbers)
		totalScore = [0 for x in range(numTeams)]
		totalWinningMargin = [0 for x in range(numTeams)]
		for i in range(numTeams):
			for matchNumber in matchesAndAlliances[teamNumbers[i]]["Blue"]:
				if matchNumber in self.data:
					totalScore[i] += self.data[matchNumber]["Score"]["Total"]["Blue"]
					totalWinningMargin[i] += self.data[matchNumber]["Score"]["Total"]["Blue"] - self.data[matchNumber]["Score"]["Total"]["Red"]
					if (not matchNumber in whoPlaysInWhichMatch):
						whoPlaysInWhichMatch[matchNumber] = {}
					if (not "Blue1" in whoPlaysInWhichMatch[matchNumber]):
						whoPlaysInWhichMatch[matchNumber]["Blue1"] = i
					else:
						whoPlaysInWhichMatch[matchNumber]["Blue2"] = i
					#print "Team " + str(teamNumbers[i]) + " got " + str(cursor[0]["Score"]["Total"]["Blue"]) + " points on the Blue alliance in match " + str(matchNumber)
			for matchNumber in matchesAndAlliances[teamNumbers[i]]["Red"]:
				if matchNumber in self.data:
					totalScore[i] += self.data[matchNumber]["Score"]["Total"]["Red"]
					totalWinningMargin[i] += self.data[matchNumber]["Score"]["Total"]["Red"] - self.data[matchNumber]["Score"]["Total"]["Blue"]
					if (not matchNumber in whoPlaysInWhichMatch):
						whoPlaysInWhichMatch[matchNumber] = {}
					if (not "Red1" in whoPlaysInWhichMatch[matchNumber]):
						whoPlaysInWhichMatch[matchNumber]["Red1"] = i
					else:
						whoPlaysInWhichMatch[matchNumber]["Red2"] = i
					#print "Team " + str(teamNumbers[i]) + " got " + str(cursor[0]["Score"]["Total"]["Red"]) + " points on the Red alliance in match " + str(matchNumber)
		totalScoreMatrix = numpy.rot90(numpy.asmatrix(numpy.array(totalScore)), 3)
		totalWinningMarginMatrix = numpy.rot90(numpy.asmatrix(numpy.array(totalWinningMargin)), 3)
		print totalScoreMatrix
		print " "
		print totalWinningMarginMatrix

		print " "
		whoPlaysWhoArray = [[0 for x in range(numTeams)] for y in range(numTeams)]
		for match in whoPlaysInWhichMatch.values():
			b1 = match["Blue1"]
			b2 = match["Blue2"]
			r1 = match["Red1"]
			r2 = match["Red2"]
			whoPlaysWhoArray[b1][b2] += 1
			whoPlaysWhoArray[b2][b1] += 1
			whoPlaysWhoArray[b1][b1] += 1
			whoPlaysWhoArray[b2][b2] += 1
			whoPlaysWhoArray[r1][r2] += 1
			whoPlaysWhoArray[r2][r1] += 1
			whoPlaysWhoArray[r1][r1] += 1
			whoPlaysWhoArray[r2][r2] += 1
		whoPlaysWhoMatrix = numpy.asmatrix(numpy.array(whoPlaysWhoArray))
		print whoPlaysWhoMatrix

		print " "
		if (numpy.linalg.det(whoPlaysWhoMatrix) != 0):
			oprMatrix = numpy.linalg.solve(whoPlaysWhoMatrix, totalScoreMatrix)
			oprArray = numpy.asarray(numpy.rot90(oprMatrix))[0]
			ccwmMatrix = numpy.linalg.solve(whoPlaysWhoMatrix, totalWinningMarginMatrix)
			ccwmArray = numpy.asarray(numpy.rot90(ccwmMatrix))[0]
			self.oprArrayPretty = []
			for num in oprArray:
				self.oprArrayPretty.append(self.formatNumber(num))
			self.ccwmArrayPretty = []
			for num in ccwmArray:
				self.ccwmArrayPretty.append(self.formatNumber(num))
			print self.oprArrayPretty
			print " "
			print self.ccwmArrayPretty
			print " "
		else:
			self.oprArrayPretty = ['' for x in range(numTeams)]
			self.ccwmArrayPretty = ['' for x in range(numTeams)]
			print "OPR & CCWM UNSOLVABLE!!!"
			print " "
		dictionary = {}
		dictionary["MetaData"] = {}
		dictionary["MetaData"]["MetaData"] = "OPRCCWMData"
		dictionary["MetaData"]["TimeStamp"] = "anytime"
		dictionary["MetaData"]["DatePlace"] = collectionName
		dictionary["MetaData"]["InputID"] = "pi"
		dictionary["OPRCCWM"] = {};
		for i in range(numTeams):
			dictionary["OPRCCWM"]["TeamNumber" + str(teamNumbers[i])] = {}
			dictionary["OPRCCWM"]["TeamNumber" + str(teamNumbers[i])]["TeamNumber"] = teamNumbers[i]
			dictionary["OPRCCWM"]["TeamNumber" + str(teamNumbers[i])]["OPR"] = self.oprArrayPretty[i]
			dictionary["OPRCCWM"]["TeamNumber" + str(teamNumbers[i])]["CCWM"] = self.ccwmArrayPretty[i]
		self.collection.delete_many({'MetaData.MetaData': 'OPRCCWMData'})
		self.collection.insert_one(dictionary)
		for document in self.collection.find({'MetaData.MetaData': 'OPRCCWMData'}):
			#pprint(document)
			pass
		print "FINISHED OPR & CCWM"
		print " "

if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = Opr("Y201702255")