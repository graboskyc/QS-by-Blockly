import os
import random
import zipfile
import argparse
import requests
import time

# Build CLI parser to get info. Should be passed in via CLI from PHP
parser = argparse.ArgumentParser(description='Generate and upload the zip file')
parser.add_argument('-s', action="store", dest="host", help="server hostname for API session")
parser.add_argument('-u', action="store", dest="un", help="username for API session")
parser.add_argument('-p', action="store", dest="pw", help="password for API session")
parser.add_argument('-d', action="store", dest="dom", help="domain for API session")
parser.add_argument('-i', action="store", dest="infile", help="in python script")
parser.add_argument('-o', action="store", dest="outfile", help="name of script in portal")
arg = parser.parse_args()

# functions for writing files, creating the zip
def zipdir(path, ziph):
    for root, dirs, files in os.walk(path):
        for file in files:
            ziph.write(os.path.join(root, file),os.path.relpath(os.path.join(root, file), os.path.join(path, '.')))
            
def writeFile(path, string):
    f = open(path, "w")
    f.write(string)
    f.close()

# temp directory
filename = "QS_By_Blockly_"+arg.outfile+"_"+str(random.randint(0,9999999))
folder = "C:\\temp\\"+filename
os.makedirs(folder)

# write the metadata out
metadata = """<?xml version="1.0" encoding="utf-8"?>
<Metadata xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://schemas.qualisystems.com/PackageMetadataSchema.xsd">
  <CreationDate>18/03/2016 09:48:32</CreationDate>
  <ServerVersion>6.4.0</ServerVersion>
  <PackageType>CloudShellPackage</PackageType>
</Metadata>"""
writeFile(folder+"\\metadata.xml", metadata)

# write topo script
os.makedirs(folder+"\\Topology Scripts")
os.rename(arg.infile, folder+"\\Topology Scripts\\"+arg.outfile+".py")

# write tmp folder contents to zip
zipf = zipfile.ZipFile(folder+".zip", 'w', zipfile.ZIP_DEFLATED)
zipdir(folder+"\\", zipf)
zipf.close()

# upload
r = requests.put('http://'+arg.host+':9000/Api/Auth/Login', {"username": arg.un, "password": arg.pw, "domain": arg.dom}) 
authcode = "Basic "+r._content[1:-1]
fileobj = open(folder+".zip", 'rb')
r = requests.post('http://'+arg.host+':9000/API/Package/ImportPackage',headers={"Authorization": authcode},files={"file": fileobj})

print r._content
print r.ok

# delete temp folder and zip
time.sleep(1)
for root, dirs, files in os.walk(folder, topdown=False):
    for name in files:
        os.remove(os.path.join(root, name))
    for name in dirs:
        os.rmdir(os.path.join(root, name))
os.rmdir(folder)
os.remove(folder+".zip")