<?php
include("../includes/dbConnection.php");

$bar= $_GET['search'] ?? '';
$query = 
"
    SELECT i.invoice_id, c.first_name, c.last_name, c.company_name, i.total, i.invoice_date, i.status
    FROM invoice i
    JOIN customer c ON i.customer_id = c.customer_id
";

if (!empty($bar)) {
    $search = $conn->real_escape_string($bar);
    $query .= 
    "
        WHERE c.first_name LIKE '%$search%'
        OR c.last_name LIKE '%$search%'
        OR c.company_name LIKE '%$search%'
    ";
}

$query .= 
" 
    ORDER BY i.invoice_id 
    DESC
";
$result = $conn->query($query);
return $result;
?>