<?php
  include('../../database/db.php');
  $sql = "SELECT fa.farmer_reg_no AS reg_no,p.fullname AS farmer,fa.district AS far_district, fa.sector AS far_sector, fa.cell AS far_cell, 
            fa.village AS far_village, coop.coop_name, coop.district AS coop_district, coop.sector AS coop_sector, 
            coop.cell AS coop_cell, coop.village AS coop_village, pro.name AS product_name, ps.product_size,o.qty, 
            ps.price AS unit_price, (ps.price * o.qty) AS total, o.due_date AS order_date 
          FROM orders o 
          LEFT JOIN payments p ON o.tx_ref = p.tx_ref 
          LEFT JOIN products pro ON o.product_id = pro.product_id 
          LEFT JOIN products_size ps ON o.ps_id = ps.id 
          LEFT JOIN farmers fa ON o.farmer_reg_no = fa.farmer_reg_no 
          LEFT JOIN cooperatives coop ON o.coop_id = coop.coop_id
          WHERE p.sales_status = 1 AND p.verified = 1";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  if($stmt->rowCount() > 0){
    $separator = ","; 
    $filename = "orders-data-".date('Y-m-d').".csv";
    $f = fopen('php://memory', 'w');
     // Set column headers 
    //  $fields = array('Code','Name','Contact Name','Telephone','Mobile','Fax','Email','Address 1','Address 2','Address 3','Address 4','Postcode','Website','Trade Border Type','Notes','Source','Discount','Show Discount','Payment Terms','Extra Text 1','Extra Text 2','Check Box 1','Check Box 2','Created','Updated','VAT Number');
     $fields = array('Reg_No', 'Customer', 'Customer Address', 'Shipped to(COOP)', 'Products', 'Product size', 'Quantity', 'Unit Price(Rwf)', 'Total(Rwf)', 'Order Date'); 
     fputcsv($f, $fields, $separator);

    // Output each row of the data, format line as csv and write to file pointer
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $farmer_address = $row['far_district'];
      // $farmer_address = $row['far_district'].', '.$row['far_sector'].', '.$row['far_cell'].', '.$row['far_village'];
      // $coop_address = $row['coop_district'];
      // $coop_address = $row['coop_district'].', '.$row['coop_sector'].', '.$row['coop_cell'].', '.$row['coop_village'];
        $lineData = array($row['reg_no'], $row['farmer'], $farmer_address, $row['coop_name'], $row['product_name'], $row['product_size'], $row['qty'], $row['unit_price'], $row['total'], $row['order_date']); 
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