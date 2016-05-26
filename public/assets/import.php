<?php 
if (!isset($_FILES["csv_file"])) {
	echo 'ERR001';
	die;
}

if ($_FILES['csv_file']['error']) {
	echo 'ERR002';
	die;
}

if (!isset($_POST['csv_file_type'])) {
	echo 'ERR003';
	die;
}

require_once 'import_functions.php';

/**
 * $importType can be: 
 * - contacts
 * - customers
 * - leads
 * - opportunity
 * - products
 * - staff
 * - vertical_subvertical
 */
$importType = $_POST['csv_file_type'];

// get csv array
$file = file_get_contents($_FILES['csv_file']['tmp_name']);
$lines = explode(PHP_EOL, $file);
$array = array();
foreach ($lines as $line) {
    $array[] = str_getcsv($line);
}

$header = false;
if ($array[0]) {
    $header = $array[0];
}

$rows = array();
if (count($array)) {
    foreach ($array as $key => $data) {
        // skip header
        if ($key === 0) continue;

        $row = array();
        foreach ($header as $key => $column) {
            $row[$column] = isset($data[$key]) ? $data[$key] : '';
        }
        $rows[] = $row;
    }
}


if ($importType == 'contracts') {

}

switch ($importType) {
    case 'contacts':
        $result = importContacts($header, $rows);
        break;
    case 'customers':
        $result = importCustomers($header, $rows);
        break;
    case 'leads':
        $result = importLeads($header, $rows);
        break;
    case 'opportunity':
        $result = importOpportunities($header, $rows);
        break;
    case 'products':
        $result = importProducts($header, $rows);
        break;
    case 'sales':
        $result = importSalesInfo($header, $rows);
        break;
    case 'vertical_subvertical':
        $result = importVerticals($header, $rows);
        break;
}

// import...
echo 'OK';