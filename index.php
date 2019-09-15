<?php
require("head_php.php"); 
  
?>

<?php
//username variable
$username = '';
//initialize db question variable to empty and all variables to be fetch from db
$question_from_db = '';
$db_postedby = '';
	$db_category = '';
	$db_question = '';
	$db_question_id='';
	$db_description = '';
	$db_code = '';
  $q_del_edit_btn = '';

    //right side quiz links
    $quicklinks = '';

//initalize db answer to empty and all variables to be obtain
    $answer_count = '';
    $answerList = '';
    $answer_header = '';
    $id =  '';
	$answered_by =  '';
	$answer =  '';
	$code = '';
	$views =  '';
	$likes =  '';
  $r_del_edit_btn = '';
    //initialize answer comments and asign the variable
  $commentsExist = "";
  $addCom= $mentDiv ='';
    $commentsList = '';
    $commentId= '';
    $comment = '';
    $commentcode = '';
    $commentedBy = '';
    $commentDate = '';
  $c_del_edit_btn = '';

    $question_writer = '';

    if (isset($_SESSION['username']) && isset($_SESSION['userid'])) {
      $username = $_SESSION['username'];
      $userid = $_SESSION['userid'];
   
    }

$sql = "SELECT id,question FROM programming_quizes ORDER BY ask_date DESC LIMIT 20";
$query = mysqli_query($db_connection,$sql);

while ($row = mysqli_fetch_array($query)) {
   $linkId = $row['id'];
   $linkQuiz = $row['question'];

$quicklinks .= '<a href="index.php?linkId='.$linkId.'" >'.$linkQuiz.'</a><br><hr>';

}


if (isset($_GET['linkId'])) {
    $linkId = $_GET['linkId'];


$sql = "SELECT * FROM programming_quizes WHERE id='$linkId' LIMIT 1";
$query = mysqli_query($db_connection,$sql);

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {


    $db_question_id = $row['id'];
    $db_postedby = $row['asked_by'];
    $db_category = $row['category'];
    $db_question = $row['question'];
    $db_description = $row['description'];
    $db_code = $row['code'];
    $db_views = $row['views'];
    $db_likes = $row['likes'];
    $db_answercount = $row['answer_count'];
    $db_askdate = $row['ask_date'];

    $sql = "SELECT asked_by FROM programming_quizes WHERE id='$db_question_id' LIMIT 1";
      $query = mysqli_query($db_connection, $sql);
      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $question_writer = $row['asked_by'];
      }

if (isset($_SESSION['username']) && $question_writer == $username) {
     
      $q_del_edit_btn = ' <a href="#" onclick="return false;" onmousedown="deleteQuestion(\''.$linkId.'\')"> Remove </a>or<a href="#" onclick="return false;" onmousedown="editQuestion(\''.$linkId.'\')">  Edit</a>';
    }

$question_from_db .= '<h4><i><'.$db_question_id.'> category: '.$db_category.'</i></h4><p>Asked by <b><i><a href="#">'.$db_postedby.' </a></i></b>  On  '.$db_askdate.$q_del_edit_btn.'</p><h3>'.$db_question.'</h3> <p>'.$db_description.'</p><div class="code"><pre class="code" ><code id="posted_code_'.$db_question_id.'">'.$db_code.'</code></pre></div><div id="reply_quiz_form_'.$db_question_id.'" style="display: none;"><form id="reply_form_'.$db_question_id.'" onsubmit="return false;"> Answer : <div id="reply_answer_div"  class="form-group"><textarea id="reply_question_area_'.$db_question_id.'" class="form-control" onfocus="checkLogin(\'reply_question_area_'.$db_question_id.'\',\''.$username.'\')"></textarea></div>Code :  <div id="reply_code_div_'.$db_question_id.'" class="code_div"><pre id="reply_code_'.$db_question_id.'"><b></b> <code><textarea id="reply_code_area_'.$db_question_id.'" class="form-control code_area" onfocus="checkLogin(\'reply_code_area_'.$db_question_id.'\',\''.$username.'\')"></textarea></code></pre></div><div><input type="submit" name="submit" class="btn btn-default" onmousedown="reply_question(\''.$db_question_id.'\',\''.$username.'\')"></div></form></div><a href="#" onclick="return false;" id="quizReplyLink_'.$db_question_id.'" class="replyLink" onmousedown="toggleHtmlElement(\'reply_quiz_form_'.$db_question_id.'\')"> Reply</a>';

}

}else{

$sql = "SELECT * FROM programming_quizes ORDER BY ask_date DESC LIMIT 1";
$query = mysqli_query($db_connection,$sql);

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $db_question_id = $row['id'];
    $db_postedby = $row['asked_by'];
    $db_category = $row['category'];
    $db_question = $row['question'];
    $db_description = $row['description'];
    $db_code = $row['code'];
    $db_views = $row['views'];
    $db_likes = $row['likes'];
    $db_answercount = $row['answer_count'];
    $db_askdate = $row['ask_date'];

 
    $sql = "SELECT asked_by FROM programming_quizes WHERE id='$db_question_id' LIMIT 1";
      $query = mysqli_query($db_connection, $sql);
      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $question_writer = $row['asked_by'];
      }

