<?php
  include('../../database/db.php');
  $sql = "SELECT fa.farmer_reg_no AS reg_no,p.fullname AS farmer, pro.name AS product_name, ps.product_size,o.qty, ps.price AS unit_price, (ps.price * o.qty) AS total, o.due_date AS order_date FROM orders o 
          LEFT JOIN payments p ON o.tx_ref = p.tx_ref 
          LEFT JOIN products pro ON o.product_id = pro.product_id 
          LEFT JOIN products_size ps ON o.ps_id = ps.id 
          LEFT JOIN farmers fa ON o.farmer_reg_no = fa.farmer_reg_no 
          WHERE p.sales_status = 1 AND p.verified = 1";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  if($stmt->rowCount() > 0){
    $separator = ","; 
    $filename = "orders-data_" . date('Y-m-d') . ".csv";
    $f = fopen('php://memory', 'w');
     // Set column headers 
     $fields = array('Reg_No', 'Customer', 'Products', 'Product size', 'Quantity', 'Unit Price(Rwf)', 'Total(Rwf)', 'Order Date'); 
     fputcsv($f, $fields, $separator);

    // Output each row of the data, format line as csv and write to file pointer
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $lineData = array($row['reg_no'], $row['farmer'], $row['product_name'], $row['product_size'], $row['qty'], $row['unit_price'], $row['total'], $row['order_date']); 
        fputcsv($f, $lineData, $separator); 
    }
      // Move back to beginning of file 
      fseek($f, 0); 
          
      // Set headers to download file rather than displayed 
      header('Content-Type: text/csv'); 
      header('Content-Disposition: attachment; filename="' . $filename . '";'); 
        
      //output all remaining data on a file pointer 
      fpassthru($f);
  }
  exit;


?>