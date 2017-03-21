#! /usr/bin/python

print '-----IMPORTING: START-----'
import time
import threading
from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation 
from Foundation import HelpfulMethods 
print '-----IMPORTING: END-----'
print '-----INIT: START-----'
class Launcher(Foundation):

	def __init__(self, dataValidation):
		print 'Lunacher. __init__'
		#MongoStuff
		dataValidation = str(dataValidation)
		self.dataValidation = dataValidation
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		self.collection = db.Log

		self.currentTimeMark = 000000000
		#self.foundation = Foundation()
		self.helpfulMethods = HelpfulMethods()
		self.allDatePlaces = self.ListOfDatePlaces()
		pprint(self.allDatePlaces)

	def run(self):
		print 'Launcher.Self'
		#Create new threads
		LauncherNodeThread = ToThread(1, 'LauncherNodeThread', 'LauncherNode')
		BakaThread = ToThread(2, 'BakaThread', 'Baka')
		ExcpetionThread = ToThread(3, 'ExcpetionThread', 'COOLEO')

		print '-----THREAD: STRAT-----'
		#Start new Threads
		try:
			LauncherNodeThread.start()
			BakaThread.start()
			ExcpetionThread.start()
		except:
			print '-----THREAD: ERROR IN START-----'

	def Archiver(self):
		print 'Luancher.Archiver'

	def ListOfDatePlaces(self):
		print 'Launcher.ListOfCollections'
		#Mongo
		cursor = self.collection.find({'MetaData.MetaData' : 'LogInput', 'MetaData.InputID' : self.dataValidation})
		listOfDatePlaces = []
		for document in cursor:
			for logKey, logValue in document['Log'].items():
				if logKey == 'DatePlace' and logValue.isnumeric() == True:
					listOfDatePlaces.append(logValue)
		listOfDatePlacesUnique = self.helpfulMethods.GenerateUniqueList(listOfDatePlaces)
		return listOfDatePlacesUnique



#Threading Stuff
class ToThread(threading.Thread):
	def __init__(self, threadID, threadName, programName):
		threading.Thread.__init__(self)
		self.threadID = threadID
		self.threadName = threadName
		self.programName = programName

	def run(self):
		print "Starting " + self.name
		RunProgram(self.programName)
		print "Exiting " + self.name

def RunProgram(nameOfProgram):
	if nameOfProgram == "LauncherNode":
		#instanceOfLauncherNode = LauncherNode('MY ARGGGGSSSSSS')
		#instanceOfLauncherNode.run()
		print 'Sadmep'
	elif nameOfProgram == "Baka":
		print "You're one of a baka!"
	else:
		print 'Failure to recognize program name: ' + str(nameOfProgram)
print '-----INIT: END-----'
print '-----LAUNCHING-----'

instanceOfLauncher = Launcher('rainbow')
instanceOfLauncher.run()

print '-----TELEMENTRY-----'

print "-----COMPLETED LAUNCHER THREAD-----"