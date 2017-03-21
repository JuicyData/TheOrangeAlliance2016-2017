#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
from Output import Output
from RankingsData import RankingsData
from OPRCCWMData import Opr
from MatchData import MatchData
from AverageScoresData import AverageScoresData
from Validation import Validation


collectionName = 'Y201702255'

while True:
	print '----------ALT LAUNCHER START----------'
	Validation(collectionName)

	# Reliant on input only
	RankingsData(collectionName)
	MatchData(collectionName)
	AverageScoresData(collectionName)
	Opr(collectionName)

	# Reliant on previous output
	Output(collectionName)

	print '----------ALT LAUNCHER END----------'
