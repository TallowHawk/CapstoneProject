<?php 
?>
<script>
	function Validate()
	{
		var msg="";
		/*
		if(!document.getElementById( "fName" ).value)
		{
			errMsg += "First Name<br/>";
			document.getElementById("fName").style.backgroundColor = "red";
		}
		else
		{
			document.getElementById("fName").style.backgroundColor = "white";
		}
		
		if(!document.getElementById( "lName" ).value)
		{
			errMsg += "Last Name<br/>";
			document.getElementById("lName").style.backgroundColor = "red";
		}
		else
		{
			document.getElementById("lName").style.backgroundColor = "white";
		}
		*/
		/*
		//regex from http://regexlib.com/REDetails.aspx?regexp_id=93
		var regtest = 20\d{2}(-|\/)((0[1-9])|(1[0-2]))(-|\/)((0[1-9])|([1-2][0-9])|(3[0-1]))(T|\s)(([0-1][0-9])|(2[0-3])):([0-5][0-9]):([0-5][0-9]);
		if(!regtest.test((document.getElementById( "defenceDate" ).value)))
		{
			errMsg += "Defence Date<br/>";
			document.getElementById("defenceDate").style.backgroundColor = "red";
		}
		else
		{
			document.getElementById("defenceDate").style.backgroundColor = "white";
		}
		*/
		/*
		no type error checking because its a radiobutton with capstone as preselected value
		so user can't disselect an option and the user can only select between 2 valid options
		*/
		
		if(!document.getElementById( "title" ).value)
		{
			errMsg += "Capstone title<br/>";
			document.getElementById("title").style.backgroundColor = "red";
		}
		else
		{
			document.getElementById("title").style.backgroundColor = "white";
		}
		
		if(!document.getElementById( "description" ).value)
		{
			errMsg += "Description<br/>";
			document.getElementById("description").style.backgroundColor = "red";
		}
		else
		{
			document.getElementById("description").style.backgroundColor = "white";
		}
		
		if (msg)
		{
			document.getElementById("FormMessage".innerHTML = "Please correctly fill out the following feild(s)\n" + msg);
			return false;
		}
		else
		{
			return true;
		}
	}
</script>
<h2>Create a new Capstone Project</h2>

<div id="FormMessage"> </div>

<main id="createCapstone">
	<form id ="create_capstone"
		method="post"
		onsubmit="return Validate()"
		action="">
		<!--
		<div class="form-group">
			<label for="fName">First Name</label>
            <input type="text" class="form-control" id="fName" name="fName" maxlength="20" size="20" required>
        </div>
		<div class="form-group">
			<label for="lName">Last Name</label>
            <input type="text" class="form-control" id="lName" name="lName" maxlength="20" size="20" required>
        </div>
		-->
		<div class="form-group">
			<label for="defenceDate">Desired Defence Date</label>
            <input type="text" class="form-control" id="defenceDate" name="defenceDate" maxlength="19" size="19" placeholder= "2018/05/07 16:30:00" value="2018/05/07 16:30:00" required>
        </div>
		<div class="radio">
            <label>
                <input type="radio" name="type" id="capstone" value="capstone" checked>
                Capstone
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="type" id="thesis" value="thesis">
                Thesis
            </label>
        </div>
		<div class="form-group">
			<label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" maxlength="100" size="20" required>
        </div>
		<div class="form-group">
			<label for="description">Description</label>
            <input type="textarea" class="form-control" id="description" name="description" rows="40" cols="20" style="vertical-align: top;" required>
        </div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</main>