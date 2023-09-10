function validate_dates(el) {
	var tf = document.getElementById(el)
	var regex = /[^0-9 /]/gi;
	if (tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
	} else {
		var tf = document.getElementById(el)
		var tf1 = document.getElementById(el).value;
		var digit = 0;
		if (tf1.length == 2) {
			for (var i = 0; i <= tf1.length; i++) {
				if (tf1.charAt(i) >= "0" && tf1.charAt(i) <= "9") {
					digit++;
				}
			}
			if (digit == 2) {
				document.getElementById(el).value = tf1 + '/';
				tf1 = tf1 + '/';
			}
		}
		if (tf1.length == 5) {
			for (var i = 0; i <= tf1.length; i++) {
				if (tf1.charAt(i) >= "0" && tf1.charAt(i) <= "9") {
					digit++;
				}
			}
			if (digit == 4) {
				document.getElementById(el).value = tf1 + '/';
				tf1 = tf1 + '/';
			}
		}
	}
}
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

		if (password.length >= 0 && password.length <= 4) {
			document.getElementById("PasswordErr").innerHTML = "&#9888; ደካማ".fontcolor("red").fontsize(2);
			return false;
		}
		if (password.length > 4 && password.length <= 6) {
			document.getElementById("PasswordErr").innerHTML = "&#9888;  መካከለኛ".fontcolor("orange").fontsize(2);
			return false;
		}
		if (password.length > 5) {

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

			if ((lower == 0 && upper == 0) || digit == 0) {
				document.getElementById("PasswordErr").innerHTML = "&#9888; ፊደልና ቁጥር ያስገቡ".fontcolor("red").fontsize(2);
				return false;
			}
			else if ((lower != 0 || upper != 0) && digit > 0 && sChar > 0) {
				document.getElementById("PasswordErr").innerHTML = "&#10004; ጠንካራ".fontcolor("green").fontsize(2);
				return true;
			}

		} // end of if(password.length >7)
	}

} // end of pawword validation


function Pwd_match(el) // tell the user pwd match while typing
{
	var tf = document.getElementById(el)
	var regex = /[^a-z 0-9 ? \b .]/gi;
	if (tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
	}
	else {
		var confirm = document.getElementById("C_password").value;
		if (confirm == password) {
			document.getElementById("confirmErr").innerHTML = "&#10004; ትክክል".fontcolor("green").fontsize(2);
			return true;
		} else {
			document.getElementById("confirmErr").innerHTML = "&#10004; እኩል ኣይደሉም".fontcolor("red").fontsize(2);
			return false;
		}
	}
}


function validate_Confirm() {
	var password = document.getElementById("password").value;
	var confirm = document.getElementById("C_password").value;
	if (confirm == "") {
		document.getElementById("confirmErr").innerHTML = "የይለፍ ቃል ይድገሙት".fontcolor("red").fontsize(2);
		return false;
	}
	if (confirm != password) {
		document.getElementById("confirmErr").innerHTML = "&#9888; እኩል ኣይደሉም".fontcolor("orange").fontsize(2);
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
		document.getElementById("FormErr").innerHTML = " የይለፍ ቃሎቹ እኩል ኣይደሉም".fontcolor("red").fontsize(2);
		return false;
	}
}

function Validate_phone(Phone_number) {
	var Phone_1 = /^[+. ][2. ][5. ][1. ][9. ]([0-9]{8})$/;
	var Phone_2 = /^[0. ][9. ]([0-9]{8})$/;
	var Phone_no = document.getElementById(Phone_number).value;
	if (Phone_no.match(Phone_1) || Phone_no.match(Phone_2)) {
		document.getElementById("phone_error").innerHTML = "&#10004; ትክክል".fontcolor("green").fontsize(2);
		return true;
	}
	else {
		document.getElementById("phone_error").innerHTML = "&#9888; XXXX".fontcolor("red").fontsize(2);
		return false;
	}
}  