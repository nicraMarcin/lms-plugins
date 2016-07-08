<?php

$layout['pagetitle'] = trans('Events summary');

function getEventsToCloseWithoutAssign() {
    global $LMS, $SMARTY, $SESSION;
    $db = LMSDB::getInstance();

    $eventsNoAssign = $db->GetAll('SELECT FROM_UNIXTIME(e.date, \'%Y-%m-%d\') AS startdate, e.title, e.id, u.name
				    FROM events e 
				    LEFT JOIN users u ON (u.id=e.userid) 
				    WHERE e.id NOT IN (SELECT eventid FROM eventassignments) AND e.closed=0');
    return $eventsNoAssign;
}

function getSummary() {
    global $LMS, $SMARTY, $SESSION;
    $db = LMSDB::getInstance();

    $summary = $db->GetAll('SELECT u.id, u.name, COUNT(e.closed) AS wszystkie, SUM(IF(e.closed, 1, 0)) AS zamkniete, SUM(IF(e.closed, 0, 1)) AS otwarte
			    FROM eventassignments ea
			    LEFT JOIN users u ON (u.id = ea.userid)
			    LEFT JOIN events e ON (e.id = ea.eventid)
			    WHERE u.deleted=0
			    GROUP BY ea.userid');
    return $summary;
}

$SMARTY->assign('summary', getSummary());
$SMARTY->assign('eventsNoAssign', getEventsToCloseWithoutAssign());
$SMARTY->display('eventssummary.html');
?>
