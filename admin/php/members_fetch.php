<?php
include("../../config/db.php");

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $output = array('list'=>'','count'=>0,'nameOfClub'=>'');
      try{
        $recentClub =$id;
      $stmt = $db->prepare("SELECT * FROM membership m  JOIN student s ON s.student_id=m.member JOIN club c ON c.cid=m.club WHERE m.club=:clubid ORDER BY m.id DESC");
      $stmt->execute(['clubid'=>$id]);
      foreach($stmt as $row){
        $output['count']++;
        $output['nameOfClub'] =$row['name'];
        $output['list'] .="
                          <tr>   
                              <td class='d-none d-md-table-cell' style='width:25%'>".$row['lastname'].' '.$row['firstname']."</td>
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