<?php
$query = 
"
    SELECT * 
    FROM product 
    ORDER BY product_id 
    ASC
";
$result = $conn->query($query);
?>