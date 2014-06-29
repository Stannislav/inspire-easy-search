<!DOCTYPE html>
<html>
<head>
  <title>INSPIRE-HEP Easy Search</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link rel="stylesheet" href="mystyle.css">
  <link rel="icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABmJLR0QAAAAAAAD5Q7t/AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QkeDyQDvB8QrQAAAepJREFUOMudU01IVFEU/t78mlDWrnZtLIhA6ClEIhT9UlQUloJFGfKGRINauMnAXUw/i4rISRdqCG6KMB+JoTiazCT4N1ZaUwttY2UxvWbmzbwZ+Vw859HzjYP0bc6955z7ne/ce65AklhB64tB2B1OVJ8qxbrBFcgDQWKPhxAlTszOc72wZYi+Kxog6GJcTrupyJvgR/z4rSAQ+golqmZXQJLTn+e4sPjHVOFOey8hSoQo8VHXAJNayhTHaklqNGKs+0dnuONMIyFK3H2+KWsLBsFYTwt9ksjhjib2DIV4+sZjPpMD1FJpett6qSa0rASOTCubt24HAMjBMMRtGl7erzXabLh0dM1HMC7RlrcJAHDuWBnKD4mWxG7/FIRiD4RiD/ZL9wy/oWBjwRYAwKu302h532k6bLfZ0D00Zez942ErgcPpBgBUHinBzoNVFgV/4wl0yEG9WL7bSpBB83M/iuKFuHxyn8nvrT+LmJrEBrcLvpsXrHMQWZijTxIZet3KvsAHHr/2kCOTX0iSwxNhKlE19yQupTUAQDwWw+G9uyA/qMf47DxKr3hRVnMXV2935n6FtJbQbSppBOsqDiDP5dTH+d1MboK48ku3kZ+mhKeNF3Gr5gT6n1xHeUMzJj99M8WFf7/z/2AZsYiBq7PdUZUAAAAASUVORK5CYII="
  type="image/png"> 
  <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABmJLR0QAAAAAAAD5Q7t/AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QkeDyQDvB8QrQAAAepJREFUOMudU01IVFEU/t78mlDWrnZtLIhA6ClEIhT9UlQUloJFGfKGRINauMnAXUw/i4rISRdqCG6KMB+JoTiazCT4N1ZaUwttY2UxvWbmzbwZ+Vw859HzjYP0bc6955z7ne/ce65AklhB64tB2B1OVJ8qxbrBFcgDQWKPhxAlTszOc72wZYi+Kxog6GJcTrupyJvgR/z4rSAQ+golqmZXQJLTn+e4sPjHVOFOey8hSoQo8VHXAJNayhTHaklqNGKs+0dnuONMIyFK3H2+KWsLBsFYTwt9ksjhjib2DIV4+sZjPpMD1FJpett6qSa0rASOTCubt24HAMjBMMRtGl7erzXabLh0dM1HMC7RlrcJAHDuWBnKD4mWxG7/FIRiD4RiD/ZL9wy/oWBjwRYAwKu302h532k6bLfZ0D00Zez942ErgcPpBgBUHinBzoNVFgV/4wl0yEG9WL7bSpBB83M/iuKFuHxyn8nvrT+LmJrEBrcLvpsXrHMQWZijTxIZet3KvsAHHr/2kCOTX0iSwxNhKlE19yQupTUAQDwWw+G9uyA/qMf47DxKr3hRVnMXV2935n6FtJbQbSppBOsqDiDP5dTH+d1MboK48ku3kZ+mhKeNF3Gr5gT6n1xHeUMzJj99M8WFf7/z/2AZsYiBq7PdUZUAAAAASUVORK5CYII="
  type="image/png"> 
</head>

<body OnLoad="document.myForm.q.focus();">
<div class="mainDiv">
  <img src="logo.png" width="300" alt="INSPIRE-HEP Logo">
  <div class="textField">
    <h3>This site helps you to find the right journal in an easy way!</h3>
    <form action="<?php echo basename(__FILE__) ?>" method="get" name="myForm"> 
    <input  style="width:90%;height:50px;margin-top:0px;font-size:25px"
            type="text"
            name="q"
            placeholder="   Author(s)?   Year?   Journal number?">
    </form>
  </div>
</div>
<?php
  $varQuery=stripslashes(htmlspecialchars($_GET['q']));
  if( !empty($varQuery) ) {
    $arrTokens=explode(" ", $varQuery);
    $arrAuthors=array();
    $varYear=0;
    $varJournal="";
    $varOutput="";

    for( $i=0; $i<count($arrTokens); ++$i ) {
      if( preg_match("/^[a-zA-Z]+$/", $arrTokens[$i]) ) {
        $arrAuthors[]=$arrTokens[$i];
      } elseif( preg_match("/^19[0-9]{2}$|^20[0-9]{2}$/", $arrTokens[$i]) ) {
        $varYear=$arrTokens[$i];
      } else {
        $varJournal=$arrTokens[$i];
      }
    }

    for ($i=0; $i<count($arrAuthors); ++$i ) {
      $varOutput.='a:'.$arrAuthors[$i].' ';
    }
    if( !empty($varJournal) ) {
     $varOutput.='j:"*'.$varJournal.'*" ';
    }
    if( !empty($varYear) ) {
      $varOutput.='d:'.$varYear.' ';
    }
    header("Location: http://inspirehep.net/search?p=".$varOutput);
  }
?>
<div class="help">
<h1>Help</h1>
  <ul>
    <li>No quotes</li>
    <li>Year matching patters: "19??" and "20??"</li>
    <li>Author matching pattern: strings not containing numbers</li>
    <li>The rest is matched as the journal number, examples "B327", "25", "Nucl*343".</li>
  </ul>
<h1>Hint: Add a keyword search to your browser</h1>
  <ul>
    <li>Firefox: Right-click in the text field, "Add keyword for this search...", specify the keyword, e.g. "i".</li>
    <li>Chrome: Right-click in the text field, "Add as search engine...", specify the keyword, e.g. "i".</li>
  </ul>
  Now you can search by typing "i" followed by a white space and the search query directly into the address bar
<h1>Examples</h1>
  <p><a href="<?php echo basename(__FILE__) ?>?q=shifman%20dvali%20b504">"shifman dvali b504"</a></p>
  <p><a href="<?php echo basename(__FILE__) ?>?q=witten%20olive">"witten olive"</a></p>
  <p><a href="<?php echo basename(__FILE__) ?>?q=ginzburg%20landau%20fiz*20">"ginzburg landau fiz*20"</a></p>
  <p><a href="<?php echo basename(__FILE__) ?>?q=seiberg%20b435">"seiberg b435"</a></p>
  <p><a href="<?php echo basename(__FILE__) ?>?q=mandula%20159">"mandula 159"</a></p>
  <p><a href="<?php echo basename(__FILE__) ?>?q=georgi%201974">"georgi 1974"</a></p>
</div>
<?php include_once("analyticstracking.php") ?>
</html>