if (isset($_SESSION['username']) && $question_writer == $username) {
     
      $q_del_edit_btn = ' <a href="#" onclick="return false;" onmousedown="deleteQuestion(\''.$db_question_id.'\')"> Remove </a>or<a href="#" onclick="return false;" onmousedown="editQuestion(\''.$db_question_id.'\')">  Edit</a>';
    }

$question_from_db .= '<h4><button class="btn btn-default"><h3><'.$db_question_id.'/></h3></button><i> category: '.$db_category.'</i></h4><p>Asked by <b><i><a href="#">'.$db_postedby.' </a></i></b>  On  '.$db_askdate.$q_del_edit_btn.'</p><h3>'.$db_question.'</h3> <p>'.$db_description.'</p><div class="code"><pre class="code" ><code class="code"  id="posted_code_'.$db_question_id.'">'.$db_code.'</code></pre></div><div id="reply_quiz_form_'.$db_question_id.'" style="display: none;"><form id="reply_form_'.$db_question_id.'" onsubmit="return false;"> Reply : <div id="reply_answer_div"  class="form-group"><textarea id="reply_question_area_'.$db_question_id.'" class="form-control" onfocus="checkLogin(\'reply_question_area_'.$db_question_id.'\',\''.$username.'\')"></textarea><a href="#" onclick="return false;"  id="show_add_reply_code" onmousedown="toggleHtmlElement(\'add_reply_code\',\'show_add_reply_code\')">add code</a></div><div id="add_reply_code"  style="display: none;">Code :  <div id="reply_code_div_'.$db_question_id.'" class="code_div"><pre id="reply_code_'.$db_question_id.'"><b></b> <code><textarea id="reply_code_area_'.$db_question_id.'" class="form-control code_area" onfocus="checkLogin(\'reply_code_area_'.$db_question_id.'\',\''.$username.'\')"></textarea></code></pre></div></div><div><input type="submit" name="submit" class="btn btn-default" onmousedown="reply_question(\''.$db_question_id.'\',\''.$username.'\')" value="Send Reply"></div></form></div><a href="#" onclick="return false;" id="show_reply_quiz_form_'.$db_question_id.'" class="replyLink" onmousedown="toggleHtmlElement(\'reply_quiz_form_'.$db_question_id.'\',\'show_reply_quiz_form_'.$db_question_id.'\')"> Reply to this post</a>';


}

}  

