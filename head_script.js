 function searchDB(){
            var searchValue = document.getElementById("searchField").value;
           window.scrollTo(0,0);
           if (searchValue == "") {
             document.getElementById("foundElementDiv").style.display = 'none';
           }else{
     document.getElementById("foundElementDiv").style.display = 'block';

     var xml = new XMLHttpRequest();
     xml.open("POST","search.php",true);
     xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xml.onreadystatechange = function(){
        if (xml.readyState == 4 & xml.status == 200) {
            var searchResults = this.responseText;
            //alert("results "+searchResults);
             document.getElementById("foundElementDiv").innerHTML = searchResults;

        }
     } 
     xml.send("searchValue="+searchValue);
           }
        }
        function hideResultDiv(){
            document.getElementById("foundElementDiv").style.display = 'none';
        }
        function signup(){
            window.location = 'signup.php';
        }
        function login(){
            window.location = 'login.php';
        }