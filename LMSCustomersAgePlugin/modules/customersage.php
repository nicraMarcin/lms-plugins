<?php

$layout['pagetitle'] = trans('Customers age');

$roczniki=$DB->GetAll('select (100+right(year(curdate()),2)-left(ssn,2)) as wiek, count(id) as ile from customers where ssn>0 group by wiek order by wiek');
$srednia=$DB->GetAll('select sum((100+right(year(curdate()),2)-left(ssn,2))) as suma, count(id) as ile from customers where ssn>0');

foreach($roczniki as $rocznik)
{
    $all[]=array('wiek' => $rocznik['wiek'], 'ilosc' => $rocznik['ile']);
}
$SMARTY->assign('all',$all);
$SMARTY->assign('srednia',round($srednia[0]['suma']/$srednia[0]['ile']));
$SMARTY->display('customersage.html');
?>