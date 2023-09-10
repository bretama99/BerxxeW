<?php if(isset($_SESSION['success'])){?>
<div class="alert alert-block alert-success" style="margin-left:50%;">
		<button type="button" class="close" data-dismiss="alert">
			&nbsp; <i class="ace-icon fa fa-times"></i>
		</button>
		<i class="ace-icon fa fa-check green"></i> &nbsp; Operation Succefully Completed
</div>
<?php
		unset($_SESSION['success']);
	}?>