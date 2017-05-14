#! /usr/bin/python

#This file is used to test exactly what Manager.py does, but without the loop.

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
from Output import Output
from RankingsData import RankingsData
from OPRCCWMData import Opr
from AverageScoresData import AverageScoresData
from Validation import Validation


collectionName = 'Y201702255'

print '----------MANAGER TEST START----------'
Validation(collectionName)

# Reliant on input only
RankingsData(collectionName)
AverageScoresData(collectionName)
Opr(collectionName)

# Reliant on previous output
Output(collectionName)

print '----------MANAGER TEST END----------'
