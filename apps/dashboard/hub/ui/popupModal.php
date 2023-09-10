<?php ?>
<div id="modal-table" class="modal fade" tabindex="-1">
	<br><br>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div id="modalHeader" class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
				</div>
			</div>
			<div id="notDispensed"> </div>
			<div class="modal-body no-padding">
				<form name="addPrescriptionForm" method="post" action=" ">
					<table id="otherDetails" class="table table-striped table-bordered table-hover">

					</table>
				</form>
			</div>
			<div id="modalFooter" class="modal-footer no-margin-top">
				<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div>
	</div>
</div>