<?php

$layout['pagetitle'] = trans('Node ip change log');

$list_new_ip = $LMS->DB->GetAll('SELECT ipaddr_new AS ipnum, INET_NTOA(ipaddr_new) AS ip FROM nodeipchangelog WHERE ipaddr_new>170000000 ORDER BY ipaddr_new');

$list = $LMS->DB->GetAll("
    SELECT 
        CONCAT(customers.name, ' ',customers.lastname) AS kto, FROM_UNIXTIME(nodeipchangelog.moddate) AS do, INET_NTOA(nodeipchangelog.ipaddr) AS from_ip,INET_NTOA(nodeipchangelog.ipaddr_new) AS to_ip 
    FROM 
        nodeipchangelog 
    JOIN 
        customers ON nodeipchangelog.ownerid=customers.id 
    ORDER BY 
        nodeipchangelog.moddate DESC;");

$ip = $_POST[ip];

if ($ip) {
    $list_ip = $LMS->DB->GetAll("
    SELECT 
        INET_NTOA(ipaddr) AS from_ip,INET_NTOA(ipaddr_new) AS to_ip,CONCAT(customers.name, ' ',customers.lastname) AS kto, FROM_UNIXTIME(nodeipchangelog.moddate) AS do
    FROM 
        nodeipchangelog 
    JOIN 
        customers ON nodeipchangelog.ownerid=customers.id 
    WHERE
        (ipaddr=$ip OR ipaddr_new=$ip)
    ORDER BY 
        nodeipchangelog.moddate DESC;");
}

$SMARTY->assign('list_new_ip', $list_new_ip);
$SMARTY->assign('list', $list);
$SMARTY->assign('list_ip', $list_ip);
$SMARTY->display('nodeipchangelog.html');
?>