$sql = "SELECT * FROM programming_answers WHERE quiz_id='$db_question_id' ORDER BY answer_date DESC LIMIT 20";
if ($query = mysqli_query($db_connection,$sql)) {
 
$answer_count = mysqli_num_rows($query);
if ($answer_count > 0) {

  while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
    $id = $row['id'];
    $answered_by = $row['answered_by'];
    $answer = $row['answer'];
    $code = $row['code'];
    $views = $row['views'];
    $likes = $row['likes'];
    $db_answer_date = $row['answer_date'];
    $quiz_id = $row['quiz_id'];

//for every while loop get all the comments for that answer
    //since quiz id and answer id on comments table are the same, we use them for where condition
    $commentsSql = "SELECT * FROM comments WHERE answer_id='$id' AND quiz_id='$db_question_id' ORDER BY comment_date DESC";
   if ( $commentsQuery = mysqli_query($db_connection,$commentsSql)) {
     $comments_row_count = mysqli_num_rows($commentsQuery);
    if ($comments_row_count > 0) {

       $commentsList = '';
       while ($commentRow = mysqli_fetch_array($commentsQuery,MYSQLI_ASSOC)) {

    $commentId= $commentRow['id'];
    $commentedBy = $commentRow['commented_by'];
    $comment = $commentRow['comment'];
    $commentcode = $commentRow['code'];
    $commentDate = $commentRow['comment_date'];

    if (isset($_SESSION['username']) && $question_writer == $username) {
     
      $c_del_edit_btn = '<a href="#" onclick="return false;" onmousedown="deleteComment(\''.$commentId.'\')"> Remove </a>or<a href="#" onclick="return false;" onmousedown="editComment(\''.$commentId.'\')">  Edit</a>';
    }

         $commentsList .= '<div id="comment_'.$commentId.'" style="margin: 10px;"><p class="comment_text"> <b><button class="btn btn-default"><h5><'.$commentId.'/></h5></button></P><p class="comment_text">commented by <b><i><a href="#">'.$commentedBy.' </a></i></b> on <b> '.$commentDate.'</b>'.$c_del_edit_btn.'</p><p class="comment_text"> '.$comment.'</p> <b>code</b><br> </p><div id="comment_reply_code_from_db_'.$commentId.'"  class="code"><pre><code class="code"><p class="comment_text"> '.$commentcode.'</p></code></pre></div></div> <br><hr>';

       }
    }else{
        $commentsList = '';
        $addCom = '<div class="comments_div" id="parent_comments_div_'.$id.'"><p style="color: blue;">No comments</p><div id="comments_div_'.$id.'">';
        $mentDiv = '</div></div>';
    }
    
  //  comment answer list starts here
    
    if ($commentsList != "") {

        $addCom = '<div class="comments_div" id="parent_comments_div_'.$id.'"><h5 class="comment_head"><a href="#">Comments</a> </h5> <br><hr><div id="comments_div_'.$id.'">';
        $mentDiv = '</div></div>';
    }

    if (isset($_SESSION['username']) && $question_writer == $username) {
     
      $r_del_edit_btn = '<a href="#" onclick="return false;" onmousedown="deleteAnswer(\''.$id.'\')"> Remove </a>or <a href="#" onclick="return false;" onmousedown="editAnswer(\''.$id.'\')"> Edit</a>';
    }


    $answerList .= '<div id="answer_'.$id.'"><button class="btn btn-default"><h4><'.$id.'></h4></button><p>Answered by <b><i><a href="#">'.$answered_by.' </a></i></b> on <b> '.$db_answer_date.'</b>'.$r_del_edit_btn.'</p>'.$answer.' <p> </p><p><b>code</b><br> </p><div id="reply_code_from_db_'.$id.'"  class="code"><pre class="code" ><code class="code"> '.$code.'</code></pre></div><div id="comment_on_reply_form_div_'.$id.'" style="display: none;"><form id="comment_reply_form_'.$id.'" onsubmit="return false;"> Comment : <div id="comment_reply_answer_div_'.$id.'"  class="form-group"><textarea id="comment_reply_question_area_'.$id.'" class="form-control" onfocus="checkLogin(\'comment_reply_question_area_'.$id.'\',\''.$username.'\')"></textarea><a href="#" onclick="return false;"  id="show_comment_reply_code_div_'.$id.'" onmousedown="toggleHtmlElement(\'comment_reply_code_div_'.$id.'\',\'show_comment_reply_code_div_'.$id.'\')" class="pull-right">add code</a></div> <div id="comment_reply_code_div_'.$id.'" class="code_div" style="display: none;"><label for="comment_reply_code_area_'.$id.'"> Comment :</label> <pre id="comment_reply_code_'.$id.'"><b></b> <code class="code"><textarea id="comment_reply_code_area_'.$id.'" class="form-control code_area" onfocus="checkLogin(\'comment_reply_code_area_'.$id.'\',\''.$username.'\')"></textarea></code></pre></div><div><input type="submit" name="submit" class="btn btn-default" onmousedown="commentOnReply(\''.$id.'\',\''.$quiz_id.'\',\''.$username.'\')" value="Send Comment"></div></form></div><div><p><b><a href="#" onclick="return false;" class="replyLink" id="show_comment_on_reply_form_div_'.$id.'" onmousedown="toggleHtmlElement(\'comment_on_reply_form_div_'.$id.'\',\'show_comment_on_reply_form_div_'.$id.'\')"> Comment on Reply</a></b></p></div>'.$addCom.$commentsList.$mentDiv.'</div>';
}
}
        if ($answerList != '') {
           $answer_header = ' <br><hr><h3>answers</h3>';
           $answer_count = '<span><p><a href="index.php#answer_'.$id.'">'.$answer_count.' Answers</a></p></span>';
        }
}
   }
   

