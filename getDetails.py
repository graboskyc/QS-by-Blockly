import os
import json
import sys
import argparse
import qualipy.api.cloudshell_api


parser = argparse.ArgumentParser(description='Convert a QualiSystems CloudShell Reservation ID into the XML needed to build Blockly blocks.')
parser.add_argument('-s', action="store", dest="host", help="server hostname for API session")
parser.add_argument('-u', action="store", dest="un", help="username for API session")
parser.add_argument('-p', action="store", dest="pw", help="password for API session")
parser.add_argument('-d', action="store", dest="dom", help="domain for API session")
parser.add_argument('-r', action="store", dest="resid", help="reservation ID to query")
arg = parser.parse_args()

csapi = qualipy.api.cloudshell_api.CloudShellAPISession(arg.host, arg.un, arg.pw, arg.dom)

rdet=csapi.GetReservationDetails(arg.resid)
sList = []
rList = []

x=0
y=0

for resource in rdet.ReservationDescription.Resources:
    newR = {}
    newR["name"] = resource.Name
    newR["cmds"] = []
    try:
        resource_commands = csapi.GetResourceCommands(resource.Name)
        for command in resource_commands.Commands:
            if(len(command.Parameters) == 0):
                newR["cmds"].append(command.Name)
                x = x+10
                y = y+20
                print '<block type="qs_execmd" x="'+str(x)+'" y="'+str(y)+'"><value name="cmd"><block type="text" ><field name="TEXT">'+command.Name+'</field></block></value><value name="name"><block type="text"><field name="TEXT">'+resource.Name+'</field></block></value></block>'

    except:
        pass
    rList.append(newR)
    
for service in rdet.ReservationDescription.Services:
    newS = {}
    newS["name"] = service.Alias
    newS["cmds"] = []

    resource_commands = csapi.GetServiceCommands(service.ServiceName)
    for command in resource_commands.Commands:
        if(len(command.Parameters) == 0):
            newS["cmds"].append(command.Name)
            x = x+10
            y = y+20
            print '<block type="qs_execmd" x="'+str(x)+'" y="'+str(y)+'"><value name="cmd"><block type="text" ><field name="TEXT">'+command.Name+'</field></block></value><value name="name"><block type="text"><field name="TEXT">'+service.Alias+'</field></block></value><field name="type">service</field><value name="TEXT"></value></block>'
    sList.append(newS)

csapi.Logoff()