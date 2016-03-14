///////////////////////////////
// Initialize API / End API
///////////////////////////////
Blockly.Blocks['qs_initializeapi'] = {
  init: function() {
    this.appendDummyInput().appendField('Initialize API Session');
    this.setNextStatement(true);
    this.setColour(184);
    this.setInputsInline(true);
    this.setTooltip('Initialize API');
    this.setDeletable(false);
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/API/Pyth-API-Dev.htm');
  }
};
Blockly.Python['qs_initializeapi'] = function(block) {
  var d = new Date().toLocaleString();

  return '##########################################\n\
# Autogenerated code via QS by Blockly\n\
# https://github.com/graboskyc/QS-by-Blockly \n\
# QS by Blockly creater Chris Grabosky <chris.g@qualisystems.com>\n\
# Generated at '+d+' via version 0.6.0.1 \n\
# Target CloudShell version 6.4 environment script \n\
##########################################\n\
import os \n\
import json\n\
import time\n\
import qualipy.api.cloudshell_api\n\
reservation = json.loads(os.environ["RESERVATIONCONTEXT"])\n\
connectivity = json.loads(os.environ["QUALICONNECTIVITYCONTEXT"])\n\
csapi = qualipy.api.cloudshell_api.CloudShellAPISession(connectivity["serverAddress"], connectivity["adminUser"], connectivity["adminPass"], reservation["domain"])\n\n';
};

Blockly.Blocks['qs_endapi'] = {
  init: function() {
    this.setPreviousStatement(true);
    this.appendDummyInput().appendField('End API Session');
    this.setColour(184);
    this.setInputsInline(true);
    this.setTooltip('End API');
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/API/Pyth-API-Dev.htm');
  }
};
Blockly.Python['qs_endapi'] = function(block) {
  return 'csapi.Logoff()\n\n';
};

///////////////////////////////
// Activate Topology
///////////////////////////////
Blockly.Blocks['qs_activatel1'] = {
  init: function() {
    this.setPreviousStatement(true);
    this.setNextStatement(true);
    this.setColour(184);
    this.setInputsInline(true);
    this.setTooltip('Avtivate L1');
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/Admn/Cnct-Ctrl-L1-Swch.htm?Highlight=l1');
    this.appendDummyInput()
        .appendField("Activate the L1 in the topology called");
    this.appendValueInput("TopologyName")
        .setCheck("String");
    }
};
Blockly.Python['qs_activatel1'] = function(block) {
  var value_topologyname = Blockly.Python.valueToCode(block, 'TopologyName', Blockly.Python.ORDER_ATOMIC);
  return 'csapi.ActivateTopology(reservation["id"], '+value_topologyname+')\n\n';
};

///////////////////////////////
// Write Message
///////////////////////////////
Blockly.Blocks['qs_write'] = {
  init: function() {
    this.setPreviousStatement(true);
    this.setNextStatement(true);
    this.setColour(184);
    this.setInputsInline(true);
    this.setTooltip('Write message to output saying ');
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/API/Pyth-API-Accs.htm');
    this.appendDummyInput()
        .appendField("Write an output message saying ");
    this.appendValueInput("Message")
        .setCheck("String");
    }
};
Blockly.Python['qs_write'] = function(block) {
  var value_msg = Blockly.Python.valueToCode(block, 'Message', Blockly.Python.ORDER_ATOMIC);
  return 'csapi.WriteMessageToReservationOutput(reservation["id"], "'+value_msg+'")\n\n';
};



///////////////////////////////
// Execute Command
///////////////////////////////
Blockly.Blocks['qs_execmd'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("Execute a command ");
    this.appendValueInput("cmd")
        .setCheck("String")
        .appendField("called");
    this.appendDummyInput()
        .appendField(new Blockly.FieldDropdown([["syncronously", "1"], ["asyncronously", "2"]]), "sync");
    this.appendValueInput("name")
        .setCheck("String")
        .appendField("on a")
        .appendField(new Blockly.FieldDropdown([["resource", "Resource"], ["service", "Service"]]), "type")
        .appendField("named");
    this.setInputsInline(true);
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(184);
    this.setTooltip('Execute command');
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/API/Pyth-API-Accs.htm');
  }
};