?>

<?php
//check if user is logged in
 if (isset($_POST['uname'])) {
  if (isset($_SESSION['username'])) {
    echo "";
      exit();
    }else{
      echo "PLEASE LOGIN FIRST!";
      exit();
    }
 }
?>
<?php
//process question post
if (isset($_POST['askedby'])) {

	    $askedby = $_POST['askedby'];
      $category = $_POST['category'];
      $question =mysqli_real_escape_string($db_connection, htmlentities($_POST['question']));
      $description = mysqli_real_escape_string($db_connection,htmlentities($_POST['description']));
      $code = mysqli_real_escape_string($db_connection,htmlentities($_POST['code']));

	//echo $askedby.' '.$category.' '.$question.' '.$description.' '.$code;
	
if ($asked_by = "" || $question == "") {
 echo "An error occured while posting your question";
}else{
  $sql = "INSERT INTO programming_quizes (asked_by,category,question,description,code) 
  VALUES('$askedby','$category','$question','$description','$code')";

  $query = mysqli_query($db_connection,$sql);
  $quiz_id = mysqli_insert_id($db_connection);

  if ($query) {
    echo "sent|".$quiz_id;
    exit();
  }else{
    echo "failed";
    exit();
  }
	exit();
}
}


//process question delete
if (isset($_POST['deleteQuestionId'])) {
 $question_id = $_POST['deleteQuestionId'];

 $sqlQuiz = "DELETE FROM programming_quizes WHERE id='$question_id'";
 $quizQuery = mysqli_query($db_connection,$sqlQuiz);

 $sqlAnswers = "DELETE FROM programming_answers WHERE quiz_id='$question_id'";
 $answerQuery = mysqli_query($db_connection,$sqlAnswers);

 $sqlComments = "DELETE FROM comments WHERE quiz_id='$question_id'";
 $answerQuery = mysqli_query($db_connection,$sqlComments);

 if ($quizQuery && $answerQuery && $sqlComments) {
     echo "success";
     exit();
   }  else{
    echo "delete faile";
    exit();
   }
   exit();
}

//process answer post
if (isset($_POST['answered_by'])) {

	$answered_by = $_POST['answered_by'];
	$answer= mysqli_real_escape_string($db_connection,htmlentities($_POST['answer']));
	$code= mysqli_real_escape_string($db_connection,htmlentities($_POST['code']));
	$quiz_id =$_POST['quiz_id'];

	$sql = "INSERT INTO programming_answers (answered_by,answer,code,quiz_id) 
	VALUES('$answered_by','$answer','$code','$quiz_id')";

	$query = mysqli_query($db_connection,$sql);
  $lastinsertid = mysqli_insert_id($db_connection);
	if ($query) {
		echo "success|".$lastinsertid;
		exit();
	}else{
		echo "failed";
		exit();
	}
}

