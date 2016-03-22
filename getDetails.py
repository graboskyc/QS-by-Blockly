import os
import json
import sys
import argparse
import qualipy.api.cloudshell_api

# Build CLI parser to get info. Should be passed in via CLI from PHP
parser = argparse.ArgumentParser(description='Convert a QualiSystems CloudShell Reservation ID into the XML needed to build Blockly blocks.')
parser.add_argument('-s', action="store", dest="host", help="server hostname for API session")
parser.add_argument('-u', action="store", dest="un", help="username for API session")
parser.add_argument('-p', action="store", dest="pw", help="password for API session")
parser.add_argument('-d', action="store", dest="dom", help="domain for API session")
parser.add_argument('-r', action="store", dest="resid", help="reservation ID to query")
arg = parser.parse_args()

# Connect to API
csapi = qualipy.api.cloudshell_api.CloudShellAPISession(arg.host, arg.un, arg.pw, arg.dom)

# get all info about reservation ID that was passed in
rdet=csapi.GetReservationDetails(arg.resid)

# create variable block with name of environment
print '<block type="variables_set"><field name="VAR">qs_TopoName</field><value name="VALUE"><block type="text"><field name="TEXT">'+rdet.ReservationDescription.Topologies[0]+'</field></block></value></block>\n\n'

# state trackers
x=0         # x coordinate offset for generated blockly blocks
y=0         # y coordinate offset for generated blockly blocks

# iterate over each resource
for resource in rdet.ReservationDescription.Resources:
    # try/catch as not every resource has commands
    try:
        resource_commands = csapi.GetResourceCommands(resource.Name)
        # for each resource command, add the correct block whether it has inputs or doesnt
        for command in resource_commands.Commands:
            x = x+10
            y = y+20
            
            if(len(command.Parameters) == 0):
                print '<block type="qs_execmd" x="'+str(x)+'" y="'+str(y)+'"><value name="cmd"><block type="text" ><field name="TEXT">'+command.Name+'</field></block></value><value name="name"><block type="text"><field name="TEXT">'+resource.Name+'</field></block></value></block>\n'
            else:
                print '<block type="qs_execmdinp" x="'+str(x)+'" y="'+str(y)+'">\n\t<value name="cmd">\n\t\t<block type="text" >\n\t\t\t<field name="TEXT">'+command.Name+'</field>\n\t\t</block>\n\t</value>'
                print '\t<value name="name">\n\t\t<block type="text">\n\t\t\t<field name="TEXT">'+resource.Name+'</field>\n\t\t</block>\n\t</value>'
                i = 0
                print '\t<value name="args">\n\t<block type="lists_create_with">\n\t\t<mutation items="'+str(len(command.Parameters))+'"></mutation>'
                for param in command.Parameters:
                    print '\n\t\t<value name="ADD'+str(i)+'">\n\t\t\t<block type="text">\n\t\t\t\t<field name="TEXT">'+param.Name+':'+param.DefaultValue+'</field>\n\t\t\t</block>\n\t\t</value>'
                    i = i + 1
                print '\t</block>\n</value></block>\n'
    except:
        pass
    
# ignore certain built in and normally hidden CloudShell commands
badServiceNames = ["BeforeMyServiceChanged_Sync", "OnReservationEnded_Sync", "BeforeReservationEnded_Sync", "BeforeResourceDisconnectedFromMe_Sync", "BeforeMyConnectionsChanged", "BeforeReservationTerminated_Sync", "RemoveVLAN", "CreateVLAN"]

for service in rdet.ReservationDescription.Services:
    # try/catch as not every service has commands
    try:
        resource_commands = csapi.GetServiceCommands(service.ServiceName)
        # for each resource command, add the correct block whether it has inputs or doesnt
        for command in resource_commands.Commands:
            x = x+10
            y = y+20
            if (command.Name not in badServiceNames):
                if(len(command.Parameters) == 0):
                    print '<block type="qs_execmd" x="'+str(x)+'" y="'+str(y)+'"><value name="cmd"><block type="text" ><field name="TEXT">'+command.Name+'</field></block></value><value name="name"><block type="text"><field name="TEXT">'+service.Alias+'</field></block></value><field name="type">service</field><value name="TEXT"></value></block>\n'
                else:
                    print '<block type="qs_execmdinp" x="'+str(x)+'" y="'+str(y)+'"><value name="cmd"><block type="text" ><field name="TEXT">'+command.Name+'</field></block></value><value name="name"><block type="text"><field name="TEXT">'+service.Alias+'</field></block></value><field name="type">service</field><value name="TEXT"></value>'
                    i = 0
                    print '\t<value name="args">\n\t<block type="lists_create_with">\n\t\t<mutation items="'+str(len(command.Parameters))+'"></mutation>'
                    for param in command.Parameters:
                        print '\n\t\t<value name="ADD'+str(i)+'">\n\t\t\t<block type="text">\n\t\t\t\t<field name="TEXT">'+param.Name+':'+param.DefaultValue+'</field>\n\t\t\t</block>\n\t\t</value>'
                        i = i + 1
                    print '\t</block>\n</value></block>\n'
    except:
        pass

csapi.Logoff()