# About this Repo
The purpose of this repo is to quickly build out QualiSystems CloudShell environment python scripts via a drag-and-drop interfacce. 

While building a Setup driver or script is relatively simple, much of the process is boilerplate code. Also the process of identifying the exact resource and service names is error prone. Worse, finding the exact name of a command can be problematic since the command pane shows the alias, not the real command name. This causes the author to go back and forth between many locations. This holds true for any inputs as well. This tool aims at solving that by pulling in all resource and service commands by their exact names, as well as their inputs. The resulting generated python code may be 100% complete for simple situations or a great starting point for more complex orchestration scripts.

There are two projects here, the web interface (every file and directory not in the CS folder) and a self contained service that will act as a mini webserver. If modifying the service code, note that when you compile the project in CloudShell Authoring, you must manually copy all other assets from this project into a folder called www inside the authoring directory. Then compile and deploy and it will start the site.

# Latest updates
## Features of note in this version
* Support to run as a CloudShell service, simplifying deployment on site

## Features of note in revious versions
* Can upload the script to CloudShell without having to do it manually (downloading .py file, logging in, uploading)
* Can download the generated XML and PY files rather than having to copy/paste into text docs
* Updated the canvas to be more readable and with more controls (like zoom)
* Version beta0.8.0.0 of the code generator introduces commands with and without inputs
* The canvas now supports lists (required for the above) as well as variables

# Deployment
## Option 1 - Hosted:
Requires PHP webserver and CloudShell 6.4 with python. Webserver must be able to talk to Quali server to upload scripts or pull data about reservations.
* Dump the entire contents of this repo (except the CS directory) folder into an IIS or Apache website. 
* Edit config.php to change any parameters there
* Visit index.php and you are good to go! 

## Option 2 - CloudShell Service
Assumes your execution server is on Windows, Running CloudShell 6.4 in the default locations
* Import the Environment package CS\Python Generator EnvPkg.zip into your CloudShell server
* Reserve the environment and run the command StartGenerator with an available port (like 7777). When ready, the output will tell you where to go to generate code

# Content
Main content of custom Blockly Blocks is created in the index.php and blocks/Quali.js

Additionally, there is a python script getDetails.py which uses the CloudShell API to find all resources and services with commands in a given reservation and prepopulate the startblock on the canvas with those commands.

# Assumptions/Limitations for Deployment 1
* PHP is intalled
* CloudShell is installed with API version compatibility with 6.4
* Python for CloudShell is installed in the default location (see index.php) and edit that if it changed.
* Deployed on IIS in default directory. If not, update JavaScript/CSS includes and configuration settings in config.php
* Running on Windows and if you try and upload something, the script needs write access to c:\temp