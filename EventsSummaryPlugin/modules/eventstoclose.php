<?php
$layout['pagetitle'] = trans('Events close');

function getEventsToClose($userid) {
    global $LMS, $SMARTY, $SESSION;
    $db = LMSDB::getInstance();

    $events = $db->GetAll('SELECT from_unixtime(e.date, \'%Y-%m-%d\') AS startdate, e.title, e.id
			FROM events e, eventassignments ea WHERE e.closed=0 AND ea.userid='.$userid.' AND e.id=ea.eventid');
    return $events;
}

$SMARTY->assign('events', getEventsToClose($_GET['userid']));
$SMARTY->display('eventstoclose.html');
?>
