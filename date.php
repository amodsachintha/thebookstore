<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<p id="date"> </p>


<script type="text/javascript">


function defa(){

	var myBd = document.getElementById("dob").value;

	var bDay = new Date(myBd);
	var today = new Date();

	var age = today.getFullYear() - bDay.getFullYear(); 

	var day = bDay.getDay();
	var dayString;

	switch (day){
		case 0:
			dayString = "Sunday";
			break;

		case 1:
			dayString = "Monday";
			break;

		case 2:
			dayString = "Tuesday";
			break;

		case 3:
			dayString = "Wednesday";
			break;

		case 4:
			dayString = "Thursday";
			break;

		case 5:
			dayString = "Friday";
			break;

		case 6:
			dayString = "Saturday";
			break;

	}

	document.getElementById("date").innerHTML = "You were born on "+dayString+" and you are "+age+ " years old";
}
</script>




<input type="date" id="dob">
<a href="javascript:defa();"><button>checkDate</button></a>
	








</body>
</html>