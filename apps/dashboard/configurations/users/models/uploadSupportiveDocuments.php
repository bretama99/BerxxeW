<?php
$Check_RD = "select count(*) from rolerequest where usersId = '$usersId' ";
$stmtRD = $con->prepare($Check_RD);
$stmtRD->execute();
$rowsRD = $stmtRD->fetchColumn();
if ($rowsRD > 0) {
?>

    <h4 class="header smaller lighter green col-xs-12 ">Upload supportive documents to get additional role <br>
        <button class="btn btn-success" data-toggle="modal" data-target="#upload_file">
            <i class="ace-icon fa fa-cloud-upload align-top bigger-125"></i>
            Upload Supportive Documents
        </button><br><br>
    </h4>
<?php } ?>