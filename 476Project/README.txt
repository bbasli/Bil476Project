For Windows
	1)download and install xampp (https://www.apachefriends.org/download.html)
	2)Start apache and mysql from xampp Control panel
	3)Download all https://github.com/bbasli/Bil476Project
	4)Go to xampp folder (usally C:\xampp).
	5)Copy downloaded github repository inside to htdocs folder in xampp folder.
	6)Open browser then copy this link to search bar (localhost/476Project).

NOTE: It may take some time to create the database (max:1-2mins)
	if you have an error like "Fatal error: Maximum execution time of 120 seconds exceeded in C:\xampp\htdocs\476Project\index.php on line 61"
	Find php.ini file (usually in C:\xampp\php\php.ini)
	After find php.ini, find this line "max_execution_time = 30" in php.ini and set this like "max_execution_time=360" and try again.
