# About this Repo
The purpose of this repo is to quickly build out QualiSystems CloudShell environment python scripts via a drag-and-drop interfacce. While the initial build is a proof of concept, the goal is to add the functionality to load an environment's details out of a CloudShell instance and make building blocks out of it to make an orchestration script quickly.

# Deployment
Dump the entire contents of this folder into an IIS or Apache website. Visit index.html and you are good to go! Requires PHP for the fromRes.php and CloudShell 6.4 with python.

# Content
Main content is created in the fromBlank.html and blocks/Quali.js

Additionally, there is a python script getDetails.py which uses the CloudShell API to find all resources and services with commands in a given reservation and prepopulate the startblock on the canvas with those commands.

# Assumptions/Limitations
* PHP is intalled
* CloudShell is installed with API version compatibility with 6.4
* Python for CloudShell is installed in the default location (see fromRes.php) and edit that if it changed.
* Deployed on IIS in default directory. If not, update JavaScript/CSS includes and fromRes.php the path to getDetails.py
* In this version, it only supports services/resources with commands but no inputs to those commands. This feature is coming soon.