Blockly.Python['qs_execmd'] = function(block) {
  var dropdown_type = block.getFieldValue('type');
  var value_name = Blockly.Python.valueToCode(block, 'name', Blockly.Python.ORDER_ATOMIC);
  var value_cmd = Blockly.Python.valueToCode(block, 'cmd', Blockly.Python.ORDER_ATOMIC);
  var dropdown_sync = block.getFieldValue('sync');
  var dropdown_type = block.getFieldValue('type');
  cmd = "";
  if (dropdown_sync == "1"){
    cmd = 'csapi.ExecuteCommand(reservation["id"],'+value_name+',"'+dropdown_type+'",'+value_cmd+',[])\n\n';
  }
  else {
    cmd = 'csapi.EnqueueCommand(reservation["id"],'+value_name+',"'+dropdown_type+'",'+value_cmd+',[])\n\n';
  }
  return cmd;
};

///////////////////////////////
// Change status
///////////////////////////////
Blockly.Blocks['qs_resstat'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("Change reservation status to")
        .appendField(new Blockly.FieldDropdown([["Downloading", "Downloading"], ["Installing", "Installing"], ["Configuring", "Configuring"], ["In Progress", "In Progress"], ["Progress 0", "Progress 0"], ["Progress 10", "Progress 10"], ["Progress 20", "Progress 20"], ["Progress 30", "Progress 30"], ["Progress 40", "Progress 40"], ["Progress 50", "Progress 50"], ["Progress 60", "Progress 60"], ["Progress 70", "Progress 70"], ["Progress 80", "Progress 80"], ["Error", "Error"], ["Generating report", "Generating report"], ["Completed successfully", "Completed successfully"], ["Completed unsuccessfully", "Completed unsuccessfully"]]), "status");
    this.setInputsInline(true);
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(184);
    this.setTooltip('Set Reservation Status');
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/Admn/St-Rsrv-liv-stt.htm?Highlight=live%20status');
  }
};

Blockly.Python['qs_resstat'] = function(block) {
  var dropdown_status = block.getFieldValue('status');
  return 'csapi.SetReservationLiveStatus(reservation["id"],"'+dropdown_status+'","")\n\n';
};

///////////////////////////////
// Run CMD on all
///////////////////////////////
Blockly.Blocks['qs_exeall'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("Execute a command called")
        .appendField(new Blockly.FieldTextInput("cmdName"), "cmd")
        .appendField("on all resources and services async");
    this.setInputsInline(true);
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(184);
    this.setTooltip('Run command on everything');
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/API/Pyth-API-Accs.htm');
  }
};

Blockly.Python['qs_exeall'] = function(block) {
  var text_cmd = block.getFieldValue('cmd');
  // TODO: Assemble JavaScript into code variable.
  return 'rdet = csapi.GetReservationDetails(reservation["id"])\n\
for resource in rdet.ReservationDescription.Resources:\n\
\ttry:\n\
\t\tcsapi.EnqueueCommand(reservation["id"], resource.Name, "Resource", "'+text_cmd+'", [], True)\n\
\texcept:\n\
\t\tcontinue\n\
\n\
for service in rdet.ReservationDescription.Services:\n\
\ttry:\n\
\t\tcsapi.EnqueueCommand(reservation["id"], service.Alias, "Service", "'+text_cmd+'", [], True)\n\
\texcept:\n\
\t\tcontinue\n\n';
};

///////////////////////////////
// Wait for no VM services
///////////////////////////////
Blockly.Blocks['qs_waitnovm'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("Wait until no VM services are left");
    this.setInputsInline(true);
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(184);
    this.setTooltip('Wait for no VM services to be left in sandbox');
    this.setHelpUrl('http://help.qualisystems.com/Online%20Help/6.4.0.7907/Portal/Content/API/Pyth-API-Accs.htm');
  }
};

Blockly.Python['qs_waitnovm'] = function(block) {
  return 'servicesLeft = True\n\
firstRun = True\n\
while servicesLeft or firstRun:\n\
\ttime.sleep(15)\n\
\tfirstRun = False\n\
\tservicesLeft = False\n\
\trdet=csapi.GetReservationDetails(reservation["id"])\n\
\tfor service in rdet.ReservationDescription.Services:\n\
\t\tresource_commands = csapi.GetServiceCommands(service.ServiceName)\n\
\t\tfor command in resource_commands.Commands:\n\
\t\t\tif (command.Name == "CreateVMs"):\n\
\t\t\t\tservicesLeft = True\n\n';
};