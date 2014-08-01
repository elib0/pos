<?php

if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

$reportdata["title"] = "Clients";

$filterfields = array("id"=>"ID","firstname"=>"First Name","lastname"=>"Last Name","companyname"=>"Company Name","email"=>"Email","address1"=>"Address 1","address2"=>"Address 2","city"=>"City","state"=>"State","postcode"=>"Postcode","country"=>"Country","phonenumber"=>"Phone Number","currency"=>"Currency ID","groupid"=>"Client Group ID","credit"=>"Credit","datecreated"=>"Creation Date","notes"=>"Notes","status"=>"Status");

$reportdata["description"] = $reportdata["headertext"] = '';

if (!isset($_GET['print'])) {

$reportdata["description"] = "This report can be used to generate a custom export of clients by applying up to 5 filters. CSV Export is available via the download link at the bottom of the page.";

$reportdata["headertext"] = '<form method="post" action="reports.php?report='.$report.'">
<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
<tr><td width="20%" class="fieldlabel">Fields to Include</td><td class="fieldarea"><table width="100%"><tr>';
$i=0;
foreach ($filterfields AS $k=>$v) {
    $reportdata["headertext"] .= '<td width="20%"><input type="checkbox" name="incfields[]" value="'.$k.'" id="fd'.$k.'"';
    if (in_array($k,$incfields)) $reportdata["headertext"] .= ' checked';
    $reportdata["headertext"] .= ' /> <label for="fd'.$k.'">'.$v.'</labe></td>'; $i++;
    if (($i%5)==0) $reportdata["headertext"] .= '</tr><tr>';
}
$reportdata["headertext"] .= '</tr></table></td></tr>';

for ( $i = 1; $i <= 5; $i ++ ) {
$reportdata["headertext"] .= '<tr><td width="20%" class="fieldlabel">Filter '.$i.'</td><td class="fieldarea"><select name="filterfield['.$i.']"><option value="">None</option>';
foreach ($filterfields AS $k=>$v) {
    $reportdata["headertext"] .= '<option value="'.$k.'"';
    if ($filterfield[$i]==$k) $reportdata["headertext"] .= ' selected';
    $reportdata["headertext"] .= '>'.$v.'</option>';
}
$reportdata["headertext"] .= '</select> <select name="filtertype['.$i.']"><option>Exact Match</option><option value="like"';
if ($filtertype[$i]=="like") $reportdata["headertext"] .= ' selected';
$reportdata["headertext"] .= '>Containing</option></select> <input type="text" name="filterq['.$i.']" size="30" value="'.$filterq[$i].'" /></td></tr>';
}
$reportdata["headertext"] .= '</table>
<p align="center"><input type="submit" value="Filter" /></p>
</form>';

}

if (isset($incfields)) {

$filters = array();
foreach ($filterfield AS $i=>$val) {
    if ($val) $filters[$val] = ($filtertype[$i]=="like") ? array("sqltype"=>"LIKE","value"=>$filterq[$i]) : $filterq[$i];
}

$fieldlist = '';
foreach ($incfields AS $fieldname) {
    $reportdata["tableheadings"][] = $filterfields[$fieldname];
    $fieldlist .= $fieldname.',';
}
$fieldlist = substr($fieldlist,0,-1);

$result = select_query("tblclients",$fieldlist,$filters);
while ($data = mysql_fetch_assoc($result)) {
    $reportdata["tablevalues"][] = $data;
}

}

?>