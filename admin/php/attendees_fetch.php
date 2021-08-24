<?php
include("../../config/db.php");

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $output = array('list'=>'','count'=>0,'nameOfEvent'=>'');
      try{
        $recentClub =$id;
      $stmt = $db->prepare("SELECT * FROM eventattendance t  JOIN student s ON s.student_id=t.studentId JOIN event e ON e.eventId=t.eventId WHERE e.eventId=:evtId ORDER BY s.firstname ASC");
      $stmt->execute(['evtId'=>$id]);
      foreach($stmt as $row){
        $output['count']++;
        $output['nameOfEvent'] =$row['name'];
        $output['list'] .="
                          <tr>   
                              <td class='d-none d-md-table-cell' style='width:25%'>".$row['firstname'].' '.$row['lastname']."</td>
                              <td style='width:10%'>".$row['gender']."</td>
                              <td style='width:20%'>".$row['faculty']."</td>
                              <td class='d-none d-md-table-cell' style='width:30%'>".$row['email']."</td>
                              <td class='d-none d-md-table-cell' style='width:15%'>".$row['phone']."</td>
                              
                          </tr>
                          ";
      }
      }
      catch(PDOException $e){
      echo $e->getMessage();
      }
    echo json_encode($output);
  }
    ?>