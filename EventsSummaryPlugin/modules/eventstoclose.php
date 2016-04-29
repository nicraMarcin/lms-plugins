<?php

function getEventsToClose($userid) {
    global $LMS, $SMARTY, $DB, $SESSION;
    $events = $DB->GetAll('select from_unixtime(e.date, \'%Y-%m-%d\') AS startdate, e.title, e.id
FROM events e, eventassignments ea where e.closed=0 and ea.userid='.$userid.' and e.id=ea.eventid');
    return $events;
}

$SMARTY->assign('events', getEventsToClose($_GET['userid']));
$SMARTY->display('eventstoclose.html');
?>