//process comment post
if (isset($_POST['commented_by'])) {

    $commented_by = $_POST['commented_by'];
    $comment= mysqli_real_escape_string($db_connection, htmlentities($_POST['comment']));
    $code= mysqli_real_escape_string($db_connection, htmlentities($_POST['comment_code']));
    $answer_id =$_POST['answer_id'];
    $quiz_id =$_POST['quiz_id'];

    $sql = "INSERT INTO comments(commented_by,comment,code,comment_date,answer_id,quiz_id) 
    VALUES('$commented_by','$comment','$code',now(),'$answer_id','$quiz_id')";

    $query = mysqli_query($db_connection,$sql);
    $comment_id = mysqli_insert_id($db_connection);
    if ($query) {
        echo $comment_id;
        exit();
    }else{
        echo "failed";
        exit();
    }
}

//process answer delete 
if (isset($_POST['deleteAnswerId'])) {
 $answer_id = $_POST['deleteAnswerId'];

 $sql = "DELETE FROM programming_answers WHERE id='$answer_id' LIMIT 1";
 $query = mysqli_query($db_connection,$sql);

  $sql2 = "DELETE FROM comments WHERE answer_id='$answer_id'";
 $query2 = mysqli_query($db_connection,$sql2);
 if ($query && $query2) {
     echo "success";
     exit();
   }  else{
    echo "delete failed";
    exit();
   }
   exit();
}

//process comment delete 
if (isset($_POST['deleteCommentId'])) {
 $comment_id = $_POST['deleteCommentId'];

  $sql2 = "DELETE FROM comments WHERE id='$comment_id'";
 $query2 = mysqli_query($db_connection,$sql2);
 if ($query2) {
     echo "DELETED";
     exit();
   }  else{
    echo "DELETING FAILED";
    exit();
   }
   exit();
}
?>


