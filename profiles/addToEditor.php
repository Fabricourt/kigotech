<!DOCTYPE html>
<html>
<head>
	<title>editor</title>
<script type="text/javascript" src="../js/main.js"></script>
	
</head>
<body>
<div id="dd">
	Paragraph data
	</div>
	<textarea id="t1"></textarea>
	<button onmousedown ="add()">click me</button>

<script type="text/javascript">
		function add(){
			var data = _("dd").value;
			alert(data);
			//document.getElementById(id2).innerHTML = data;
		}
	</script>
</body>
</html>