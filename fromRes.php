<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Blockly Demo: Generating JavaScript</title>
  <script src="blockly_compressed.js"></script>
  <script src="blocks_compressed.js"></script>
  <script src="python_compressed.js"></script>
  <script src="msg/js/en.js"></script>
  <script src="blocks/Quali.js"></script>
  <style>
    body {
      background-color: #fff;
      font-family: sans-serif;
    }
  </style>
</head>
<body>
    <h1>QS by Blockly: The CloudShell Environment Orchestration Python Script Builder</h1>
    <h2>Use drag and drop code here, press the generate button, get python script!</h2>
  <div id="blocklyDiv" style="float:left;height: 800px; width: 1000px;"></div>
  <div id="codediv" style="float:left;height: 800px; width: 400px;border-style:solid;overflow:scroll;">
      <h3>CloudShell Python Code <button onclick="showCode()">Generate Python</button></h3>
      <pre id="code"></pre>
  </div>

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
  
  <!-- start default blocks -->
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
  <!-- end default blocks -->
  
  <!-- start dynamic blocks -->
  <?php
  if (!empty($_GET['resid'])) {
    $command = '"C:\Program Files (x86)\QualiSystems\TestShell\ExecutionServer\python\2.7.10\python.exe" C:\inetpub\wwwroot\getDetails.py ' . $_GET['resid'];
    $output = shell_exec($command);
    echo $output;
  }
  ?>
 <!-- end dynamic blocks -->
</xml>

  <script>
    var workspace = Blockly.inject('blocklyDiv',
        {media: 'media/',
         toolbox: document.getElementById('toolbox')});
    Blockly.Xml.domToWorkspace(workspace,
        document.getElementById('startBlocks'));
        

    function showCode() {
      Blockly.Python.INFINITE_LOOP_TRAP = null;
      var code = Blockly.Python.workspaceToCode(workspace);
      document.getElementById('code').innerHTML=code;
    }

  </script>

</body>
</html>