<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/main.js"></script>
	<style type="text/css">
		
	</style>
	<script type="text/javascript">

        function checkLogin(elementId,username){

      if (username =="" || username == null) {

                _(elementId).blur();
                alert("PLEASE LOGIN FIRST");
      }
    }

    function questionCategory(username){
      var category  = _("qCategory").value;
      if (category == "") {
        alert("please select category for your question");
      }else if(username == ""){
        alert("PLEASE LOGIN FIRST");
      }else{
        _("categoryForm").style.display = 'none';
        _("post_form").style.display = 'block';
      //  _("showCategoryForm").style.display = 'none';
      }
    }

   function post_question(username){
    var question_post = _("quiz").value;
    var question_post_description = _("quiz_description").value;
    var quiz_code = _("quiz_code").value;
    var askedby = username;
    var category = _("qCategory").value;
    //alert(branch+school+course+county+estate+coach);
    if(askedby == "" || question_post == ""){
       alert("Question field cannot be empty");
    //} else if(p1 != p2){
        //status.innerHTML = "Your password fields do not match";
    } else {

      var xml = new XMLHttpRequest();
        xml.open("POST","index.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xml.onreadystatechange = function(){
              //alert(this.responseText);
            if (xml.readyState == 4 && xml.status == 200) {
            	var dataArray = this.responseText.split("|");
            	var status = dataArray[0];
            	var quiz_id = dataArray[1];
            	if (quiz_id != "") {

            		sanitizedJS_question_post = question_post.replace("/</g,&lt;").replace("/>/g,&gt;").replace("/\n/g,<br />").replace("/\r/g,<br />");
                    sanitizedJS_question_post_description = question_post_description.replace("/</g,&lt;").replace("/>/g,&gt;").replace("/\n/g,<br />").replace("/\r/g,<br />");
                    sanitizedJS_quiz_code = quiz_code.replace("/</g,&lt;").replace("/>/g,&gt;").replace("/\n/g,<br />").replace("/\r/g,<br />");

    _("display_question").innerHTML = ' <h4><i>Question category: '+category+'</i></h4><p>Asked by <b><i><a href="#">'+askedby+' </a></i></b><b> Just now </b><a href="#" onclick="return false;" onmousedown="deleteQuestion(\''+quiz_id+'\')"> Remove </a>or<a href="#" onclick="return false;" onmousedown="editQuestion(\''+quiz_id+'\')">  Edit</a></p><h3>'+sanitizedJS_question_post+'</h3> <p>'+sanitizedJS_question_post_description+'</p><div class="code"><pre class="code"><code id="posted_code" class="code">'+sanitizedJS_quiz_code+'</code></pre></div><div id="reply_quiz_form_'+quiz_id+'" style="display: none;"><form id="reply_form_'+quiz_id+'" onsubmit="return false;"> Answer : <div id="reply_answer_div"  class="form-group"><textarea id="reply_question_area_'+quiz_id+'" class="form-control"></textarea><a href="#" onclick="return false;" onmousedown="toggleHtmlElement(\'add_reply_code\')">add code</a></div><div id="add_reply_code" style="display: none;">Code :  <div id="reply_code_div_'+quiz_id+'" class="code_div"><pre id="reply_code_'+quiz_id+'"><b></b> <code><textarea id="reply_code_area_'+quiz_id+'" class="form-control code_area"></textarea></code></pre></div></div><div><input type="submit" name="submit" class="btn btn-default" onmousedown="reply_question(\''+quiz_id+'\',\''+askedby+'\')"></div></form></div><a href="#" onclick="return false;" id="quizReplyLink_'+quiz_id+'" class="replyLink" onmousedown="toggleHtmlElement(\'reply_quiz_form_'+quiz_id+'\')"> Reply</a>';
    window.location = 'index.php#display_question';
    var linkCurrentHTML = _("addQuickLink").innerHTML;
    _("addQuickLink").innerHTML = '<a href="index.php?linkId='+quiz_id+'" >'+question_post+'</a><br><hr>'+linkCurrentHTML;
        _("showCategoryForm").style.display = 'block';

    _("answer_div").innerHTML = '';
            	}
               
            }
        }
        xml.send("askedby="+askedby+"&question="+question_post+"&description="+question_post_description+"&category="+category+"&code="+quiz_code);
      }
}


    function editQuestion(questionId){
      alert("edit not available "+questionId);
    }

    function deleteQuestion(questionId){
    

     var xml = new XMLHttpRequest();
     xml.open("POST","index.php",true);
     xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xml.onreadystatechange = function(){
        if (xml.readyState == 4 & xml.status == 200) {
         // alert(xml.responseText);
                 alert("Question "+questionId+" and all its answers and comments deleted successfully");
                 window.location = 'index.php';

        }
     } 
     xml.send("deleteQuestionId="+questionId);
    }


    function reply_question(quiz_id,username){
      if (username =="" || username == null) {

                alert("PLEASE LOGIN FIRST");
      }else{
         var quiz_reply = document.getElementById("reply_question_area_"+quiz_id).value;
            var quiz_code = document.getElementById("reply_code_area_"+quiz_id).value;
            var answered_by = username;
            if (answered_by == "") {
              alert("PLEASE LOGIN FIRST");
            }else if (quiz_reply == "") {

              alert("Answer cannot be empty");
            }else{

        var xml = new XMLHttpRequest();
        xml.open("POST","index.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function(){
            if (xml.readyState == 4 && xml.status == 200) {
                var dataArray = this.responseText.split("|");
                var ans_id = dataArray[1];
               alert(dataArray[1]);
                var currentHTML = document.getElementById("answer_div").innerHTML;

                document.getElementById("answer_div").innerHTML = '<div id="answer_'+ans_id+'"><h4>Answer id: '+ans_id+'</h4><p>Answered by <b><i><a href="#">'+answered_by+' </a></i></b> just <b> now</b><a href="#" onclick="return false;" onmousedown="deleteAnswer(\''+ans_id+'\')"> Remove </a>or<a href="#" onclick="return false;" onmousedown="editAnswer(\''+ans_id+'\')">  Edit</a></p>'+quiz_reply+' <p> </p><p><b>code</b><br> </p><div id="reply_code_from_db_'+ans_id+'"  class="code"><pre class="code" ><code class="code"> '+quiz_code+'</code></pre></div></div>'+currentHTML;
                  window.location = "index.php#show_reply_quiz_form_"+quiz_id;
                toggleHtmlElement("reply_quiz_form_"+quiz_id,"show_reply_quiz_form_"+quiz_id);
                //_("quizReplyLink_"+quiz_id).style.display = "block";
            }
        }
        xml.send("answered_by="+answered_by+"&answer="+quiz_reply+"&code="+quiz_code+"&quiz_id="+quiz_id);
      }
      }
           
    }
    function editAnswer(ansId){
      alert("edit not available "+ansId);
    }

    function deleteAnswer(answerId){
     //alert(answerId);

     var xml = new XMLHttpRequest();
     xml.open("POST","index.php",true);
     xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xml.onreadystatechange = function(){
        if (xml.readyState == 4 & xml.status == 200) {
          
                 alert(this.responseText);
                 _("answer_"+answerId).innerHTML = '';
                 _("parent_comments_div_"+answerId).innerHTML = '';
        }
     }
     xml.send("deleteAnswerId="+answerId);
   }

    function commentOnReply(answer_id,quiz_id,username){
      if (username =="" || username == null) {

                alert("PLEASE LOGIN FIRST");
      }else{
        var commented_by = username;
        var comment = _("comment_reply_question_area_"+answer_id).value;
        var code = _("comment_reply_code_area_"+answer_id).value;

          if (username == "") {
            alert("PLEASE LOGIN FIRST");

          }else if (comment == "") {
            alert("comment cannot be empty");
          }else{

  var xml = new XMLHttpRequest();

     xml.open("POST","index.php",true);
     xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xml.onreadystatechange = function(){
        if (xml.readyState == 4 & xml.status == 200) {
                var currentCommentId=this.responseText;
                alert("sent");
                 var currentHTML = _("comments_div_"+answer_id).innerHTML;

                  _("comments_div_"+answer_id).innerHTML = '<div class="comments_div" id="comment_'+currentCommentId+'" ><p class="comment_text" style="font-size:11px; margin-left:3px;"> <b>'+currentCommentId+'</b></P><p class="comment_text">commented by <b><i><a href="#">'+commented_by+' </a></i></b> just <b> now</b><a href="#" onclick="return false;" '+
                   'onmousedown="deleteComment('+currentCommentId+')"> Remove </a> <a href="#" '+
                   'onclick="return false;" onmousedown="editComment(\''+currentCommentId+'\')">  </a></p><p '+
                   'class="comment_text"> '+comment+'</p> <b>code</b><br> </p><div '+
                   'id="comment_reply_code_from_db_'+currentCommentId+'"  class="code"><pre><code '+
                   'class="code"><p class="comment_text"> '+code+'</p></code></pre></div></div> <br><hr>'+currentHTML;

                    window.location = "index.php#show_comment_on_reply_form_div_"+answer_id;
             toggleHtmlElement("comment_on_reply_form_div_"+answer_id,"show_comment_on_reply_form_div_"+answer_id);

                  _("no_comments_div_"+answer_id).innerHTML = '';
        }
     }
     xml.send("commented_by="+commented_by+"&comment="+comment+"&comment_code="+code+"&answer_id="+answer_id+"&quiz_id="+quiz_id);

}
      }
    
    }
     function editComment(commentId){
      alert("edit not available "+commentId);
    }

    function deleteComment(commentId){
alert(commentId);
     var xml = new XMLHttpRequest();
     xml.open("POST","index.php",true);
     xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xml.onreadystatechange = function(){
        if (xml.readyState == 4 & xml.status == 200) {
                var response = this.responseText;

                   alert("comment id from php "+response);
                 _("comment_"+commentId).innerHTML = '';
                // _("comment_"+commentId).style.display = 'none';
                 
        }
     }
     xml.send("deleteCommentId="+commentId);
    }
    function toggleHtmlElement(id1,id2){

    	var id1 = _(id1);
      var id2 = _(id2);

    	if (id1.style.display == "none") {
         id1.style.display = "block";

    	}else {
         id1.style.display = "none";
        }
          if (id2.style.display == "none") {
         id2.style.display = "block";

      }else {
         id2.style.display = "none";
        }
        }

        
    
