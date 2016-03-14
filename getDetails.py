import os
import json
import sys
import qualipy.api.cloudshell_api


csapi = qualipy.api.cloudshell_api.CloudShellAPISession("localhost", "admin", "admin", "Global")

rdet=csapi.GetReservationDetails(sys.argv[1])
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
                print '<block type="qs_execmd" x="'+str(x)+'" y="'+str(x)+'"><value name="cmd"><block type="text" ><field name="TEXT">'+command.Name+'</field></block></value><value name="name"><block type="text"><field name="TEXT">'+resource.Name+'</field></block></value></block>'

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
            print '<block type="qs_execmd" x="'+str(x)+'" y="'+str(x)+'"><value name="cmd"><block type="text" ><field name="TEXT">'+command.Name+'</field></block></value><value name="name"><block type="text"><field name="TEXT">'+service.Alias+'</field></block></value></block>'
    sList.append(newS)

csapi.Logoff()