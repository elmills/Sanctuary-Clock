# Sanctuary-Clock
Set of scripts built on a raspberry pi running [fullpageOS] (https://github.com/guysoft/FullPageOS) to help manage timing for worship services and speaking.  This would kindly be called a "hack", but it gets the job done and allows our team to do what needs to be done.

**THIS SETUP IS NOT APPROPRIATE FOR PUBLIC NETWORK OR INTERNET USE**

Please, please, only use this on your internal network, preferably a locked down one seperate from your public wifi.

Steps to setup software/scripts
1. Install and setup FullPageOS following links above.  It works best if you get a static ip and/or you give the PI a static reseveration in DHCP>
2. Copy files in /html folder to /var/www/html folder
3. Copy files in /scripts to any location on your Raspberry PI, but /scripts works...
4. edit /boot/fullpageos.txt to point towards 127.0.0.1/index.php
5. Edit Crontab to meet your needs, using Crontabexamples.txt
  * off.sh turns off the screen
  * on.sh turns on the screen
  * refresh.sh refreshes the screen as needed to restart/reset clocks
  * To set specific times as needed set 9AMService.sh as an example

**Notes**
* Time is stored in time.txt as:
  HH:MM<br />
  HH:MM 
  
  with the first HH:MM being the start time and the second being the end time.
* "Warning time is set for 5 minutes before time expires, this can be changed in line 164 of the index.php script
* Screensize can be changed as needed .shape css in index.php file

 
Pictures of how the setup works:
Going from Gray to Green for 5 minute warning <br />
![Timer Goes to Warning](https://www.elmills.net/img/graytogreen.gif)
<br />
Going from Green to Red to indicate going over time.<br />
![Timer Expires](https://www.elmills.net/img/giphy.gif)
