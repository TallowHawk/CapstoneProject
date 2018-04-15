<?php ?>
<h2>Hello, {Student}</h2>

<form id ="create_capstone"
		method="post"
		onsubmit=""
	>

	<span>First Name:</span>
	<input
		name="fName"
		id="fName"
		maxlength="20"
		size="20"
		placeholder=""
		value=""
	/>
	
	<span>Last Name:</span>
	<input
		name="lName"
		id="lName"
		maxlength="20"   
		size="20"
		placeholder=""
		value=""
	/>
	
	<span>Title:</span>
	<input
		name="title"
		id="title"
		maxlength="20"   
		size="20"
		placeholder=""
		value=""
	/>
	
	<span>Desired Defence Date:</span>
	<input
		name="defenceDate"
		id="defenceDate"
		maxlength="10"   
		size="10"
		placeholder="MM/DD/YYYY"
		value=""
	/>
	
	<span>Description:</span>
	<textarea
		name="description"
		id="description"
		rows="40"   
		cols="20"
		style="vertical-align: top;"
	/>
	</textarea>
	
	
	<input
		type="submit"
	/>
	
</form>