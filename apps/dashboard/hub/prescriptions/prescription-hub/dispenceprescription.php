<?php  if(isset($_GET['Id']) || isset($_GET['epId'])){ 
    
    if (isset($_GET['Id'])) {
        $prescriptionId = $_GET['Id'];
    } else {
        $prescriptionId = $_GET['epId'];
    }

    if (isset($_SESSION['pharmacyId'])) {
        $pharmacyId = $_SESSION['pharmacyId'];
    }

    if (isset($_SESSION['usrUsersId'])) {
        $dispensedById = $_SESSION['usrUsersId'];
    }

    $query = "SELECT chiefCompliant,diagnosis,prescriptionDate,patientId,firstName, mobilePhone, fatherName,grandFatherName,titleName from prescription join users on prescription.prescriberId=users.usersId join title on users.titleId=title.titleId where prescriptionId='$prescriptionId' AND prescription.status='Prescribed'";

    $stmt = $con->prepare($query);
    $success=$stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        $chiefCompliant = $row['chiefCompliant'];
        $diagnosis = $row['diagnosis'];
        $prescriptionDate = $row['prescriptionDate'];
        $patientId = $row['patientId'];
        $firstName = $row['firstName'];
        $fatherName = $row['fatherName'];
        $grandFatherName = $row['grandFatherName'];
        $titleName = $row['titleName'];
        $prescriberName = $titleName." ".$firstName." ".$fatherName;
        $prescriberPhone = $row['mobilePhone'];
    }
