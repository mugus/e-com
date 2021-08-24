	const errors = [];
	const valids = [];
	var valid = 0;
	var fields = 0;
	
	$(document).ready(function(){
		$(".cover").hide();
		$(".close").click(function(){
			$(".cover").fadeOut();
		});
	});
	
	function numField(identifier, less, least) {
		var field = document.getElementById(identifier);
		/*if((data.value).trim() == '') {
			alert();
		}*/
        field.style.width='100%';
		if(field.title == 'required' && ((field.value).trim()).length < 1){
			setErrorFor(field, identifier, "Please fill out this field!");
			return false;
		}
		if(((field.value).trim()).length < less && ((field.value).trim()).length > 0){
			setErrorFor(field, identifier, "required "+ identifier +" must be atleast "+ less +" character length!");
			return false;
		}
		else if(((field.value).trim()).length > least) {
			setErrorFor(field, identifier, "required "+ identifier +" must be less "+ least +" character length!");
			return false;
		}
		else if(isNaN((field.value).trim())) {
			setErrorFor(field, identifier, identifier + " is numeric field!");
			return false;
		}
		else {
			setSuccessFor(field, identifier);
			return true;
		}
	}
	
	function numFieldnw(identifier, less) {
		var field = document.getElementById(identifier);
		/*if((data.value).trim() == '') {
			alert();
		}*/
        field.style.width='100%';
		if(field.title == 'required' && ((field.value).trim()).length < 1){
			setErrorFor(field, identifier, "Please fill out this field!");
			return false;
		}
		if(((field.value).trim()).length < less && ((field.value).trim()).length > 0){
			setErrorFor(field, identifier, "Enough Quantity Required");
			return false;
		}
		else if(isNaN((field.value).trim())) {
			setErrorFor(field, identifier, identifier + " is numeric field!");
			return false;
		}
		else {
			setSuccessFor(field, identifier);
			return true;
		}
	}
	
	function priceField(identifier, less) {
		var field = document.getElementById(identifier);
		/*if((data.value).trim() == '') {
			alert();
		}*/
        field.style.width='100%';
		if(field.title == 'required' && ((field.value).trim()).length < 1){
			setErrorFor(field, identifier, "Please fill out this field!");
			return false;
		}
		if(((field.value).trim()).length < less && ((field.value).trim()).length > 0){
			setErrorFor(field, identifier, "Please Price must be greater than 99");
			return false;
		}
		else if(isNaN((field.value).trim())) {
			setErrorFor(field, identifier, identifier + " is numeric field!");
			return false;
		}
		else {
			setSuccessFor(field, identifier);
			return true;
		}
	}

	function textField(identifier, least) {
		var field = document.getElementById(identifier);
		/*if((data.value).trim() == '') {
			alert();
		}*/
        field.style.width='100%';
        field.style.height='100%';
		if(field.title == 'required' && ((field.value).trim()).length < 1){
			setErrorFor(field, identifier, "Please fill out this field!");
			return false;
		}
		if(((field.value).trim()).length > least) {
			setErrorFor(field, identifier, "required "+ identifier +" must be less "+ least +" character length!");
			return false;
		}
		
		else {
			setSuccessFor(field, identifier);
			return true;
		}
	}

	function stringField(identifier, least) {
		var field = document.getElementById(identifier);
		/*if((data.value).trim() == '') {
			alert();
		}*/
        field.style.width='100%';
        field.style.height='100%';
		if(field.title == 'required' && ((field.value).trim()).length < 1){
			setErrorFor(field, identifier, "Please fill out this field!");
			return false;
		}
		if(((field.value).trim()).length > least) {
			setErrorFor(field, identifier, "required "+ identifier +" must be less "+ least +" character length!");
			return false;
		}
		else if(!(isNaN((field.value).trim())) && ((field.value).trim()).length > 0) {
			setErrorFor(field, identifier, identifier + " is not numeric field!");
			return false;
		}
		else {
			setSuccessFor(field, identifier);
			return true;
		}
	}
	
	function emailField(identifier) {
		var field = document.getElementById(identifier);
        field.style.width='100%';
		var validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		
		// if(((field.value).trim()).length > least){
		// 	setErrorFor(field, identifier, "required "+ identifier +" must be less "+ less +" character length!");
		// 	return false;
		// }
		// else
		 if(((field.value).trim()).match(validEmail)) {
			setSuccessFor(field, identifier);
			return true;
		}
        else if(field.title == 'required' && ((field.value).trim()).length < 1) {
            setErrorFor(field, identifier, "Please fill this field.");
			return false;
        }
		else {
			setErrorFor(field, identifier, "invalid email, check it again!");
			return false;
		}
	}
	
	function maximumLength(identifier, least) {
		var field = document.getElementById(identifier);
        field.style.width='100%';
		if(((field.value).trim()).length > least) {
			setErrorFor(field, identifier, "required "+ identifier +" must be less "+ least +" character length!");
			return false;
		} 
        else if(field.title == 'required' && ((field.value).trim()).length < 1) {
            setErrorFor(field, identifier, "Please fill this field.");
			return false;
        }
        else {
            setSuccessFor(field, identifier);
			return true;
        }
	}
	
	function phoneField(identifier) {
		var validPhone = /^\(?[+]\)?([0-9]+)$/; 
		var validShortPhone = /^\(?\)?([0-9]+)$/;
		var field = document.getElementById(identifier);
        field.style.width='100%';
        if(((field.value).trim()).match(validPhone) || ((field.value).trim()).match(validShortPhone)) {
			setSuccessFor(field, identifier);
			return true;
		}
		else if(field.title == 'required' && ((field.value).trim()).length < 1){
            setErrorFor(field, identifier, "Please fill this field.");
			return false;
        } 
        else {
			setErrorFor(field, identifier, "Invalid phone number!");
			return false;
		}
	}
	
	function usernameField(identifier, less, least) {
		var field = document.getElementById(identifier);
		/*if((data.value).trim() == '') {
			alert();
		}*/
        field.style.width='100%';
		// var validUsername = /^(?=.*[0-9])(?=.*[!@#$%^&*.])[a-zA-Z0-9!@#$%^&*.]{6,20}$/;
		if(field.title == 'required' && ((field.value).trim()).length < 1){
			setErrorFor(field, identifier, "Please fill out this field!");
			return false;
		}
		if(((field.value).trim()).length < less && ((field.value).trim()).length > 0){
			setErrorFor(field, identifier, "required "+ identifier +" must be atleast "+ less +" character length!");
			return false;
		}
		else if(((field.value).trim()).length > least) {
			setErrorFor(field, identifier, "required "+ identifier +" must be less "+ least +" character length!");
			return false;
		}
		else{
			setSuccessFor(field, identifier);
			return true;
		}
	}
	
	function passwordField(identifier, less) {
		var field = document.getElementById(identifier);
        field.style.width='100%';
		var validPass = /^(?=.*[0-9])(?=.*[!@#$%^&*.])[a-zA-Z0-9!@#$%^&*.]{6,20}$/;
		if(((field.value).trim()).length < 1) {
			setErrorFor(field, identifier, 'This field is required please!');
			return false;
		}
		if(((field.value).trim()).length < less && ((field.value).trim()).length > 0){
			setErrorFor(field, identifier, "Required Password must be atleast "+ less +" character length!");
			return false;
		}
		else if(((field.value).trim()).match(validPass)){
			setSuccessFor(field, identifier);
			return true;
		}
		else{
			setErrorFor(field, identifier, "Make a Strong Password by using numbers & symbols! like(ex: 83@student)");
			return false;
		}
	}
	
	function confirmField(conf, pass){
		var con = document.getElementById(conf);
		var pwd = document.getElementById(pass);
        con.style.width='100%';
		if(pwd.value == null || pwd.value == "" || errors.indexOf(pass) != -1){
			setErrorFor(con, conf, 'Make sure of what you are confirming is right...');
			return false;
		}
		else if(con.value != pwd.value){
			setErrorFor(con, conf, 'Confirmation mismatch...');	
			return false;
		}
		else{
			setSuccessFor(con, conf);	
			return true;
		}
	}
	
	function DateFieldCheck(identifier, LimitAge){
		var f_val = document.getElementById(identifier);
		f_val.style.width='100%';
		f_val.style.transition='0.1s ease-out';
		var todayDate = new Date(); //Today Date    
		var dateOne = new Date(f_val.value);
		
		if (todayDate < dateOne || (todayDate.getFullYear() - dateOne.getFullYear()) < LimitAge){
			setErrorFor(f_val, identifier, 'Invalid date');
			$(".special").slideUp(2000);
			return false;
		}
		else{
			setSuccessFor(f_val, identifier);

			if((todayDate.getFullYear() - dateOne.getFullYear()) < 6) {
				$(".special").fadeIn(2000);
			}
			else {
				$(".special").slideUp(2000);
			}
			return true;
		}
	}

	function checkFormInput(name) {
		var form = document.getElementById(name);
		inputField = form.querySelector("input[title='required']").title;
		if(inputField == 'required') {
			$(".assignCaseForm").fadeIn(function(){
				$(".textMsg").html("Fill out all required fields before you submit. <br>");
			});
			$(".responseMessage").html("Fill out all required fields before you submit.<br>");
			return false;
		}
		else {
			return true;
		}
	}
	
	function checkFormTextarea(name) {
		var form = document.getElementById(name);
		textarea = form.querySelector("textarea[title='required']").title;
		if(textarea == 'required') {
			$(".textMessage").text("Please Fill This Field");
			// $(".cover").fadeIn(function(){
			// 	$(".textMessage").text("Please Fill This Field");
			// });
			return false;
		}
		else {
			return true;
		}
	}
	
	function setErrorFor(input, input_name, message){
		input.className = 'error form-control form-control-lg light-300';
		input.title = 'required';
		const formControl = input.parentElement;
		const span = formControl.querySelector('span');
		span.innerHTML = "<small style='color: #d92550;'>"+message+"<small>";
		span.style.visibility = 'visible';
		//formControl.className = 'form-input error';
		if(errors.indexOf(input_name) == -1){
			errors.push(input_name);
			if(valids.indexOf(input_name) >  -1){
				valids.splice(valids.indexOf(input_name));
				valid--;
			}
		}
	}
	
	function setSuccessFor(input, input_name){
		input.className = 'success form-control form-control-lg light-300';
		input.title = 'completed';
		const formControl = input.parentElement;
		const span = formControl.querySelector('span');
		span.innerText = "success";
		span.style.visibility = 'hidden';
		//formControl.className = 'form-input success';
		valid = valid + 1;
		if(errors.indexOf(input_name) >  -1){
			errors.splice(errors.indexOf(input_name));
			valids.push(input_name);
		}else {
			valids.push(input_name);
		}
	
	}
	