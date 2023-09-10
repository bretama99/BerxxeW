function cleanNum(el){
	var tf = document.getElementById(el);
	var regex = /[^a-z ሀ-ፖ \b .]/gi;
	if(tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
        }
}

function dateInput(el){
	var tf = document.getElementById(el);
	var regex = /[^0-9-]/gi;
	if(tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
        }
}

function cleanChar(el){
	var tf = document.getElementById(el);
	var regex = /[^0-9.]/gi;
	if(tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
        }
}

function cleanSomeSpecial(el){
	var tf = document.getElementById(el);
	var regex = /[^a-z 0-9 ሀ-ፖ \b ? / . -]/gi;
	if(tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
        }
}

function cleanSpecial(el){
	var tf = document.getElementById(el);
	var regex = /[^a-z 0-9 ሀ-ፖ \b .]/gi;
	if(tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
        }
}

function passwordChars(el){
	var tf = document.getElementById(el);
	var regex = /[^a-z 0-9 ? \b .]/gi;
	if(tf.value.search(regex) > -1) {
		tf.value = tf.value.replace(regex, "");
        }
}
function check_empty_select(el)
  {
	var select = document.getElementById(el);
	if(select == ""){
				document.getElementById("selectionErr").innerHTML="Required".fontcolor("red").fontsize(2);
			}
			
  }