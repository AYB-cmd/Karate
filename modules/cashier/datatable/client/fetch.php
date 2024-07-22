<?php
include('../db.php');
include('function.php');

$output = array();

$query = '';
$query .= "SELECT C.cust_id, C.cust_code, C.cust_email, C.cust_firstname, C.cust_lastname,C.cust_code, C.mem_id, M.mem_status FROM tbl_customer C
LEFT JOIN tbl_membership M ON C.mem_id = M.mem_id
WHERE C.cust_status = 'ACTIVE' ";

switch($_POST['sub']){
    case 'active':
        $query .= "AND M.mem_status = 'ACTIVE' ";
    break;
    case 'expired':
        $query .= "AND M.mem_status = 'EXPIRED' ";
    break;
    case 'none':
        $query .= "AND M.mem_status IS NULL ";
    break;
    default:
        if(isset($_POST["search"]["value"]))
           $query .= 'AND (C.cust_firstname LIKE "%'.$_POST["search"]["value"].'%" OR C.cust_lastname LIKE "%'.$_POST["search"]["value"].'%" OR C.cust_email LIKE "%'.$_POST["search"]["value"].'%") ';
    break;
}

if(isset($_POST["search"]["value"]) && $_POST['sub'] != 'all')
	$query .= 'AND (C.cust_firstname LIKE "%'.$_POST["search"]["value"].'%" OR C.cust_lastname LIKE "%'.$_POST["search"]["value"].'%" OR C.cust_email LIKE "%'.$_POST["search"]["value"].'%") ';
    
if(isset($_POST["order"]))
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
else
	$query .= 'ORDER BY C.cust_lastname ASC ';

if($_POST["length"] != -1)
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

foreach($result as $row){
	$name = $row["cust_firstname"]." ".$row["cust_lastname"];
    
    $Assurance = $row["mem_status"];
    if($Assurance == "EXPIRED")
        $memstat = '<span class="btn-gray btn-xs" style="font-size: x-small;">'.$Assurance.'</span>';
    else if($Assurance == "ACTIVE")
        $memstat = '<span class="btn-green btn-xs" style="font-size: x-small;">'.$Assurance.'</span>';
    else
        $memstat = '<span class="btn-red btn-xs" style="font-size: x-small;">NONE</span>';
    
    $record = '<button type="button" name="transaction" id="'.$row["cust_id"].'" data-toggle="modal" data-target="#profileView" class="btn btn-gray btn-xs btn-fullcircle profile">'.file_get_contents('../../../../svg/ic_profile.svg').'</button>';
    
  
    
    $action = (check_login($row["cust_id"]) == 0) ? '<button type="button" name="view" id="'.$row["cust_id"].'" class="btn btn-success btn-xs view">Time In</button>' : '<button type="button" name="view" id="'.$row["cust_id"].'" class="btn btn-danger btn-xs view">Log Out</button>';
    
    $sub_array = array();
	$sub_array[] = $name;
	$sub_array[] = $record;
	$sub_array[] = $memstat;
	$sub_array[] = $row["cust_email"];
	$sub_array[] = $action;
    $sub_array[] = $row["cust_code"];
	$data[] = $sub_array;
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);