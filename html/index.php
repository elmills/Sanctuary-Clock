<?php
$handle = fopen("time.txt", "r");
$stime = trim(fgets($handle));
$etime = trim(fgets($handle));
fclose($handle);

$StartTime = DateTime::createFromFormat('H:i',$stime);
$StartTimeMinus5 = DateTime::createFromFormat('H:i',$stime);
$EndTime = DateTime::createFromFormat('H:i', $etime);
$CurrentTime = new DateTime();
$StartTimeMinus5->sub(new DateInterval('PT5M'));

/*
echo 'Start Time: ' .$StartTime->format('Y-m-d H:i:s') . "<br />";
echo 'End Time: ' .$EndTime->format('Y-m-d H:i:s') . "<br />";
echo 'Current Time: ' .$CurrentTime->format('Y-m-d H:i:s') . "<br />";
echo 'Start -5 Time: ' .$StartTimeMinus5->format('Y-m-d H:i:s') . "<br />";
*/

if ($CurrentTime < $StartTime && $CurrentTime > $StartTimeMinus5 ) {
  $Status = 1;
}elseif ($StartTime <= $CurrentTime  && $CurrentTime < $EndTime) {
  $Status = 2;
}else{
  $Status = 3;
}

//echo $Status;

?>

<html>
<head>
<script src="jquery-3.1.1.js"></script>
<script src="jquery.countdown.js"></script>
<script>
  function checkTime(i) {
    return (i < 10) ? "0" + i : i;
  }

  function startTime() {
      var today = new Date(),
      h = checkTime(today.getHours()),
      m = checkTime(today.getMinutes()),
      s = checkTime(today.getSeconds());
      h = (h > 12)? h - 12: h;
    document.getElementById('ctime').innerHTML =  h + ":" + m ;
    t = setTimeout(function() {
      startTime()
    }, 500);
  }

</script>
<style>
  
.time {
  color:white;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 405px;
  font-weight: 600;
  }

.cdown {
  color:white;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 400px;
  font-weight: 600;
  padding-right: 5px;
  padding-left:-2px;
  margin-right:20px;
  margin-bottom:20px;
  }


body {
    background-color:grey;
    overflow:hidden;
  }

.top { 
		text-align: center;
    vertical-align: middle;
    }

.bottom { 
    position: relative;
    text-align: center;
    }

.shape{
  height:1024px;
  max-height:1024px;
  width: 1260px; 
  display:block;
  table-layout:fixed;
  }

  td {
     width: 1260px; 
     height: 512px;
  }

html {
  -ms-overflow-style: -ms-autohiding-scrollbar;
}
 
</style>
</head>
<body onload="startTime()">
<table class="shape">
  <tr>
  <td style="height: 512px;">
   <div class='top'>
  <span class="time"><span id="ctime"></span></span>
  </div>
  
  </td>
 </tr>
 <tr>
  <td style="height: 512px;">
  <div class="bottom">
  <span class="cdown"><span id="countdown"></span></span>
  <script type="text/javascript">
  var today = new Date();
    y = today.getFullYear(),
    Mon = today.getMonth() + 1,
    day = today.getDate(),
    d = today.getDay();
    var Status = "<?php echo $Status; ?>"; 
    var Stime = "<?php echo $stime; ?>"; 
    var Etime = "<?php echo $etime; ?>"; 


    //Check for today set to Sunday
      var CDTime = y+'/'+Mon+'/'+day + ' ';
      if(Status == 1) {
       CDTime = CDTime + Stime +':00';
      // window.alert(CDTime+"Path 1");
      $('#countdown').countdown(CDTime, {elapse: false})
        .on('update.countdown', function(event) {
          var format = '%N:%S';
          document.getElementById('countdown').style.background="blue";
          $(this).html(event.strftime(format));
        })
        .on('finish.countdown', function(event){
          location.reload();
        });
    
    }else if (Status == 2) {
    //9-1015  Countdown to 1015 with 5 minute rollover
    CDTime = CDTime + Etime +':00';
    //window.alert(CDTime+"P");

          $('#countdown').countdown(CDTime, {elapse: true})
        .on('update.countdown', function(event) {
          var format = '%N:%S';
          if (event.elapsed && event.offset.totalMinutes < 1) {
            document.getElementById('countdown').style.background="red";
          }else if(event.elapsed && event.offset.totalMinutes > 0) {
            //ProdCode
            document.getElementById('countdown').style.display="none";
            //Test OutCome 
            //document.getElementById('countdown').style.background="blue";
          } else if (event.elapsed === false && event.offset.totalMinutes < 5) {
            document.getElementById('countdown').style.background="green";
          }
           $(this).html(event.strftime(format));
        });

    }else{
      //window.alert('Not Status 1 or 2');
      document.getElementById('countdown').style.background="blue";
    }


  </script>
  <div>

  </td>
 </tr>
</table> 
 

</body>
</html>