if(isset($patientId)){
?>
<div class="widget-box widget-color-dark">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title smaller">Ordered Medications</h5>
            </div>
            <div class="widget-body"><br>
                <?php
                   
                    
                    $query = "SELECT firstName,fatherName,grandFatherName,titleName from users join title on users.titleId=title.titleId where usersId='$patientId'";
                    $stmt = $con->prepare($query);
                    $success=$stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rows as $row){
                        $firstName1 = $row['firstName'];
                        $fatherName1 = $row['fatherName'];
                        $grandFatherName1 = $row['grandFatherName'];
                        $titleName1 = $row['titleName'];
                    }
                    $patientName = $titleName1." ".$firstName1." ".$fatherName1." ".$grandFatherName1;

                ?>
                <div class="col-xs-12 col-sm-6">
                    <div class="space visible-xs"></div>

                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name" style="width:30%;"> <?php echo $lang['prescriptionId'];?> </div>

                            <div class="profile-info-value">
                                <span><b><?php echo $prescriptionId;?></b></span>
                            </div>

                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name" style="min-width:20%;"> <?php echo $lang['chiefComplaint'];?> </div>

                            <div class="profile-info-value">
                                <span><?php echo $chiefCompliant;?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"><?php echo $lang['diagnosis'];?></div>

                            <div class="profile-info-value">
                                <span><?php echo $diagnosis;?></span>
                            </div>
                        </div>
                    </div><br>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="space visible-xs"></div>

                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name" style="width:20%;"> <?php echo $lang['patientName']; ?> </div>
                            <div class="profile-info-value">
                                <span><?php echo $patientName; ?></span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name" style="width:30%;"> <?php echo $lang['prescriberName']; ?> </div>

                            <div class="profile-info-value">
                                <span><?php echo $prescriberName; ?> (<?php echo $prescriberPhone; ?>)</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"><?php echo $lang['prescriptionDate']; ?></div>

                            <div class="profile-info-value">
                                <span><?php echo $prescriptionDate; ?></span>
                            </div>
                        </div>

                    </div><br>
                </div>              

                <div class="timeline-container">
                    <div class="timeline-label">
                        <span class="label label-success arrowed-in-right label-lg">
                            <b>Orderded Drugs</b>
                        </span>
                    </div>
                
                    <div class="timeline-items">
                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <i class="timeline-indicator ace-icon fa fa-trophy btn btn-pink no-hover green"></i>
                            </div>
                            
                            <div class="widget-box transparent col-sm-10" id="drugInfo">
                            
                            <?php
                                $noOfOrderedDrugs = 0;
                                $query = "SELECT prescribedDrugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsName from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescription.prescriptionId='$prescriptionId' AND prescription.status='Prescribed' AND prescribeddrugs.status='Prescribed' AND prescribeddrugs.isDeleted=0";
                                $stmt = $con->prepare($query);
                                $success = $stmt->execute();
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) {
                                    $prescribedDrugsId = $row['prescribedDrugsId'];
                                    $drugsDose = $row['drugsDose'];
                                    $drugsDoseUnit = $row['drugsDoseUnit'];
                                    $drugsFrequency = $row['drugsFrequency'];
                                    $drugsRoute = $row['drugsRoute'];
                                    $drugsDuration = $row['drugsDuration'];
                                    $drugsDurationUnit = $row['drugsDurationUnit'];
                                    $totalQty = $row['totalQty'];
                                    $qtyUnit = $row['qtyUnit'];
                                    $instructions = $row['drugsInstructions'];
                                    $drugsName = $row['drugsName'];
                                    if (!empty($instructions)) {
                                        $instructions = ", " . $instructions;
                                    }
                                    $var = $prescriptionId . ',' . $prescribedDrugsId;
                                ?>
                                            

                                    <?php if ($_SESSION['rolesId'] == 2) { ?>
                                        <div class="widget-header widget-header-small" style="height:10px;padding:3px !important; font-size:12px;" id="<?php echo 'h' . $prescribedDrugsId; ?>">
                                            <h6 class="widget-title smaller"><b> <?php echo $drugsName; ?></b></h6>
                                            <div class="widget-toolbar">
                                                <button rel="tooltip" data-toggle="modal" data-target="#dispenseDrug<?php echo $prescribedDrugsId; ?>" class="btn btn-xs btn-purple bigger">
                                                    <i class="ace-icon fa fa-external-link"></i>
                                                    Dispense Drug
                                                </button>
                                            </div>
                                        </div>
                                    <?php }  ?>



                                            
                                    <div class="widget-body" id="<?php echo 'b' . $prescribedDrugsId; ?>">
                                        <div class="widget-main" style="padding:3px !important;">
                                            <?php echo $drugsDose . " " . $drugsDoseUnit . ", " . $drugsFrequency . $instructions . ", " . $drugsRoute . ", " . $drugsDuration . " " . $drugsDurationUnit . " - ( Total of " . $totalQty . " " . $qtyUnit . ")"; ?>
                                        </div>
                                    </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="dispenseDrug<?php echo $prescribedDrugsId; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header"><br>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">
                                                            <div class="alert alert-warning">Are you sure you want to Dispense <b><?php echo $drugsName;?></b>?</div>
                                                        </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form"><br>
                                                                <div class="form-group" style="margin-top:-25px;">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tracking number <span style="color:red;">*</span></label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" id="tn<?php echo $prescribedDrugsId;?>" placeholder="">
                                                                    </div>
                                                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Picked By </label>
                                                                    <div class="col-sm-3">
                                                                        <input type="text" class="form-control" id="pickedBy<?php echo $prescribedDrugsId;?>" placeholder="Picked by">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" onclick="dispenseDrug('<?php echo $prescriptionId;?>','<?php echo $prescribedDrugsId;?>')" style="float:left;">&nbsp;YES</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php $noOfOrderedDrugs ++;}?>
                                </div>
                                <input type="hidden" id="noOfOrderedDrugs" value="<?php echo $noOfOrderedDrugs;?>">

                            <?php if ($_SESSION['rolesId'] == 2) { ?>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-sm-offset-4"><br>
                                            <button rel="tooltip" data-toggle="modal" data-target="#dispenseAllDrugs" class="btn btn-purple btn-md pull-left">
                                                <i class="ace-icon fa fa-external-link"></i>
                                                <?php echo $lang['dispenseAll']; ?>
                                            </button>


                                            <button rel="tooltip" data-toggle="modal" data-target="#returnAllDrugs" class="btn btn-danger btn-md pull-right">
                                                <i class="ace-icon fa fa-external-link"></i>
                                                Return
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            <?php }  ?>


                                <!-- Modal -->
                                <div class="modal fade" id="dispenseAllDrugs" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header"><br>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <div class="alert alert-warning">Are you sure you want to Dispense <b>All the Drugs?</b></div>
                                            </h4>
                                            </div>
                                            <div class="modal-body" style="margin-top:-15px;">
                                            <table id="" class="table table-stripped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Drug name</th>
                                                        <th>Tracking number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $i = 1;
                                                    $prescribedDrugIds = array();
                                                    $query = "SELECT drugsName,prescribedDrugsId from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescription.prescriptionId='$prescriptionId' AND prescription.status='Prescribed' AND prescribeddrugs.status='Prescribed' AND prescribeddrugs.isDeleted=0";
                                                    $stmt = $con->prepare($query);
                                                    $success=$stmt->execute();
                                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach($rows as $row){
                                                        $drugsName = $row['drugsName'];
                                                        $prescribedDrugsId = $row['prescribedDrugsId'];
                                                       // echo $drugsName;
                                                        ?>
                                                        <tr id="modal<?php echo $prescribedDrugsId;?>">
                                                            <td><?php echo $i;?></td>
                                                            <td><?php echo $drugsName;?></td>
                                                            <td>
                                                                <input type="text" name="trackingNumber" id="<?php echo $prescribedDrugsId;?>">
                                                            </td>
                                                        </tr>
                                                    <?php 
                                                        array_push($prescribedDrugIds, $prescribedDrugsId);
                                                         $i++; }
                                                         $jsonIds = json_encode($prescribedDrugIds);
                                                         ?>
                                                </tbody>
                                            </table>
                                                <form class="form-horizontal" role="form"><br>
                                                    <div class="form-group" style="margin-top:-20px;">
                                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Picked By </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="pickedBy" placeholder="If the person arrived is not the Patient, enter his/her Name">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" onclick="dispenseDrug('<?php echo $prescriptionId;?>','0')" style="float:left;">&nbsp;YES</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                               

    <!-- Modal mmmmmmmmmmmmmmmmmmmmmmmm-->
                                <div class="modal fade" id="returnAllDrugs" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header"><br>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <div class="alert alert-warning">Are you sure you want to Return <b>?</b></div>
                                            </h4>
                                            </div>
                                            <div class="modal-body" style="margin-top:-15px;">
                                            <table id="" class="table table-stripped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Drug name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $i = 1;
                                                    $prescribedDrugIds = array();
                                                    $query = "SELECT drugsName,prescribedDrugsId from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescription.prescriptionId='$prescriptionId' AND prescription.status='Prescribed' AND prescribeddrugs.status='Prescribed' AND prescribeddrugs.isDeleted=0";
                                                    $stmt = $con->prepare($query);
                                                    $success=$stmt->execute();
                                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach($rows as $row){
                                                        $drugsName = $row['drugsName'];
                                                        $prescribedDrugsId = $row['prescribedDrugsId'];
                                                       // echo $drugsName;
                                                        ?>
                                                        <tr id="modal<?php echo $prescribedDrugsId;?>">
                                                            <td><?php echo $i;?></td>
                                                            <td><?php echo $drugsName;?></td>
                                                        
                                                        </tr>
                                                    <?php 
                                                        array_push($prescribedDrugIds, $prescribedDrugsId);
                                                         $i++; }
                                                         $jsonIds = json_encode($prescribedDrugIds);
                                                         ?>
                                                </tbody>
                                            </table>
                                                <form class="form-horizontal" role="form"><br>
                                                    <div class="form-group" style="margin-top:-20px;">
                                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Comment </label>
                                                        <div class="col-sm-9">
                                                             <textarea style="margin-top:-7px; width:100%;" name="comment" id="comment" rows="3" cols="65" required></textarea>
                                                            <!-- <input type="text" class="form-control" id="comment" placeholder="Comment"> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" onclick="returnDrug('<?php echo $prescriptionId;?>','0')" style="float:left;">&nbsp;YES</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                    </div>
                </div>

            </div>
    </div>

    

<script>
var noOfOrderedDrugs = document.getElementById("noOfOrderedDrugs").value;
var prescribedDrugIds = JSON.parse('<?= $jsonIds; ?>');

function dispenseDrug(prescriptionId,prescribedDrugsId){
    if(prescribedDrugsId == 0){
        var pickedBy = document.getElementById("pickedBy").value;
        var trackingNumbers = []; // Array is empty
        var arrayLength = prescribedDrugIds.length;
        for (var i = 0; i < arrayLength; i++) { 
            var Id = prescribedDrugIds[i];
            var tNumber = document.getElementById(Id).value;
            trackingNumbers.push({prescribedDrugId: Id, trackingNumber: tNumber});
        }
        
    }else{
        var tNumber = 'tn'+prescribedDrugsId;
        var trackingNumbers = document.getElementById(tNumber).value;
        var pBy = 'pickedBy'+prescribedDrugsId;
        var pickedBy = document.getElementById(pBy).value;
    }


    $.ajax({
        type : "POST",
        url : 'hub/prescriptions/prescription-hub/models/dispensedrug.php',
        dataType : 'json',
        data:{prescriptionId: prescriptionId,prescribedDrugsId: prescribedDrugsId,noOfOrderedDrugs: noOfOrderedDrugs,pickedBy: pickedBy,trackingNumbers: trackingNumbers},
        success : function(info){
            //var fullName = info.title + " " + info.firstName + " " + info.fatherName + " " + info.grandFatherName;
            var prescribedDrugsId=info.prescribedDrugsId;
            noOfOrderedDrugs=info.noOfOrderedDrugs;
            if(prescribedDrugsId != 0){
                var drugHeader= 'h'+prescribedDrugsId;
                var drugBody= 'b'+prescribedDrugsId;
                var drugModal= 'modal'+prescribedDrugsId;
                //var modalId = ''
                $('#dispenseDrug'+prescribedDrugsId).modal('hide');
                document.getElementById(drugHeader).remove();
                document.getElementById(drugBody).remove();
                document.getElementById(drugModal).remove();

                //remove the drugId from the total drugIds array
                for( var i = 0; i < prescribedDrugIds.length; i++){ 
                    if ( prescribedDrugIds[i] === prescribedDrugsId) {
                        prescribedDrugIds.splice(i, 1); 
                    }
                }
            }

            if(prescribedDrugsId == 0 || noOfOrderedDrugs == 0){
                //alert("All Drugs Disspensed");
                $('#dispenseAllDrugs').modal('hide');
                window.location.href = "?name=hub/prescriptions/prescription-hub/prescriptionhub&var=prescriptionHub";
            }
        }
    });
  }





  function returnDrug(prescriptionId,prescribedDrugsId){
        var comment = document.getElementById("comment").value;

    $.ajax({
        type : "POST",
        url : 'hub/prescriptions/prescription-hub/models/returndrug.php',
        dataType : 'json',
        data:{prescriptionId: prescriptionId,prescribedDrugsId: prescribedDrugsId,noOfOrderedDrugs: noOfOrderedDrugs,comment: comment},
        success : function(info){
            //var fullName = info.title + " " + info.firstName + " " + info.fatherName + " " + info.grandFatherName;
            var prescribedDrugsId=info.prescribedDrugsId;
            noOfOrderedDrugs=info.noOfOrderedDrugs;
            if(prescribedDrugsId != 0){
                var drugHeader= 'h'+prescribedDrugsId;
                var drugBody= 'b'+prescribedDrugsId;
                var drugModal= 'modal'+prescribedDrugsId;
                //var modalId = ''
                $('#dispenseDrug'+prescribedDrugsId).modal('hide');
                document.getElementById(drugHeader).remove();
                document.getElementById(drugBody).remove();
                document.getElementById(drugModal).remove();

                //remove the drugId from the total drugIds array
                for( var i = 0; i < prescribedDrugIds.length; i++){ 
                    if ( prescribedDrugIds[i] === prescribedDrugsId) {
                        prescribedDrugIds.splice(i, 1); 
                    }
                }
            }

            if(prescribedDrugsId == 0 || noOfOrderedDrugs == 0){
                //alert("All Drugs Disspensed");
                $('#returnAllDrugs').modal('hide');
                window.location.href = "?name=hub/prescriptions/prescription-hub/prescriptionhub&var=prescriptionHub";
            }
        }
    });
  }
</script>
<?php 
 }else{
    header("location: ?name=hub/prescriptions/prescription-hub/prescriptionhub&var=prescriptionHub&search=$prescriptionId");
 }
}else{

}
  ?>
