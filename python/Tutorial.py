# Welcome to the Orange Alliance Python Tutorial
# This file is based on the "Data Module Structure" found here: https://docs.google.com/document/d/1PPWO4gK242ggTp-usYP-dCTxWA82Kmm3atWoGH0xQAI/edit

from pymongo import MongoClient #library for accessing the MongoDB database in Python
from pprint import pprint #library for printing dictionaries/mongodb documents
from Foundation import Foundation #class in Foundation.py with useful methods

class Tutorial(Foundation):#Class definition. The (Foundation) means that it inherits methods from Foundation
		
	def __init__(self, collectionName):
		self.InitFoundation(collectionName)#Initializes collections

		# RECIPE STARTS HERE. IT'S A GOOD IDEA TO RUN THIS SCRIPT AFTER EACH STEP YOU COMPLETE.
		# 1. Below is a dictionary. Learn the format. Try adding another key/value pair to the list.
		sampleDictionary = {"key": "value", "anotherkey": "another value", "potato": "tomato"}

		# 2. Print the value for potato using sampleDictionary["potato"]
		print "the value for the key potato is " # + paste code here

		# 3. Store the all the keys in a variable using sampleDictionary.keys()

		# 4. Write a foreach loop that iterates through each key. The syntax is: "for variableName in list:"
			# a. print the key and its corresponding value.

		# 5. Find MatchData documents in the database using self.collection.find({'MetaData.MetaData': 'MatchInput'}. Store this in a variable called "cursor"
		# Note: documents are dictionaries. Usially, the dictionary values are more dictionaries with more key/value pairs. Or there could be dictionaries within dictionaries within dictionaries within dictionaries!!!

		# 6. cursor is a list of documents. Use a foreach loop to loop through them.
			# a. use pprint to print out each document in a nice format: pprint(document)

				
#Notice that this part is outside of the indentation of the class. That means this is the code that runs when doing "python Tutorial.py"
if __name__ == '__main__': #checks to see if this script is run from the command line (true) or is being imported (false).
	test = Tutorial("Y201702255") #instantiates the class with the collection from San Diego Regionals
