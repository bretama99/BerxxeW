<?php
include ('../../constants/security/hash.php');
?>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title"><?php echo $lang['prescriptionHeader']; ?></h4>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<form method="post" action="">
						<fieldset>
							<div class="col-sm-2">
								<label for="form-field-8"><?php echo $lang['mobilePhone']; ?></label>
								<input type="text" name="mobilePhone" class="form-control" id="mobilePhone" placeholder="Mobile phone" onkeyup="displayPatients();">
							</div>
							<div class="col-sm-2">
								<label for="form-field-8"><?php echo $lang['firstName']; ?></label>
								<input type="text" name="firstName" class="form-control" id="firstName" placeholder="<?php echo $lang['firstName']; ?>" onkeyup="displayPatients();">
							</div>
							<div class="col-sm-2">
								<label for="form-field-8"><?php echo $lang['fatherName']; ?></label>
								<input type="text" name="fatherName" class="form-control" id="fatherName" placeholder="Father name" onkeyup="displayPatients();">
							</div>
							<div class="col-sm-2">
								<label for="form-field-8"><?php echo $lang['grandFatherName']; ?></label>
								<input type="text" name="grandFatherName" class="form-control" id="grandFatherName" placeholder="Grandfather name" onkeyup="displayPatients();">
							</div>

							<div class="col-sm-2">
								<label for="form-field-8"><?php echo $lang['patientId']; ?></label>
								<input type="text" name="MPI" class="form-control" id="MPI" placeholder="Patient Id " onkeyup="displayPatients();">
							</div>
							<div class="col-sm-1">
								<input type="hidden" name="custodianPhone" class="form-control" id="custodianPhone" placeholder="Emergency Contact" onkeyup="displayPatients();">
							</div>
							<div class="col-sm-1">
								<input type="hidden" name="prescriptionDate" class="form-control" id="prescriptionDate" placeholder="Prescription Date" onkeyup="displayPatients();">
							</div>
							<div class="col-sm-2"><br>
								<span class="btn btn-info">
									Search
									<i class="ace-icon fa fa-search  align-top bigger-125 icon-on-right"></i>
								</span>
							</div>
						</fieldset>

						<table id="example" class="table table-stripped table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th style="min-width: 13vw;"><?php echo $lang['fullName']; ?></th>
									<th><?php echo $lang['mobilePhone']; ?></th>
									<th><?php echo $lang['custodianPhone']; ?></th>
									<th><?php echo $lang['prescriptionDate']; ?></th>
									<th><?php echo $lang['patientId']; ?></th>
									<th><?php echo $lang['prescribe']; ?></th>
								</tr>
							</thead>
							<tbody>
								<tr></tr>
							</tbody>
						</table>
						<div class="form-actions">
							<a href='?name=hub/prescriptions/prescribe/addprescription&var=prescriptions' type="button" class="btn btn-purple btn-sm">
								<span class="ace-icon fa fa-plus icon-on-right bigger-110"></span>
								<?php echo $lang['prescribeButton']; ?>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function displayPatients() {
				var firstName = document.getElementById("firstName").value;
				var fatherName = document.getElementById("fatherName").value;
				var grandFatherName = document.getElementById("grandFatherName").value;
				var mobilePhone = document.getElementById("mobilePhone").value;
				var MPI = document.getElementById("MPI").value;
				var custodianPhone = document.getElementById("custodianPhone").value;
				var prescriptionDate = document.getElementById("prescriptionDate").value;


				if (firstName.length >= 2 || fatherName.length >= 2 || grandFatherName.length >= 2 || mobilePhone.length >= 4 || MPI.length >= 2) {
					$.ajax({
						type: "POST",
						url: 'hub/prescriptions/prescribe/models/displaypatients.php',
						dataType: 'json',
						data: {
							firstName: firstName,
							fatherName: fatherName,
							grandFatherName: grandFatherName,
							mobilePhone: mobilePhone,
							MPI: MPI,
							prescriptionDate: prescriptionDate,
							custodianPhone: custodianPhone
						},
						success: function(successData) {
							var id = 1;
							var table = document.getElementById("example");
							for (var i = table.rows.length - 1; i > 0; i--) {
								table.deleteRow(i);
							}

							$.each(successData, function(key, value) {

								$("#example").append("<tr> <td>" + id + "</td>" +
									"<td><a href='?name=hub/prescriptions/prescribe/addprescription&var=prescriptions&Id=" + value.usersId + "'>" + value.titleName + " " + value.firstName + " " + value.fatherName + " " + value.grandFatherName + "</a></td>" +
									"<td>" + value.mobilePhone + "</td>" +
									"<td>" + value.custodianPhone + "</td>" +
									"<td>" + value.prescriptionDate + "</td>" +
									"<td>" + 'eRx-' + value.MPI + "</td>" +
									"<td>" +
									"<a href='?name=hub/prescriptions/prescribe/addprescription&var=prescriptions&Id=" + value.usersId + "' class='blue'>Prescribe <i class='ace-icon fa fa-headphones bigger-120'></i></a>" +
									"</td>" +
									"<tr>");
								id++;
							});

							if (id == 1) {
								$("#example").append("<tr>" +
									"<td><b>Search details doesn't match </b></td>" +
									"<tr>");
							}
						}

					});
				}

			}
		</script>
	</div>
</div>