<?php
    // CONNECT TO THE DATABASE
    include_once("php_includes/db_connection.php");
    $searchResults = '';

if (isset($_POST['searchValue'])) {

    $searchValue = $_POST['searchValue'];

    $sql = "SELECT id,question FROM programming_quizes WHERE(`category` LIKE '%".$searchValue."%') ORDER BY ask_date DESC LIMIT 10";
    $query = mysqli_query($db_connection,$sql);
    if (mysqli_num_rows($query) > 0) {
       while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {

          $id = $row['id'];
          $question = $row['question'];

          $searchResults .= '<P style="margin-top: 2opx;"></P><p style="padding: 5px;"><a href="#"  id="foundElement_'.$id.'" >'.$question.'</a></p>';
       }
       echo $searchResults;
       mysqli_close($db_connection);
       exit();
    }
       mysqli_close($db_connection);
    exit();
    
}
?>