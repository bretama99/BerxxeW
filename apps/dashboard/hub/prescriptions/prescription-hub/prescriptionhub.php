<?php 
include ('../../constants/security/hash.php');
if (isset($_SESSION['pharmacyId']) || $_SESSION['rolesId'] == 4) { ?>

	<div class="row">
		<div class="col-sm-12">
			<div class="widget-box">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title">Search Presciption</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<form>
							<!-- <legend>Form</legend> -->
							<fieldset>
								<div class="col-sm-2">
									<label for="form-field-8"><?php echo $lang['mobilePhone']; ?></label>
									<input type="text" name="mobilePhone" class="form-control" id="mobilePhone" placeholder="Mobile phone" onkeyup="displayPrescriptions();">
								</div>
								<div class="col-sm-2">
									<label for="form-field-8"><?php echo $lang['firstName']; ?></label>
									<input type="text" name="firstName" class="form-control" id="firstName" placeholder="<?php echo $lang['firstName']; ?>" onkeyup="displayPrescriptions();">
								</div>
								<div class="col-sm-2">
									<label for="form-field-8"><?php echo $lang['fatherName']; ?></label>
									<input type="text" name="fatherName" class="form-control" id="fatherName" placeholder="Father name" onkeyup="displayPrescriptions();">
								</div>
								<div class="col-sm-2">
									<label for="form-field-8"><?php echo $lang['grandFatherName']; ?></label>
									<input type="text" name="grandFatherName" class="form-control" id="grandFatherName" placeholder="Grandfathe name" onkeyup="displayPrescriptions();">
								</div>
								<div class="col-sm-2">
									<label for="form-field-8"><?php  ?></label>
									<input type="hidden" name="prescriptionDate" class="form-control" id="prescriptionDate" placeholder="Date" onkeyup="displayPrescriptions();">
								</div>
								<div class="col-sm-2">
									<label for="form-field-8"><?php  ?></label>
									<input type="hidden" name="prescriber Name" class="form-control" id="prescriptionDate" placeholder="Date" onkeyup="displayPrescriptions();">
								</div>
							</fieldset>

							<div class="form-actions center" style="height:45px;">
								<div class="input-group col-sm-3 col-sm-offset-3" style="margin-top:-7px;">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-check"></i>
									</span>

									<input type="text" id="prescriptionId" class="form-control search-query" placeholder="Prescription ID" />
									<span class="input-group-btn">
										<button type="button" onclick="goToMedicationDetail()" class="btn btn-purple btn-sm">
											<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
											Search
										</button>
									</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="widget-box">
				<div class="widget-header widget-header-small">
					<h5 class="widget-title smaller">Search Results</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<form method="post" action="">
							<table id="example" class="table table-stripped table-bordered table-hover">
								<thead>
							<!-- 		<tr>
										<th>#</th>
										<th style="min-width: 13vw;"><?php echo $lang['fullName']; ?></th>
										<th><?php echo $lang['mobilePhone']; ?></th>
										<th><?php echo $lang['prescriptionDate']; ?></th>
										<th><?php echo $lang['dispense']; ?></th>
									</tr> -->
								</thead>

								<tbody>
									<tr></tr>
									<tr></tr>
									<?php if (isset($_GET['search'])) { ?>
										<td style="color:#e80909;">Prescription ID is not valid</td>
									<?php } ?>
								</tbody>
							</table>
						</form>

					</div>
				</div>
			</div>
			<script type="text/javascript">
				function goToMedicationDetail() {
					var prescriptionId = document.getElementById("prescriptionId").value;
					if (prescriptionId != "") {
						window.location.href = "?name=hub/prescriptions/prescription-hub/dispenceprescription&var=prescriptionHub&epId=" + prescriptionId;
					}
				}

				function displayPrescriptions() {
					var firstName = document.getElementById("firstName").value;
					var fatherName = document.getElementById("fatherName").value;
					var grandFatherName = document.getElementById("grandFatherName").value;
					var mobilePhone = document.getElementById("mobilePhone").value;
					var prescriptionDate = document.getElementById("prescriptionDate").value;

					$.ajax({
						type: "POST",
						url: 'hub/prescriptions/prescription-hub/models/displayhub.php',
						dataType: 'json',
						data: {
							firstName: firstName,
							fatherName: fatherName,
							grandFatherName: grandFatherName,
							mobilePhone: mobilePhone,
							prescriptionDate: prescriptionDate
						},
						success: function(successData) {
							var id = 1;
							var table = document.getElementById("example");
							for (var i = table.rows.length - 1; i > 0; i--) {
								table.deleteRow(i);
							}

							$.each(successData, function(key, value) {
								$("#example").append("<tr> <td>" + id + "</td>" +
									"<td><a href='?name=hub/prescriptions/prescription-hub/dispenceprescription&var=prescriptionHub&Id=" + value.prescriptionId + "'>" + value.titleName + " " + value.firstName + " " + value.fatherName + " " + value.grandFatherName + "</a></td>" +
									"<td>" + value.mobilePhone + "</td>" +
									"<td>" +
									value.prescriptionDate +
									"</td>" +
									"<td>" +
									"<a href='?name=hub/prescriptions/prescription-hub/dispenceprescription&var=prescriptionHub&Id=" + value.prescriptionId + "' class='blue'><span class='label label-lg label-info arrowed-in arrowed-right'><i class='ace-icon fa fa-gift bigger-120'></i> Prescription Detail <i class='ace-icon fa fa-arrow-circle-right'></i></span></a>" +
									"</td>" +
									"<tr>");
								id++;
							});

							if (id == 1) {
								$("#example").append("<tr>" +
									"<td style='color:#e80909;'><b>Search details doesn't match </b></td>" +
									"<tr>");
							}
						}
					});
				}
			</script>
		</div>
	</div>
<?php } else {
?>
	<div class="alert alert-block alert-warning" style="margin-left:50%;">
		<button type="button" class="close">
			&nbsp; <i class="ace-icon fa fa-times"></i>
		</button>
		<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; Make sure you select a pharmacy from the dropdown menu. Otherwise, you may not have access to the prescription hub.
	</div>
<?php
} ?>