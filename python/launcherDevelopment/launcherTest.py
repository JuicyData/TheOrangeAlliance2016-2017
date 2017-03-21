#! /usr/bin/python

import time
import shlex, subprocess

print 'I'
args = ['python GetLauncherTest.py']
print args
#p = subprocess.Popen(args)
subprocess.Popen((args), shell=True)


print 'I2'
