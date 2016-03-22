# About this Repo
The purpose of this repo is to quickly build out QualiSystems CloudShell environment python scripts via a drag-and-drop interfacce. 

While building a Setup driver or script is relatively simple, much of the process is boilerplate code. Also the process of identifying the exact resource and service names is error prone. Worse, finding the exact name of a command can be problematic since the command pane shows the alias, not the real command name. This causes the author to go back and forth between many locations. This holds true for any inputs as well. This tool aims at solving that by pulling in all resource and service commands by their exact names, as well as their inputs. The resulting generated python code may be 100% complete for simple situations or a great starting point for more complex orchestration scripts.

In this latest build, it is still a proof of concept. However we have added the functionality to load a reservation's details out of a CloudShell instance and make building blocks out of it to make an orchestration script quickly.

# New in this version
* Can download the generated XML and PY files rather than having to copy/paste into text docs
* Updated the canvas to be more readable and with more controls (like zoom)
* Version beta0.8.0.0 of the code generator introduces commands with and without inputs
* The canvas now supports lists (required for the above) as well as variables

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