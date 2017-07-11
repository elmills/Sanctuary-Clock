<?php

$msg = '';
$output = '';
$StartTime = '';
$EndTime = '';

if (isset($_POST['TimeChange'])) 
{ 
	$StartTime  = $_POST['stime'];
	$EndTime  = $_POST['etime'];
	IF ($StartTime < $EndTime) {
		$myfile = fopen("time.txt", "w") or die("Unable to open file!");
		$txt = $StartTime."\n".$EndTime;
		fwrite($myfile, $txt);
		fclose($myfile);


		$msg = 'Setting Time.  You will need to hit refresh button 5 minutes before your event to start the timing.';

	}else{
		$msg = 'Start Time MUST be before END Time';
	}
}

if (isset($_POST['ScreenOn'])) 
{ 
   $output = shell_exec('sudo -u pi sh /scripts/on.sh');
   $msg = 'Screen On';
}  

if (isset($_POST['ScreenOff'])) 
{ 
   $output = shell_exec('sudo -u pi sh /scripts/off.sh');
   $msg = 'Screen Off';
}  

if (isset($_POST['ScreenRefresh'])) 
{ 
	$output = shell_exec('sudo -u pi sh /scripts/refresh.sh');
   $msg = 'Screen Refresh';
}  


?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Countdown Management</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
</head>

<body>
  <h1>Count Down Management Page
  </h1>
  <h2>
        <?php
              If ($msg != '') {echo $msg."<br />";}
              If ($output != '') {echo $output."<br />";}
              If ($StartTime != '') {echo $StartTime."<br />";}
              If ($EndTime != '') {echo $EndTime;}
        ?>
  </h2>
  <div>
        <form action="manage.php" method="post">
                <input type="submit" name="ScreenOn" value="Screen On">
        </form>
  </div>
        <br />
  <div>
        <form action="manage.php" method="post">
                <input type="submit" name="ScreenOff" value="Screen Off">
        </form>
  </div>
        <br />

  <div>
        <form action="manage.php" method="post">
                <input type="submit" name="ScreenRefresh" value="Screen Refresh">
        </form>
  </div>
  <div>
  <h1>Set Custom Service Time</h1>
  <h3><i>Only use this section if it is not a Sunday Morning service at its normal time and only edit with Chrome!</i></h2>
  <form action="manage.php"  method="post">
  Select Start time:
  <input type="time" name="stime">
  <br />
  Set End time:
  <input type="time" name="etime">
  <input type="hidden" name="TimeChange" value="1">
  <br />
  <input type="submit">
</form>
  </div>



  <footer>
  </footer>

  <script src=""></script>
</body>

<html>

<?

?>
