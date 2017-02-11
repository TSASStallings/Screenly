<?php
// determine path, css filename and view mode
$calendarpath="https://calendar.google.com/calendar/embed?src=tsas.org_2d39323437313838312d383531%40resource.calendar.google.com&ctz=America/Chicago";
$newcss="google_calendar.css";
$defaultview=($_GET["v"]) ? $_GET["v"] : "month";
// import the contents of the Google Calendar page into a string
$contents = file_get_contents($calendarpath);
// add secure Google address to root relative links
$contents = str_replace('<link type="text/css" rel="stylesheet" href="//www.google.com/calendar/', '<link type="text/css" rel="stylesheet" href="https://www.google.com/calendar/', $contents );
$contents = str_replace('<script type="text/javascript" src="//www.google.com/calendar/', '<script type="text/javascript" src="https://www.google.com/calendar/' , $contents );
// inject css file reference
$contents = str_replace('<script>function _onload()', '<link rel="stylesheet" type="text/css" href="'.$newcss.'" /><script>function _onload()', $contents );
// update settings found in javascript _onload() function
$contents = str_replace('"view":"month"', '"view":"'.$defaultview.'"', $contents);
$contents = str_replace('"showCalendarMenu":true', '"showCalendarMenu":false', $contents);
if($defaultview == "month") $contents = str_replace('"showDateMarker":true', '"showDateMarker":false', $contents);
if($defaultview != "month") $contents = str_replace('"showTabs":true', '"showTabs":false', $contents);
echo $contents;
?>
