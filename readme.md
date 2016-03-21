# About this Repo
The purpose of this repo is to quickly build out QualiSystems CloudShell environment python scripts via a drag-and-drop interfacce. 

In this latest build, it is still a proof of concept. However we have added the functionality to load a reservation's details out of a CloudShell instance and make building blocks out of it to make an orchestration script quickly.

# Deployment
Dump the entire contents of this folder into an IIS or Apache website. Visit index.php and you are good to go! Requires PHP and CloudShell 6.4 with python.

# Content
Main content of custom Blockly Blocks is created in the index.php and blocks/Quali.js

Additionally, there is a python script getDetails.py which uses the CloudShell API to find all resources and services with commands in a given reservation and prepopulate the startblock on the canvas with those commands.

# Assumptions/Limitations
* PHP is intalled
* CloudShell is installed with API version compatibility with 6.4
* Python for CloudShell is installed in the default location (see index.php) and edit that if it changed.
* Deployed on IIS in default directory. If not, update JavaScript/CSS includes and index.php the path to getDetails.py