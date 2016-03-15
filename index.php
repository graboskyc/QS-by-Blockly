<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QS by Blockly</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
        }
        
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
    </style>

    <script src="blockly_compressed.js"></script>
    <script src="blocks_compressed.js"></script>
    <script src="python_compressed.js"></script>
    <script src="msg/js/en.js"></script>
    <script src="blocks/Quali.js"></script>
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">QS by Blockly</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Restart</a></li>
                </ul>
                
                <button class="btn btn-success navbar-right" onclick="showCode()" style="margin-top: 7px;">Generate Python</button>
                
                <form class="navbar-form navbar-right" action="index.php" method="GET">
                    <div class="form-group">
                        <?php
                        if (!empty($_GET['resid'])) { $defval = "value='".$_GET['resid']."'"; } else { $defval = ''; }
                        ?>
                        <input type="text" placeholder="resID" class="form-control" name="resid" id="resid" <?php echo $defval; ?> />
                    </div>
                    <button type="submit" class="btn btn-primary">Load Reservation</button>
                    
                </form>
                
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="starter-template">
            <p><i>Valid sample IDs are: <a href="index.php?resid=9271c598-2adc-417d-bf63-c0f424097242">9271c598-2adc-417d-bf63-c0f424097242</a> and <a href="index.php?resid=b7935bd6-9ef0-45fa-9821-3c21e090ba88">b7935bd6-9ef0-45fa-9821-3c21e090ba88</a></i></p>
            <div id="blocklyDiv" style="float:left;height: 800px; width: 1000px;"></div>
        </div>
    </div>
    
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">CloudShell Environment Python Script</h4>
            </div>
            <div class="modal-body">
                <div id="codediv" style="overflow:scroll;">
                    <pre id="code" style="font-size:10px;"></pre>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

<?php
  if (!empty($_GET['resid'])) {
?>
  <xml id="startBlocks" style="display: none">
  <block type="qs_initializeapi" id="qsiapi" x="20" y="120">
      <next>
        <block type="text_print" id="txtpr000">
            <value name="TEXT"><block type="text" id="txtprst000000"><field name="TEXT">Generated all commands from all resource blocks.</field></block></value>
            <next>
                <block type="text_print" id="txtpr010">
                    <value name="TEXT"><block type="text" id="txtprst000010"><field name="TEXT">Drag, drop, reorder the above!</field></block></value>
                    <next>
                        <block type="qs_endapi" id="qsendapi">
                        </block>
                    </next>
                </block>
            </next>
        </block>
    </next>
  </block>
  <?php
    $command = '"C:\Program Files (x86)\QualiSystems\TestShell\ExecutionServer\python\2.7.10\python.exe" C:\inetpub\wwwroot\getDetails.py ' . $_GET['resid'];
    $output = shell_exec($command);
    echo $output;
  }
  else {
  ?>
   <xml id="startBlocks" style="display: none">
  <block type="qs_initializeapi" id="qsiapi" x="20" y="20">
      <next>
          <block type="qs_resstat" id="qsresstat">
              <next>
          <block type="qs_write" id="qswrmsg0012345678">
              <value name="Message"><block type="text" id="qsmsga00val"><field name="TEXT">Activating L1...</field></block></value>
              <next>
                <block type="qs_activatel1" id="qsactl1">
                    <value name="TopologyName"><block type="text" id="qsmsga00val"><field name="TEXT">TopoNameHere</field></block></value>
                    <next>
                        <block type="qs_execmd" id="qsexe0012345678">
                            <value name="cmd"><block type="text" id="qscmd00val"><field name="TEXT">CmdName</field></block></value>
                            <value name="name"><block type="text" id="qscmd01val"><field name="TEXT">ResourceName</field></block></value>
                            <next>
                                <block type="text_print" id="txtpr000">
                                    <value name="TEXT"><block type="text" id="txtprst000000"><field name="TEXT">Completed running the python script</field></block></value>
                                    <next>
                                        <block type="qs_endapi" id="qsendapi">
                                        </block>
                                    </next>
                                </block>
                            </next>
                        </block>
                    </next>
                </block>
              </next>
          </block>
          </next>
          </block>
      </next>
  </block>
</xml>
  <?php
  }
  ?>
    <xml id="toolbox" style="display: none">
        <category name="Quali">
            <block type="qs_initializeapi"></block>
            <block type="qs_activatel1"></block>
            <block type="qs_resstat"></block>
            <block type="qs_write"></block>
            <block type="qs_execmd"></block>
            <block type="qs_exeall"></block>
            <block type="qs_waitnovm"></block>
            <block type="qs_endapi"></block>
        </category>
        <category name="Logic">
            <block type="controls_if"></block>
            <block type="logic_compare"></block>
            <block type="logic_operation"></block>
            <block type="logic_negate"></block>
            <block type="logic_boolean"></block>
        </category>
        <category name="Loops">
            <block type="controls_repeat_ext">
                <value name="TIMES">
                    <block type="math_number">
                        <field name="NUM">10</field>
                    </block>
                </value>
            </block>
            <block type="controls_whileUntil"></block>
        </category>
        <category name="Text">
            <block type="text"></block>
            <block type="text_length"></block>
            <block type="text_print"></block>
        </category>
    </xml>


    <xml id="startBlocks" style="display: none">
        <block type="qs_initializeapi" id="qsiapi" x="20" y="20">
            <next>
                <block type="qs_resstat" id="qsresstat">
                    <next>
                        <block type="qs_write" id="qswrmsg0012345678">
                            <value name="Message">
                                <block type="text" id="qsmsga00val">
                                    <field name="TEXT">Activating L1...</field>
                                </block>
                            </value>
                            <next>
                                <block type="qs_activatel1" id="qsactl1">
                                    <value name="TopologyName">
                                        <block type="text" id="qsmsga00val">
                                            <field name="TEXT">TopoNameHere</field>
                                        </block>
                                    </value>
                                    <next>
                                        <block type="qs_execmd" id="qsexe0012345678">
                                            <value name="cmd">
                                                <block type="text" id="qscmd00val">
                                                    <field name="TEXT">CmdName</field>
                                                </block>
                                            </value>
                                            <value name="name">
                                                <block type="text" id="qscmd01val">
                                                    <field name="TEXT">ResourceName</field>
                                                </block>
                                            </value>
                                            <next>
                                                <block type="text_print" id="txtpr000">
                                                    <value name="TEXT">
                                                        <block type="text" id="txtprst000000">
                                                            <field name="TEXT">Completed running the python script</field>
                                                        </block>
                                                    </value>
                                                    <next>
                                                        <block type="qs_endapi" id="qsendapi">
                                                        </block>
                                                    </next>
                                                </block>
                                            </next>
                                        </block>
                                    </next>
                                </block>
                            </next>
                        </block>
                    </next>
                </block>
            </next>
        </block>
    </xml>

    <script>
        var workspace = Blockly.inject('blocklyDiv',
        {media: 'media/',
         toolbox: document.getElementById('toolbox')});
    Blockly.Xml.domToWorkspace(workspace,
        document.getElementById('startBlocks'));
        

    function showCode() {
      // Generate JavaScript code and display it.
      Blockly.Python.INFINITE_LOOP_TRAP = null;
      var code = Blockly.Python.workspaceToCode(workspace);
      document.getElementById('code').innerHTML=code;
      $('#myModal').modal('show');
    }
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>