</script>
<style type="text/css">


    .replyLink{
        margin-left: 70%;

    }
	.code_area{
		background-color: lightgray;
	}
    .code{
       background-color: darkgray;
       max-height: 500px;
    }
    .comments_div{
        background-color: #FFFFCC
;
        padding: 10px;
        margin: auto;
        width: 80%;
    }
    .comment_text{
        font-size: 11px;
        margin-left: 3px;
    }
</style>

   <?php include_once("header.php"); ?>

<div class="container">
<div class="row">
<div class="col-sm-8"  style="background-color: white; max-width: 75%;">
  
<div id="display_question">

    <?php echo $answer_count.' Answers '.$question_from_db; ?>
</div>


       <?php echo $answer_header; ?>
        <div id="answer_div" style="width: 90%; margin: auto;">
        <?php //echo $answer_count; ?>
        <?php echo $answerList; ?>
    </div>

<div id="post_div" style="margin-bottom: 50px;float: left;">
            <h4>Ask something concerning programming to get an instance responce from other programmers.</h4>

            <a href="#" onclick="return false;" id="showCategoryForm" style="display: block;" onmousedown="toggleHtmlElement('categoryForm')"><h3 class="text pull-right">Click here to post your question</h3></a>

    <div id="categoryForm" style="display: none;">
      <form onsubmit="return false;">
        <div class="form-group">
          <select class="form-control" id="qCategory" onfocus="checkLogin('qCategory', <?php echo "'$username'"; ?>)" onchange="questionCategory(<?php echo "'$username'"; ?>)">
            <option value=""></option>
            <option value="java">Java</option>
            <option value="javascript">Javascript</option>
            <option value="php">Php</option>
            <option value="SQL">SQL</option>
            <option value="ajax">Ajax</option>
            <option value="css">Css</option>
            <option value="html">HTML</option>
            <option value="bootstrap">Bootstrap</option>
            <option value="jquery">jQuery</option>
            <option value="c">C</option>
            <option value="assembly">Assembly</option>
          </select>
        </div>
      </form>
    </div>

        <form id="post_form" onsubmit="return false;" class="form-group" style="display: none;">
            <p><b>Write your short question here.</b></p>
            <div id="quiz_div"> Question : <textarea id="quiz" class="form-control" onfocus="checkLogin('quiz',<?php echo "'$username'"; ?>)"></textarea></div><!--end of quiz_div-->
           
            <p><b>Describe your question in details, do not post code in this section. <a href="#">Click here </a>to add code.</b></p>
            <div id="quiz_description_div">Description : <textarea id="quiz_description"  class="form-control"></textarea></div><!--end of quiz_descrioption_div-->
            
            <p><b>Attach your code here.</b></p>
            <div id="quiz_code_div"><pre id="post_code"> <b>Code : </b><code ><textarea id="quiz_code"  class="code_area form-control"></textarea></code></pre></div><!--end of quiz_code_div-->
           
           <div><button id="cancel_quiz" onclick="toggleHtmlElement('post_form')"  class="btn btn-default"><b>Cancel</b></button><button id="submit_quiz" onclick="post_question(<?php echo "'$username'"; ?>)"  class="btn btn-default"><b>Post Question</b></button>
            </div><!--end of submit_quiz-->
            </form>
        </div><!--end of post_div -->
         <div id="000webhostAdvert1">
    
        <a href="https://www.000webhost.com/1105239.html" target="_blank"><img src="https://www.000webhost.com/images/banners/728x90/1.jpg" alt="Web hosting" width="728" height="90" border="0" /></a>

  </div>
</div>
<div class="col-sm-4">
  <div id="000webhostAdvert1">
    
  <a href="https://www.000webhost.com/1105239.html" target="_blank"><img src="https://www.000webhost.com/images/banners/300x250/2.jpg" alt="Web hosting" width="300" height="250" border="0" /></a>
  </div>

  <div class="quicklinks" style="background-color: lightyellow;">
    <h3>Quick links</h3>
    <div id="quicklinks">
<div id="addQuickLink">
        <?php echo $quicklinks; ?>
          
        </div>
    </div>
</div>
</div>

</div>
</div>
<?php //include_once("tmp/footer.php"); ?>