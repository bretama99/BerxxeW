function validate_Passwords(el) // validates password while typing
{
	var tf = document.getElementById(el)
	var regex = /[^a-z 0-9 ? \b . @ # $ & * ! ]/gi;
	if (tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
	}
	else {
		password = document.getElementById("password").value;
		var upper = 0;
		var lower = 0;
		var digit = 0;
		var sChar = 0;
		var i;

		if (password.length >= 0 && password.length <= 3) {
			document.getElementById("PasswordErr").innerHTML = "&#9888; Weak".fontcolor("red").fontsize(2);
			return false;
		}
		// if (password.length > 4 && password.length <= 6) {
		// 	document.getElementById("PasswordErr").innerHTML = "&#9888;  Medium".fontcolor("orange").fontsize(2);
		// 	return false;
		// }
		if (password.length >= 4) {

			for (var i = 0; i <= password.length; i++) {
				if (password.charAt(i) >= "A" && password.charAt(i) <= "Z") {
					upper++;
				}
				if (password.charAt(i) >= "a" && password.charAt(i) <= "z") {
					lower++;
				}
				if (password.charAt(i) >= "0" && password.charAt(i) <= "9") {
					digit++;
				}
				if (password.charAt(i) === "@" || password.charAt(i) === "#" || password.charAt(i) === "$" || password.charAt(i) === "&" || password.charAt(i) === "!" || password.charAt(i) === "*") {
					sChar++;
				}
			} // end of loop for counting d/t types of symbols

			if ((lower != 0 && upper != 0) && digit == 0) {

				document.getElementById("PasswordErr").innerHTML = "&#9888; Enter Digits And Atleast One Special Character".fontcolor("red").fontsize(2);
				return false;
			}
			else if (lower != 0 && upper != 0 && digit > 0 && sChar > 0) {
				document.getElementById("PasswordErr").innerHTML = "&#10004; Strong".fontcolor("green").fontsize(2);
				return true;
			}

		} // end of if(password.length >7)
	}

} // end of pawword validation

function validate_Startdate(el) // validates date range
{
	Start_Date_GC = document.getElementById("Start_Date_GC").value;
	P_Lookup_Id = document.getElementById("P_Lookup_Id").value;
	var array = Start_Date_GC.split('-'),
		month = array[1];

	// change month and P_Lookup_Id to num 
	var P_Lookup_Id_num = new Number(P_Lookup_Id);
	var month_num = new Number(month);

	if (P_Lookup_Id >= 1 && P_Lookup_Id <= 4) {
		month_num = month_num - 8;
	}
	if (P_Lookup_Id >= 5 && P_Lookup_Id <= 12) {
		month_num = month_num + 4;
	}

	if (P_Lookup_Id != '') {
		if (month_num == P_Lookup_Id_num) {
			document.getElementById("StartDateErr").innerHTML = "";
			return true;
		}
		else {
			document.getElementById("Start_Date_GC").value = "";
			document.getElementById("StartDateErr").innerHTML = "&#9888; Month should be the same with above ".fontcolor("red").fontsize(2);
			return false;
		}
	}
	else {
		document.getElementById("StartDateErr").innerHTML = "&#9888; please select Month above".fontcolor("red").fontsize(2);
	}

} // end of Startdate


function validate_Enddate(el) // validates date range
{

	End_Date_GC = document.getElementById("End_Date_GC").value;
	P_Lookup_Id = document.getElementById("P_Lookup_Id").value;
	var array = End_Date_GC.split('-'),
		month = array[1];
	Eday = array[2];
	Start_Date_GC = document.getElementById("Start_Date_GC").value;
	var Sarray = Start_Date_GC.split('-'),
		Sday = Sarray[2];
	// change days to num
	var Eday_num = new Number(Eday);
	var Sday_num = new Number(Sday);

	if (Eday_num >= Sday_num) {
		// change month and P_Lookup_Id to num 
		var P_Lookup_Id_num = new Number(P_Lookup_Id);
		var month_num = new Number(month);

		if (P_Lookup_Id >= 1 && P_Lookup_Id <= 4) {
			month_num = month_num - 8;
		}
		if (P_Lookup_Id >= 5 && P_Lookup_Id <= 12) {
			month_num = month_num + 4;
		}

		if (P_Lookup_Id != '') {
			if (month_num == P_Lookup_Id_num) {
				document.getElementById("EndDateErr").innerHTML = "";
				return true;
			}
			else {
				document.getElementById("End_Date_GC").value = "";
				document.getElementById("EndDateErr").innerHTML = "&#9888; Month should be the same with above".fontcolor("red").fontsize(2);
				return false;
			}
		}
		else {
			document.getElementById("EndDateErr").innerHTML = "&#9888; please select Month above".fontcolor("red").fontsize(2);
		}
	}
	else {
		document.getElementById("EndDateErr").innerHTML = "&#9888; End date should be greater than start date".fontcolor("red").fontsize(2);
		return false;
	}
} // end of Startdate




function validate_dates() {
	var caller1 = validate_Startdate();
	var caller2 = validate_Enddate();

	if (caller1 == true && caller2 == true)
	// means if all called validator functions return true it loads the next page
	{
		return true;
	}
	else {
		document.getElementById("EndDateErr").innerHTML = "Invalid Date range".fontcolor("red").fontsize(2);
		return false;
	}
}

function Pwd_match(el) // tell the user pwd match while typing
{
	var tf = document.getElementById(el)
	var regex = /[^a-z 0-9 ? \b . @ # $ & * ! ]/gi;
	if (tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
	}
	else {
		var confirm = document.getElementById("confirm_password").value;
		if (confirm == password) {
			document.getElementById("confirmErr").innerHTML = "&#10004;Correct".fontcolor("green").fontsize(2);
			return true;
		} else {
			document.getElementById("confirmErr").innerHTML = "Not equal".fontcolor("red").fontsize(2);
			return false;
		}
	}
}


function validate_Confirm() {
	var password = document.getElementById("password").value;
	var confirm = document.getElementById("C_password").value;
	if (confirm == "") {
		document.getElementById("confirmErr").innerHTML = "".fontcolor("red").fontsize(2);
		return false;
	}
	if (confirm != password) {
		document.getElementById("confirmErr").innerHTML = "Not equal".fontcolor("red").fontsize(2);
		return false;
	}
	else {
		return true;
	}

}



function validate_form() {
	var caller1 = validate_Passwords();
	var caller2 = validate_Confirm();

	if (caller1 == true && caller2 == true)
	// means if all called validator functions return true it loads the next page
	{
		return true;
	}
	else {
		document.getElementById("FormErr").innerHTML = "Not equal".fontcolor("red").fontsize(2);
		return false;
	}
}


function Validate_phone(Phone_number) {
	var Phone_1 = /^[+. ][2. ][5. ][1. ][9. ]([0-9]{8})$/;
	var Phone_2 = /^[0. ][9. ]([0-9]{8})$/;
	var Phone_no = document.getElementById(Phone_number).value;
	if (Phone_no.match(Phone_1) || Phone_no.match(Phone_2)) {
		document.getElementById("phone_error").innerHTML = "&#10004; Correct".fontcolor("green").fontsize(2);
		return true;
	}
	else {
		document.getElementById("phone_error").innerHTML = "&#9888; Invalid Phone".fontcolor("red").fontsize(2);
		document.getElementById("SignUp").disabled = false;
		document.getElementById("changePassword").disabled = false;
		return false;
	}
}

