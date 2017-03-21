#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class Validation(Foundation):
		
	def noneChanger(self, value, alternateValue):
		if value == []:
			return alternateValue
		else:
			if value == None:
				return alternateValue
			else:
				return value
		
	def __init__(self, collectionName):
	
		#Mongo Stuff
		self.InitFoundation(collectionName)
		
		#------------------------Input Data Match Results------------------------------------------

		self.collection.delete_many({"MetaData.MetaData": "MatchInput"})

		#Input Data Collects all input data
		cursor = self.collectionRaw.find({'MetaData.MetaData' : 'MatchInputRaw'})
		inputDataDocuments = []
		for document in cursor:
			inputDataDocuments.append(document)
		validationKeyDocuments = []
		cursor = self.collectionDataValidation.find({'MetaData.MetaData' : 'ValidationKey'})
		for document in cursor:
			validationKeyDocuments.append(document)
		validationKeyHierarchyDocuments = []
		cursor = self.collectionDataValidation.find({'MetaData.MetaData' : 'ValidationKeyHierarchy'})
		for document in cursor:
			validationKeyHierarchyDocuments.append(document)

		#Finds lowest level type
		lowestTypeLevel = 0
		#Retrives the Types/Status and their values
		validationKeyHierarchyType = {}
		validationKeyHierarchyStatus = {}
		for validationKeyHierarchyDocument in validationKeyHierarchyDocuments:
			validationKeyHierarchyType = validationKeyHierarchyDocument['Hierarchy']['TypeLevel']
			validationKeyHierarchyStatus = validationKeyHierarchyDocument['Hierarchy']['StatusLevel']
			for typeLevelNames in validationKeyHierarchyDocument['Hierarchy']['TypeLevel'].values():
				if(typeLevelNames > lowestTypeLevel):
					lowestTypeLevel = typeLevelNames

		#Generates a list of unique match infroamtion (team, alliance, and matchnumber)
		uniqueMatchInformation = []
		for document in inputDataDocuments:
			if(document['MatchInformation'] not in uniqueMatchInformation):
				uniqueMatchInformation.append(document['MatchInformation'])

		#The frame work; looking at one match information at the time
		for matchInformation in uniqueMatchInformation:
			#All the keys present per match information
			uniqueKeyPool = []
			#Unique list of key types presnt from unique key pool
			uniqueKeyTypePool = []
			#filters out fake keys
			cleanUniqueKeyPool = []
			#determines the highest level key value present in the unique key tpye pool
			highestKeyTypeLevel = lowestTypeLevel
			#a pool of keys that are the highest level of key types 
			highestKeyTypePool = []
			#
			highestKeyStatusLevel = validationKeyHierarchyStatus['Default']
			finalKeyPool = []
			#all inputDataDocuments to check though
			for document in inputDataDocuments:
				#if the correct document (via document information) is being used
				if(cmp(document['MatchInformation'],matchInformation) == 0 and document['DataValidation']['ValidationKey'] not in uniqueKeyPool):
					uniqueKeyPool.append(document['DataValidation']['ValidationKey'])
			for uniqueKey in uniqueKeyPool:
				for validationKeyDocument in validationKeyDocuments:
					if(uniqueKey == validationKeyDocument['ValidationKey']['KeyIdentity']['Key']):
						cleanUniqueKeyPool.append(uniqueKey)
						if(validationKeyDocument['ValidationKey']['KeyInformation']['KeyType'] not in uniqueKeyTypePool):
							uniqueKeyTypePool.append(validationKeyDocument['ValidationKey']['KeyInformation']['KeyType'])
			for uniqueKeyType in uniqueKeyTypePool:
				if(highestKeyTypeLevel > validationKeyHierarchyType[uniqueKeyType]):
					highestKeyTypeLevel = validationKeyHierarchyType[uniqueKeyType]
			for cleanUniqueKey in cleanUniqueKeyPool:
				for validationKeyDocument in validationKeyDocuments:
					if(validationKeyDocument['ValidationKey']['KeyIdentity']['Key'] == cleanUniqueKey):
						if(validationKeyHierarchyType[validationKeyDocument['ValidationKey']['KeyInformation']['KeyType']] == highestKeyTypeLevel):
							highestKeyTypePool.append(cleanUniqueKey)				
			for highestKey in highestKeyTypePool:
				for validationKeyDocument in validationKeyDocuments:
					if(validationKeyDocument['ValidationKey']['KeyIdentity']['Key'] == highestKey):
						if(highestKeyStatusLevel > validationKeyHierarchyStatus[validationKeyDocument['ValidationKey']['KeyInformation']['KeyStatus']]):
							highestKeyStatusLevel = validationKeyHierarchyStatus[validationKeyDocument['ValidationKey']['KeyInformation']['KeyStatus']]
			for highestKey in highestKeyTypePool:
				for validationKeyDocument in validationKeyDocuments:
					if(validationKeyDocument['ValidationKey']['KeyIdentity']['Key'] == highestKey):
						if(validationKeyHierarchyStatus[validationKeyDocument['ValidationKey']['KeyInformation']['KeyStatus']] == highestKeyStatusLevel):
							finalKeyPool.append(highestKey)

			#Real stuff set up
			allInputFields = {
				'AUTO' : [
					'RobotParking',
					'ParticlesCenter',
					'ParticlesCorner',
					'CapBall',
					'ClaimedBeacons'
				],
				'DRIVER' : [
					'ParticlesCenter',
					'ParticlesCorner'
				],
				'END' : [
					'AllianceClaimedBeacons',
					'CapBall'
				]
			}
			allInputs = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			allUniqueInputs = {}
			countedInputs = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			maxFrequencyInput = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			majorityInput = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			inputRank = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			compileRank = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			finalOutput = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			if finalKeyPool == []:
				for document in inputDataDocuments:
					for gamePeriods in allInputFields:
						for gameFields in allInputFields[gamePeriods]:
							allInputs[gamePeriods][gameFields].append(document['GameInformation'][gamePeriods][gameFields])
			else:	
				#Real stuff (if there are any keys present)
				for document in inputDataDocuments:
					if(cmp(document['MatchInformation'],matchInformation) == 0 and document['DataValidation']['ValidationKey'] in finalKeyPool):
						for gamePeriods in allInputFields:
							for gameFields in allInputFields[gamePeriods]:
								allInputs[gamePeriods][gameFields].append(document['GameInformation'][gamePeriods][gameFields])

			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					for gameValue in allInputs[gamePeriods][gameFields]:
						if({'GameValue' : gameValue, 'Frequency' : None} not in countedInputs[gamePeriods][gameFields]):
							countedInputs[gamePeriods][gameFields].append(
								{
										'GameValue' : gameValue,
										'Frequency' : None
								}
							)
			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					for gameValue in allInputs[gamePeriods][gameFields]:
						for gameValueInformationIndex in range(0,len(countedInputs[gamePeriods][gameFields])):
							if(gameValue == countedInputs[gamePeriods][gameFields][gameValueInformationIndex]['GameValue']):
								if(countedInputs[gamePeriods][gameFields][gameValueInformationIndex]['Frequency'] == None):
									countedInputs[gamePeriods][gameFields][gameValueInformationIndex]['Frequency'] = 0
								countedInputs[gamePeriods][gameFields][gameValueInformationIndex]['Frequency'] += 1
			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					tempFrequency = []
					for gameValueInformation in countedInputs[gamePeriods][gameFields]:
						tempFrequency.append(gameValueInformation['Frequency'])
					if(tempFrequency != []):
						maxFrequencyInput[gamePeriods][gameFields] = max(tempFrequency)
			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					amountOfMaxFrequencyInput = 0
					for gameValueInformation in countedInputs[gamePeriods][gameFields]:
						if gameValueInformation['Frequency'] == maxFrequencyInput[gamePeriods][gameFields]:
							amountOfMaxFrequencyInput += 1
					if amountOfMaxFrequencyInput == 1:
						for gameValueInformation in countedInputs[gamePeriods][gameFields]:
							if gameValueInformation['Frequency'] == maxFrequencyInput[gamePeriods][gameFields]:
								majorityInput[gamePeriods][gameFields] = gameValueInformation['GameValue']
					else:
						majorityInput[gamePeriods][gameFields] = None
			if finalKeyPool == []:
				for document in inputDataDocuments:
					if(cmp(document['MatchInformation'],matchInformation) == 0):
						for gamePeriods in allInputFields:
							for gameFields in allInputFields[gamePeriods]:
								inputRank[gamePeriods][gameFields].append(
							{
								'GameValue' : document['GameInformation'][gamePeriods][gameFields],
								'RankValue' : 50
							}
						)
			else:
				for document in inputDataDocuments:
					if(cmp(document['MatchInformation'],matchInformation) == 0 and document['DataValidation']['ValidationKey'] in finalKeyPool):
						for gamePeriods in allInputFields:
							for gameFields in allInputFields[gamePeriods]:
								inputRank[gamePeriods][gameFields].append(
							{
								'GameValue' : document['GameInformation'][gamePeriods][gameFields],
								'RankValue' : document['DataValidation']['ValidationValue']
							}
						)
			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					for gameValue in allInputs[gamePeriods][gameFields]:
						if({'GameValue' : gameValue, 'TotalRankValue' : 0} not in compileRank[gamePeriods][gameFields]):
							compileRank[gamePeriods][gameFields].append(
								{
										'GameValue' : gameValue,
										'TotalRankValue' : 0
								}
							)
			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					for compileRankInformation in compileRank[gamePeriods][gameFields]:
						for inputRankInformation in inputRank[gamePeriods][gameFields]:
							if inputRankInformation['GameValue'] == compileRankInformation['GameValue']:
								compileRankInformation['TotalRankValue'] += inputRankInformation['RankValue']

			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					tempTotalRankValueList = []
					tempTotalRankValueMax = 0
					for compileRankInformation in compileRank[gamePeriods][gameFields]:
						tempTotalRankValueList.append(compileRankInformation['TotalRankValue'])
					if tempTotalRankValueList != []:	
						tempTotalRankValueMax = max(tempTotalRankValueList)
					amountAtMax = 0
					for compileRankInformation in compileRank[gamePeriods][gameFields]:
						if compileRankInformation['TotalRankValue'] == tempTotalRankValueMax:
							amountAtMax += 1
					if amountAtMax > 1: 
						finalOutput[gamePeriods][gameFields] = None
					else:
						for compileRankInformation in compileRank[gamePeriods][gameFields]:
							if compileRankInformation['TotalRankValue'] == tempTotalRankValueMax:
								finalOutput[gamePeriods][gameFields] = compileRankInformation['GameValue']

			#final part
			finalOutputFormat = {
				'MetaData' : {
					'MetaData' : 'MatchInput',
					'TimeStamp' : 'HA SOME OTHER TIME!',
					'DatePlace' : 'Y201702255Raw',
					'InputID' : 'My woes'
				},
				'MatchInformation':{
					'MatchNumber' : matchInformation['MatchNumber'],
					'RobotAlliance' : matchInformation['RobotAlliance'],
					'TeamNumber' : matchInformation['TeamNumber']
				},
				'GameInformation' : {
					'AUTO' : {
						'RobotParking' : self.noneChanger(finalOutput['AUTO']['RobotParking'], 'No Parking'),
						'ParticlesCenter' : self.noneChanger(finalOutput['AUTO']['ParticlesCenter'], 0),
						'ParticlesCorner' : self.noneChanger(finalOutput['AUTO']['ParticlesCorner'], 0),
						'CapBall' : self.noneChanger(finalOutput['AUTO']['CapBall'], 'On Floor'),
						'ClaimedBeacons' : self.noneChanger(finalOutput['AUTO']['ClaimedBeacons'], 0),
					},
					'DRIVER' : {
						'ParticlesCenter' : self.noneChanger(finalOutput['DRIVER']['ParticlesCenter'], 0),
						'ParticlesCorner' : self.noneChanger(finalOutput['DRIVER']['ParticlesCorner'], 0)
					},
					'END' : {
						'AllianceClaimedBeacons' : self.noneChanger(finalOutput['END']['AllianceClaimedBeacons'], 0),
						'CapBall' : self.noneChanger(finalOutput['END']['CapBall'], 'On Floor')
					}
				}
			}
			self.collection.insert_one(finalOutputFormat)

			print finalOutputFormat
			pprint(finalOutputFormat)

			print 'uniqueKeyPool'
			pprint(uniqueKeyPool)
			print 'cleanUniqueKeyPool'
			pprint(cleanUniqueKeyPool)
			if(cleanUniqueKeyPool == []):
				print 'cleanUniqueKeyPool is empty'
			print 'uniqueKeyTypePool'
			pprint(uniqueKeyTypePool)
			print 'highestKeyTypeLevel'
			print highestKeyTypeLevel
			print 'highestKeyTypePool'
			pprint(highestKeyTypePool)
			print 'finalKeyPool'
			pprint(finalKeyPool)
			print 'countedInputs'
			pprint(countedInputs)
			print 'majorityInput'
			pprint(majorityInput)
			print 'maxFrequencyInput'
			pprint(maxFrequencyInput)
			print 'inputRank'
			pprint(inputRank)
			print 'compileRank'
			pprint(compileRank)
			print 'finalOutput'
			pprint(finalOutput)	

			print 'finalKeyPool'
			pprint(finalKeyPool)
				
if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = Validation("Y201702255")