<?php
if (!empty($usrUsersId)) {
	$usersId = $usrUsersId
?>
	<div class="row">
		<div class="col-xs-12">
			<?php include('common/messages/success_message.php'); ?>
			<?php if (isset($_SESSION['success_user'])) { ?>
				<div class="alert alert-block alert-success" style="margin-left:40%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check green"></i> &nbsp; <?php echo $_SESSION['success_user']; ?>
				</div>
			<?php
				unset($_SESSION['success_user']);
			} ?>
			<?php if (isset($_SESSION['error_user'])) { ?>
				<div class="alert alert-block alert-danger" style="margin-left:40%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check red"></i> &nbsp; <?php echo $_SESSION['error_user']; ?>
				</div>
			<?php
				unset($_SESSION['error_user']);
			} ?>

			<table class="table table-stripped table-bordered table-hover" style="border: none;">
				<thead>
					<tr>
					</tr>
				</thead>

				<tbody>
					<?php include('models/userDetailsFromDatabase.php'); ?>
					<?php include('views/profileDetailsTable.php'); ?>

				</tbody>
			</table>

			<?php include('models/roleRequestConditions.php'); ?>

			<br><br>

			<?php include('views/additionalRoleRequest.php'); ?>
			<?php
			//include("../include/modalrequestrole.php");
			$Check_R = "select count(*) from rolerequest where usersId = '$usersId' ";
			$stmtR = $con->prepare($Check_R);
			$stmtR->execute();
			$rowsR = $stmtR->fetchColumn();
			if ($rowsR > 0) {
			?>

				<div class="table-header">
					Your Role Requests
				</div>
				<?php include('views/rolerequestLog.php'); ?>
			<?php } ?>
			<?php include('models/educationLevelQuery.php'); ?>
			<?php include('models/uploadSupportiveDocuments.php'); ?>
			<?php include('models/supportiveDocumentsList.php'); ?>
			<?php include('configurations/users/views/modaleditprofile.php'); ?>
			<?php include("configurations/users/views/modaleditmyaddress.php");
			?>
		</div>
	</div>
	<script src="../../js/ace-elements.min.js"></script>
	<script src="../../js/form_validation_en.js"></script>

	<script src="configurations/users/js/submitPharmacist.js"></script>
	<script src="configurations/users/js/submitPhysician.js"></script>
	<script src="configurations/users/js/submitPharmacyOwner.js"></script>
	<!-- <script>
		$(document).ready(function() {
			$('.chosen-select-pharmacist').chosen({
				width: "100%"
			});
			$('.chosen-select-physcian').chosen({
				width: "100%"
			});
		});
	</script> -->

	<script type="text/javascript">
		jQuery(function($) {
			$('#id-input-file-3').ace_file_input({
				style: 'well',
				btn_choose: 'Insert Photo',
				btn_change: null,
				no_icon: 'ace-icon fa fa-cloud-upload',
				droppable: true,
				thumbnail: 'small' //large | fit
			});
			$('#id-input-file-2').ace_file_input({
				style: 'well',
				btn_choose: 'Upload Supportive File',
				btn_change: null,
				no_icon: 'ace-icon fa fa-cloud-upload',
				droppable: true,
				thumbnail: 'small' //large | fit
			});
			$('#id-input-file-4').ace_file_input({
				style: 'well',
				btn_choose: 'Upload Supportive Files',
				btn_change: null,
				no_icon: 'ace-icon fa fa-cloud-upload',
				droppable: true,
				thumbnail: 'small'
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			Dropzone.options.dropzoneFrom2 = {
				acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf",
				init: function() {
					var submitButton2 = document.querySelector('#submit-all2');
					myDropzone = this;
					submitButton2.addEventListener("click", function() {
						myDropzone.processQueue();
					});
					this.on("complete", function() {
						if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
							var _this = this;
							_this.removeAllFiles();
						}
						list_image2();
					});
				},
			};

			list_image2();

			function list_image2() {
				$.ajax({
					url: "configurations/users/models/uploadpharmacist.php",
					success: function(data) {
						$('#preview2').html(data);
					}
				});
			}

			$(document).on('click', '.remove_image2', function() {
				var name = $(this).attr('id');
				$.ajax({
					url: "configurations/users/models/uploadpharmacist.php",
					method: "POST",
					data: {
						name: name
					},
					success: function(data) {
						list_image2();
					}
				})
			});

			Dropzone.options.dropzoneFrom3 = {
				//autoProcessQueue: false,
				acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
				init: function() {
					var submitButton3 = document.querySelector('#submit-all3');
					myDropzone = this;
					submitButton3.addEventListener("click", function() {
						myDropzone.processQueue();
					});
					this.on("complete", function() {
						if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
							var _this = this;
							_this.removeAllFiles();
						}
						list_image3();
					});
				},
			};

			list_image3();

			function list_image3() {
				$.ajax({
					url: "configurations/users/models/uploadpharmacyowner.php",
					success: function(data) {
						$('#preview3').html(data);
					}
				});
			}

			$(document).on('click', '.remove_image3', function() {
				var name = $(this).attr('id');
				$.ajax({
					url: "configurations/users/models/uploadpharmacyowner.php",
					method: "POST",
					data: {
						name: name
					},
					success: function(data) {
						list_image3();
					}
				})
			});


			//==========================================================================

			Dropzone.options.dropzoneFrom = {
				//autoProcessQueue: false,
				acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
				init: function() {
					var submitButton = document.querySelector('#submit-all');
					myDropzone = this;
					submitButton.addEventListener("click", function() {
						myDropzone.processQueue();
					});
					this.on("complete", function() {
						if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
							var _this = this;
							_this.removeAllFiles();
						}
						list_image();
					});
				},
			};

			list_image();

			function list_image() {
				$.ajax({
					url: "configurations/users/models/uploadphysician.php",
					success: function(data) {
						$('#preview').html(data);
					}
				});
			}
			$(document).on('click', '.remove_image', function() {
				var name = $(this).attr('id');
				$.ajax({
					url: "configurations/users/models/uploadphysician.php",
					method: "POST",
					data: {
						name: name
					},
					success: function(data) {
						list_image();
					}
				})
			});

		});
	</script>
	<script src="hub/pharmacy/my-pharmacy/js/addPharmacy.js"></script>
	<script src="hub/pharmacy/my-pharmacy/js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIA2P9qeYtaXVPJHlGU5CF-mJNE8hpCV0&callback=myMap"></script>
	<script type="text/javascript" src="../../js/map.js"></script>

	<?php include('models/editProfile.php');
	?>

<?php
} else {
	header("location: index.php?name=configurations/users/users&var=users");
}
?>