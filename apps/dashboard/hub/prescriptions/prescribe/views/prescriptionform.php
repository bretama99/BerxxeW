
<?php $drugsDoseUnit="mmmmmmmmmmmmmmmmmmmmmmmmmmmmm";?>
<div class="row">
    <div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-7">
        <input type="hidden" id="patientUsersId" value="0">
        <div class="widget-box widget-color-dark">
            <div class="widget-header widget-header-small">
                <h6 class="widget-title smaller">Prescribe Medications</h6>
            </div>
            <div class="widget-body">

                <div class="row" id="medicationDetail">
                    <div class="widget-main">
                        <div class="widget-box col-sm-5" id="widget-box-6">
                            <div class="widget-header widget-header-small">
                                <h5 class="widget-title smaller">Medications</h5>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main padding-6">
                                    <form class="form-horizontal" role="form" id="addDrug">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Drug name <span style="color:red;">*</span></label>
                                            <div class="col-sm-9">
                                                <input list="drugNames" id="drugName" class="form-control"
                                                    onkeyup="displayDrugs()" autocomplete="off">
                                                <datalist id="drugNames" onclick="func()">
                                                </datalist>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Drug name <span style="color:red;">*</span></label>
                                    <div class="col-sm-9">
                                        <select id="drugId" class="chzn-select form-control" onchange="gitterDisplay(this.options[this.selectedIndex].value)" data-placeholder="Choose Drug" required>
                                            <option value=""></option>
                                            <?php
                                            $Po_query = "select drugsId,drugsName from drugs";
                                            $Po_stmt = $con->prepare($Po_query);
                                            $Po_success = $Po_stmt->execute();
                                            $Po_rows = $Po_stmt->fetchAll();
                                            foreach ($Po_rows as $row) {
                                                $drugsId = $row['drugsId'];
                                                $drugsName = $row['drugsName'];
                                                ?>
                                            <option value="<?php echo $drugsId; ?>"><?php echo $drugsName; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> -->

                                        <input id="gritter-light" checked="checked" type="checkbox"
                                            class="ace ace-switch ace-switch-5" />
                                        <input type="hidden" id="gritterPopup" value="">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Dose <span style="color:red;">*</span></label>
                                            <div class="col-sm-3">
                                                <input name="somename" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"type = "number" maxlength = "4" id="dose" class="form-control" min="0" onkeyup="calculateQty()" onchange="calculateQty()"/>

                                               <!-- <input type="number" id="dose" class="form-control" min="0"
                                                maxlength="1"
                                                    onkeyup="calculateQty()" onchange="calculateQty()" />-->
                                            </div>
                                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                                Units <span style="color:red;">*</span></label>
                                            <div class="col-sm-4">
                                                <select id="doseUnit" class="chzn-select form-control"
                                                    data-placeholder="Choose Unit"
                                                    onchange="setQtyUnit(this.options[this.selectedIndex].value)"
                                                    required>
                                                    <option value=""></option>
                                                    <option value="Capsule">Capsule</option>
                                                    <option value="Tablet">Tablet</option>
                                                    <option value="ml">ml</option>
                                                    <option value="mg">mg</option>
                                                    <option value="IU">IU</option>
                                                    <option value="Drop">Drop</option>
                                                    <option value="Tablespoon">Tablespoon</option>
                                                    <option value="Teaspoon">Teaspoon</option>
                                                    <option value="Unit(s)">Unit(s)</option>
                                                    <option value="Puff(s)">Puff(s)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Frequency <span style="color:red;">*</span></label>
                                            <div class="col-sm-9">
                                                <select id="frequency" class="chzn-select form-control"
                                                    data-placeholder="Choose Frequency"
                                                    onchange="setDurationUnit(this.options[this.selectedIndex].value)"
                                                    required>
                                                    <option value=""></option>
                                                    <option value="Immediately">Immediately</option>
                                                    <option value="Once a day">Once a day</option>
                                                    <option value="Twice a day">Twice a day</option>
                                                    <option value="Thrice a day">Thrice a day</option>
                                                    <option value="Four times a day">Four times a day</option>
                                                    <option value="Every 2 hours">Every 2 hours</option>
                                                    <option value="Every 3 hours">Every 3 hours</option>
                                                    <option value="Every 4 hours">Every 4 hours</option>
                                                    <option value="Every 6 hours">Every 6 hours</option>
                                                    <option value="Every 8 hours">Every 8 hours</option>
                                                    <option value="Every 12 hours">Every 12 hours</option>
                                                    <option value="On alternative days">On alternative days</option>
                                                    <option value="Once a week">Once a week</option>
                                                    <option value="Twice a week">Twice a week</option>
                                                    <option value="Thrice a week">Thrice a week</option>
                                                    <option value="Every 2 weeks">Every 2 weeks</option>
                                                    <option value="Every 3 weeks">Every 3 weeks</option>
                                                    <option value="Once a month">Once a month</option>
                                                    <option value="Five times a day">Five times a day</option>
                                                    <option value="Four days a week">Four days a week</option>
                                                    <option value="Five days a week">Five days a week</option>
                                                    <option value="Six days a week">Six days a week</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Route <span style="color:red;">*</span> </label>
                                            <div class="col-sm-9">
                                                <select id="route" class="chzn-select form-control"
                                                    data-placeholder="Choose Route" required>
                                                    <option value=""></option>
                                                    <option value="Intramuscular">Intramuscular</option>
                                                    <option value="Nasal">Nasal</option>
                                                    <option value="Topical">Topical</option>
                                                    <option value="Intraosseous">Intraosseous</option>
                                                    <option value="Intrathecal">Intrathecal</option>
                                                    <option value="Intraperitoneal">Intraperitoneal</option>
                                                    <option value="Intradermal">Intradermal</option>
                                                    <option value="Nasogastic">Nasogastic</option>
                                                    <option value="Sub Lingual">Sub Lingual</option>
                                                    <option value="Per Rectum">Per Rectum</option>
                                                    <option value="Sub Cutaneous">Sub Cutaneous</option>
                                                    <option value="Per Vaginal">Per Vaginal</option>
                                                    <option value="Oral">Oral</option>
                                                    <option value="Inhalation">Inhalation</option>
                                                    <option value="Inhalation">Inhalation</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Duration <span style="color:red;">*</span> </label>
                                            <div class="col-sm-3">
                                               <!-- <input type="number" id="duration" class="form-control" min="1" 
                                                    onkeyup="calculateQty()" onchange="calculateQty()" />-->
                                                    <input name="somename" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "4" id="duration" class="form-control" min="1" 
                                                    onkeyup="calculateQty()" onchange="calculateQty()"/>
                                            </div>
                                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                                Units <span style="color:red;">*</span> </label>
                                            <div class="col-sm-4">
                                                <select id="durationUnit" class="chzn-select form-control"
                                                    data-placeholder="Choose Unit" onchange="calculateQty()" required>
                                                    <option value=""></option>
                                                    <option value="Day(s)" id='days'>Day(s)</option>
                                                    <option value="Week(s)" id='weeks'>Week(s)</option>
                                                    <option value="Month(s)" id='months'>Month(s)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Total Quantity <span style="color:red;">*</span> </label>
                                            <div class="col-sm-3">
                                                <input type="number" id="totalQty" class="form-control" min="0.1" />
                                            </div>
                                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                                Units <span style="color:red;">*</span> </label>
                                            <div class="col-sm-4">
                                                <select id="qtyUnit" class="chzn-select form-control"
                                                    data-placeholder="Choose Unit" required>
                                                    <option value=""></option>
                                                    <option value="Capsule">Capsule</option>
                                                    <option value="Tablet">Tablet</option>
                                                    <option value="ml">ml</option>
                                                    <option value="mg">mg</option>
                                                    <option value="IU">IU</option>
                                                    <option value="Drop">Drop</option>
                                                    <option value="Tablespoon">Tablespoon</option>
                                                    <option value="Teaspoon">Teaspoon</option>
                                                    <option value="Unit(s)">Unit(s)</option>
                                                    <option value="Puff(s)">Puff(s)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--  <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cheif Complaint </label>
                                    <div class="col-sm-9">
                                    <textarea class="form-control" id="form-field-8" placeholder="Default Text"></textarea>
                                    </div>
                                </div> -->
                                        <div class="page-header"
                                            style="height:30px; font-size:15px; margin-top:-10px; color:#94d3f5;">
                                            Additional Information
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Instructions </label>
                                            <div class="col-sm-9">
                                                <select id="instructions" class="chzn-select form-control"
                                                    data-placeholder="Choose Instruction" required>
                                                    <option value=""></option>
                                                    <option value="Before Meals">Before Meals</option>
                                                    <option value="Empty stomach">Empty stomach</option>
                                                    <option value="After meals">After meals</option>
                                                    <option value="In the morning">In the morning</option>
                                                    <option value="In the evening">In the evening</option>
                                                    <option value="At bedtime">At bedtime</option>
                                                    <option value="Immediately">Immediately</option>
                                                    <option value="As directed">As directed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                                Additional Instructions </label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="additionalInstructions"
                                                    placeholder="Additional Instructions"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" id="checkDrugDuplication" value="0">
                                     
                                        <div class="center">
                                            <span class="btn btn-white btn-info btn-bold" onclick="addDrugs()">
                                                <i class="ace-icon fa fa-plus bigger-100 blue"></i>
                                                Add to list
                                            </span>
                                        </div>
                                       <!--      <div class="center">
                                            <span class="btn btn-white btn-info btn-bold" onclick="addDrugs()">
                                                <i class="ace-icon fa fa-plus bigger-100 blue"></i>
                                                Update
                                            </span>
                                        </div> -->

                                        <?php
                                          
                                        if (isset($_GET['Id'])) {
                                            $patientId = $_GET['Id'];
                                            $prescriberId = $usrUsersId;
                                            $query = "SELECT prescriptionId from prescription where patientId='$patientId' AND prescriberId='$prescriberId' AND prescription.status='Pending' ORDER BY prescriptionId DESC LIMIT 1";
                                            $stmt = $con->prepare($query);
                                            $success = $stmt->execute();
                                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($rows as $row) {
                                                $prePrescriptionId = $row['prescriptionId'];
                                            }
                                        }
                                        ?>
                                        <input type="hidden" id="prescriberUsersId" value="<?php echo $usrUsersId; ?>">
                                        <input type="hidden" id="prescriptionId"
                                            value="<?php if (isset($prePrescriptionId)) {
                                                echo $prePrescriptionId;
                                            } else {
                                                echo '0';
                                            } ?>">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="widget-box col-sm-7" id="widget-box-6">
                            <div class="widget-header widget-header-small">
                                <h5 class="widget-title smaller">Ordered Medications</h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-6">
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
                                                <div class="widget-box transparent" id="drugInfo">
                                                    <?php
                                                    $drugIds = array();
                                                    if (isset($_GET['Id'])) {
                                                        $patientId = $_GET['Id'];
                                                        $prescriberId = $usrUsersId;
                                                        if(isset($_GET['prescriptionId']))
                                                        $prescriptionId11 = $_GET['prescriptionId']; 
                                                        $query="";
                                                        if(isset($_GET['status'])&&$_GET['status']=='Returned'){
                                                        $query = "SELECT prescribedDrugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsName,drugs.drugsId,drugsAdditionalInstructions from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescription.patientId='$patientId' AND prescription.prescriberId='$prescriberId' AND prescription.status='Returned' AND prescribeddrugs.isDeleted=0 AND $prescriptionId11 = prescription.prescriptionId";
                                                    }
                                                    else if(isset($_GET['status'])&&$_GET['status']=='Pending'){
                                                        $query = "SELECT prescribedDrugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsName,drugs.drugsId,drugsAdditionalInstructions from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescription.patientId='$patientId' AND prescription.prescriberId='$prescriberId' AND prescription.status='Pending' AND prescribeddrugs.isDeleted=0 AND $prescriptionId11 = prescription.prescriptionId";
                                                    }
                                                    else{
                                                                $query = "SELECT prescribedDrugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsName,drugs.drugsId, drugsAdditionalInstructions from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescription.patientId='$patientId' AND prescription.prescriberId='$prescriberId' AND prescription.status='Pending' AND prescribeddrugs.isDeleted=0";
                                                    }
                                                        $stmt = $con->prepare($query);
                                                        $success = $stmt->execute();
                                                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($rows as $row) {
                                                            $drugsId = $row['drugsId'];
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
                                                            $additionalInstructions = $row['drugsAdditionalInstructions'];
                                                            if (!empty($instructions)) {
                                                                $instructions = ", " . $instructions;
                                                            }
                                                            array_push($drugIds, $drugsId);
                                                            ?>
                                                            <div id="<?php echo $prescribedDrugsId; ?>">
                                                                <div class="widget-header widget-header-small"
                                                                    style="height:10px;padding:3px !important;">
                                                                    <h6 class="widget-title smaller"><b>
                                                                            <?php echo $drugsName; ?>
                                                                        </b></h6>
                                                                    <div class="widget-toolbar">

                                                                        <div class="widget-menu">
                                                                            <a href="#" data-action="settings"><i
                                                                                    class="ace-icon fa fa-edit"
                                                                                    style="color:#d15b47;"
                                                                                    onclick="updatePrescription('<?php echo $prescribedDrugsId; ?>','<?php echo $drugsId; ?>', '<?php echo $drugsDose; ?>',
                                                                                    '<?php echo $drugsDoseUnit; ?>', '<?php echo $drugsFrequency; ?>','<?php echo $instructions; ?>','<?php echo $drugsRoute; ?>','<?php echo $drugsDuration; ?>','<?php echo $drugsDurationUnit; ?>','<?php echo $totalQty; ?>','<?php echo $qtyUnit; ?>','<?php echo $drugsName; ?>','<?php echo $additionalInstructions; ?>' )"></i></a>
                                                                        </div>
                                                                        <div class="widget-menu">
                                                                            <a href="#" data-action="settings"><i
                                                                                    class="ace-icon fa fa-times"
                                                                                    style="color:#d15b47;"
                                                                                    onclick="deleteDrug('<?php echo $prescribedDrugsId; ?>','<?php echo $drugsId; ?>')"></i></a>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                </div>
                                                                <div class="widget-body">
                                                                    <div  class="widget-main" style="padding:3px !important;">
                                                                        <?php echo $drugsDose . " " . $drugsDoseUnit . ", " . $drugsFrequency . $instructions . ", " . $drugsRoute . ", " . $drugsDuration . " " . $drugsDurationUnit . " - ( Total of " . $totalQty . " " . $qtyUnit . ")"; ?>
                                                                        <!-- drug.drugsDose     drug.drugsDoseUnit  ,   drug.drugsFrequency  ,   drug.drugsRoute  ,   drug.drugsDuration     drug.drugsDurationUnit   - ( Total of   drug.totalQty     drug.drugsDoseUnit  ) -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                    }
                                                    $jsonDrugIds = json_encode($drugIds);
                                                    ?>
                                                </div>
                                            </div>
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group"><br>
                                                    <label class="col-sm-3 control-label no-padding-right"
                                                        for="form-field-1"> Chief Compliant </label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" id="chiefCompliant"
                                                            placeholder="Chief Compliant"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right"
                                                        for="form-field-1"> Diagnosis </label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" id="diagnosisDetail"
                                                            placeholder="Diagnosis Details"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right"
                                                        for="form-field-1"> Send to</label>
                                                    <div class="col-sm-9">
                                                        <select id="pharmacyId" class=" form-control">
                                                            <option value="0">To the Hub</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="orderPrescriptionId" id="orderPrescriptionId"
                                                    value="<?php if (isset($prePrescriptionId)) {
                                                        echo $prePrescriptionId;
                                                    } ?>">
                                            </form>
                                            <div class="form-group">
                                                <div class="col-sm-3 col-sm-offset-4">
<div id="output"></div>
                                                    <button onclick="orderPrescription()" id="orderPrescription"
                                                        class="btn btn-purple btn-md">
                                                        <span
                                                            class="ace-icon fa fa-external-link icon-on-right bigger-120"></span>
                                                        <?php echo $lang['orderMedications']; ?>
                                                    </button>
                                                </div>
                                            </div>

                                        </div><!-- /.timeline-items -->
                                    </div><!-- /.timeline-container -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="orderSuccess">
                    <div class="col-xs-6 col-sm-6 col-sm-offset-2 pricing-box">
                        <div class="widget-box widget-color-green">
                            <div class="widget-header">
                                <h5 class="widget-title bigger lighter">Medications Ordered</h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="space visible-xs"></div>

                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">
                                                    <?php echo $lang['prescriptionId']; ?>
                                                </div>
                                                <div class="profile-info-value">
                                                    <b><span id="pPrescriptionId"> </span></b>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name">
                                                    <?php echo $lang['fullName']; ?>
                                                </div>

                                                <div class="profile-info-value">
                                                    <span id="pFullName"></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name">
                                                    <?php echo $lang['mobilePhone']; ?>
                                                </div>

                                                <div class="profile-info-value">
                                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                                    <span id="pMobilePhone"> </span>
                                                    <span id="pCustodianPhone"> </span>
                                                </div>
                                            </div>


                                        </div><br>
                                    </div>

                                </div>

                                <div>
                                    <a href="#" class="btn btn-block btn-inverse">
                                        <i class="ace-icon fa fa-shopping-cart bigger-110"></i>
                                        <span>Pick your Medications from any Pharmacy </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- <script type="text/javascript">
    $("#medicationDetail").remove();
</script>  -->

<script type="application/javascript">
     var isEdit=false;
     var prescribedDrugsId=0;
     var drugId = 0;
        document.getElementById('output').innerHTML = isEdit;

    // hide success message at intial
    document.getElementById("orderSuccess").style.display = "none";
    document.getElementById("orderPrescription").disabled = true;
                    
    var buttonClickCounter = 0;
    var prePrescriptionId = document.getElementById("prescriptionId").value;

    var prescribedDrugIds = JSON.parse('<?= $jsonDrugIds; ?>');
    //alert(drugIds);

    if (prePrescriptionId > 0) {
        document.getElementById("orderPrescription").disabled = false;
    }
function updatePrescription(prescribedDrugsId, drugsId, drugsDose,drugsDoseUnit, drugsFrequency,instructions, drugsRoute, drugsDuration, drugsDurationUnit,totalQty,qtyUnit,drugName,additionalInstructions){
this.prescribedDrugsId=prescribedDrugsId;
this.drugId=drugsId;
        $('#qtyUnit').val(qtyUnit).trigger('chosen:updated');
        $('#instructions').val(instructions.substring(2)).trigger('chosen:updated');
        $('#durationUnit').val(drugsDurationUnit).trigger('chosen:updated');
        $('#doseUnit').val(drugsDoseUnit).trigger('chosen:updated');
        $('#route').val(drugsRoute).trigger('chosen:updated');
        $('#frequency').val(drugsFrequency).trigger('chosen:updated');

            // document.getElementById('instructions').value =instructions.substring(1);
            document.getElementById('dose').value =drugsDose;
            document.getElementById('totalQty').value =totalQty;
            document.getElementById('qtyUnit').value =qtyUnit;
            document.getElementById('durationUnit').value =drugsDurationUnit;
            document.getElementById('duration').value =drugsDuration;
            document.getElementById('route').value =drugsRoute;
            document.getElementById('frequency').value =drugsFrequency;
            document.getElementById('doseUnit').value =drugsDoseUnit;
            document.getElementById('drugName').value=drugName;
            document.getElementById("additionalInstructions").value=additionalInstructions;
            // document.getElementById("instructionOption").value=instructions.substring(1);

                // instructions,qtyUnit,totalQty,durationUnit,duration,route,frequency,doseUnit,dose,drugNames



}
    function displayDrugs() {

        var drugName = document.getElementById("drugName").value;
        //alert(drugName)
        // var drugName = document.getElementById("drugName").value;
        //var value2send = document.querySelector("#drugNames option[value='"+drugName+"']").dataset.value;
        // alert(value2send)
        //alert(0)
        if (drugName.length > 0) {
            $.ajax({
                type: "POST",
                url: 'hub/prescriptions/prescribe/models/displaydrugs.php',
                dataType: 'json',
                data: { drugName: drugName },
                success: function (successData) {
                    //alert(0)
                    //document.getElementById("orderPrescriptionId").value = drug.prescriptionId;
                    // prePrescriptionId = drug.prescriptionId;
                    // alert(successData.drugsName);
                    document.getElementById('drugNames').innerHTML = '';
                    $.each(successData, function (key, value) {
                        $("#drugNames").append("<option data-value='" + value.drugsId + "' value='" + value.drugsName + "'>");
                    });
                }

            });
        }
    }

    function addDrugs() {

        //alert(buttonClickCounter);
        var title = ""; var firstName = ""; var fatherName = ""; var grandFatherName = ""; var mobilePhone = "";
        var dateOfBirth = ""; var gender = ""; var custodianPhone= ";"

        /* var countryId = ""; var stateId = "";
        var zoneId = "";  var woredaId = ""; var kebelle = ""; */

        var patientUsersId = document.getElementById("patientUsersId").value;
        //var prescriptionId = document.getElementById("prescriptionId").value;
        var fillPatientDetails = 0;

        if (patientUsersId == 0) {
            //alert(title)
            var title = document.getElementById("title").value;
            var firstName = document.getElementById("firstName").value;
            var fatherName = document.getElementById("fatherName").value;
            var grandFatherName = document.getElementById("grandFatherName").value;
            var mobilePhone = document.getElementById("mobilePhone").value;
            var custodianPhone = document.getElementById("custodianPhone").value;
            var dateOfBirth = document.getElementById("dateOfBirth").value;
            var gender = document.getElementById("gender").value;
            /*  
             var countryId = document.getElementById("country").value;
             var stateId = document.getElementById("state").value;
             var zoneId = document.getElementById("zone").value;
             var woredaId = document.getElementById("woreda").value;
             var kebelle = document.getElementById("kebelle").value;
             */
            if (title != "" && firstName != "" && fatherName != "" && grandFatherName != "" && (mobilePhone != "" || custodianPhone !="")) {
                fillPatientDetails = 1;
            }

        }

        var prescriberUsersId = document.getElementById("prescriberUsersId").value;

        var drugName = document.getElementById("drugName").value;
    
        var drugId =0;
        if(this.drugId!=0)
         drugId=this.drugId;
        else
            drugId=document.querySelector("#drugNames option[value='" + drugName + "']").dataset.value;
                            

        //var drugId = document.getElementById("drugId").value;

        var dose = document.getElementById("dose").value;
        var doseUnit = document.getElementById("doseUnit").value;
        var frequency = document.getElementById("frequency").value;

        var route = document.getElementById("route").value;
        var duration = document.getElementById("duration").value;
        var durationUnit = document.getElementById("durationUnit").value;
        var totalQty = document.getElementById("totalQty").value;
        var qtyUnit = document.getElementById("qtyUnit").value;

        var instructions = document.getElementById("instructions").value;
        var additionalInstructions = document.getElementById("additionalInstructions").value;

        var notEmpty = 0;
        if (drugName != "" && dose != "" && doseUnit != "" && frequency != "" && route != "" && duration != "") {
            notEmpty = 1;
        }

        if (patientUsersId != 0 || fillPatientDetails != 0) {
            if (notEmpty == 1) {
                $.ajax({
                    type: "POST",
                    url: 'hub/prescriptions/prescribe/models/prescribedrug.php',
                    dataType: 'json',
                    data: {
                        buttonClickCounter: buttonClickCounter, prescriberUsersId: prescriberUsersId, patientUsersId: patientUsersId, prescriptionId: prePrescriptionId, drugId: drugId, dose: dose, doseUnit: doseUnit, frequency: frequency, route: route, duration: duration, durationUnit: durationUnit, totalQty: totalQty, qtyUnit: qtyUnit, instructions: instructions, additionalInstructions: additionalInstructions,
                        title: title, firstName: firstName, fatherName: fatherName, grandFatherName: grandFatherName, mobilePhone: mobilePhone, custodianPhone: custodianPhone, dateOfBirth: dateOfBirth, gender: gender,prescribedDrugsId:prescribedDrugsId/*, countryId: countryId, stateId: stateId, zoneId: zoneId, woredaId: woredaId, kebelle: kebelle */
                    },
                    success: function (drug) {
this.prescribedDrugsId=0;
this.drugId=0;
                        document.getElementById("orderPrescriptionId").value = drug.prescriptionId;
                        prePrescriptionId = drug.prescriptionId;
                        // alert(successData.drugsName);
                        $("#drugInfo").append(
                            "<div id='" + drug.prescribedDrugsId + "'>" +
                            "<div class='widget-header widget-header-small' style='height:10px;padding:3px !important;'>" +
                            "<h6 class='widget-title smaller'><b>" + drug.drugsName + "</b></h6>" +
                            "<div class='widget-toolbar'><div class='widget-menu'><a href='#' data-action='settings'><i class='ace-icon fa fa-edit' style='color:#d15b47;' onclick='updatePrescription(" + drug.prescribedDrugsId + ")'></i></a></div><div class='widget-menu'><a href='#' data-action='settings'><i class='ace-icon fa fa-times' style='color:#d15b47;' onclick='deleteDrug(" + drug.prescribedDrugsId + ")'></i></a></div></div></div>" +
                            "<div class='widget-body'>" +
                            "<div class='widget-main' style='padding:3px !important;'>" +
                            drug.drugsDose + " " + drug.drugsDoseUnit + ", " + drug.drugsFrequency + ", " + drug.instructions + ", " + drug.drugsRoute + ", " + drug.drugsDuration + " " + drug.drugsDurationUnit + " - ( Total of " + drug.totalQty + " " + drug.qtyUnit + ")" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        );
                    }

                });

                buttonClickCounter = buttonClickCounter + 1;
                document.getElementById("orderPrescription").disabled = false;

                $('#drugId').val('').trigger('chosen:updated');
                $('#doseUnit').val('').trigger('chosen:updated');
                $('#frequency').val('').trigger('chosen:updated');
                $('#route').val('').trigger('chosen:updated');
                $('#durationUnit').val('').trigger('chosen:updated');
                $('#qtyUnit').val('').trigger('chosen:updated');
                $('#instructions').val('').trigger('chosen:updated');
                document.getElementById("addDrug").reset();
            } else {
                alert("Please Fill the require drug informations !");
            }

        } else {
            alert("First Fill Patient Information !");
        }

        if (buttonClickCounter > 0) {
            $('#userInfo :input').attr('disabled', 'disabled');
        }

    }

    function orderPrescription() {
        var orderPrescriptionId = document.getElementById("orderPrescriptionId").value;
        var chiefCompliant = document.getElementById("chiefCompliant").value;
        var diagnosisDetail = document.getElementById("diagnosisDetail").value;
        var pharmacyId = document.getElementById("pharmacyId").value;
        if (orderPrescriptionId > 0) {
            //alert(chiefCompliant+diagnosisDetail);
            $.ajax({
                type: "POST",
                url: 'hub/prescriptions/prescribe/models/orderprescription.php',
                dataType: 'json',
                data: { orderPrescriptionId: orderPrescriptionId, chiefCompliant: chiefCompliant, diagnosisDetail: diagnosisDetail, pharmacyId: pharmacyId },
                success: function (info) {
                    var fullName = info.title + " " + info.firstName + " " + info.fatherName + " " + info.grandFatherName;
                    // var pPrescriptionId = "EP-" + info.prescriptionId;
                    document.getElementById("pPrescriptionId").innerHTML = info.prescriptionId;
                    document.getElementById("pFullName").innerHTML = fullName;
                    document.getElementById("pMobilePhone").innerHTML = info.mobilePhone +" (";
                    document.getElementById("pCustodianPhone").innerHTML = info.custodianPhone+ ")";

                    document.getElementById("medicationDetail").style.display = "none";
                    document.getElementById("orderSuccess").style.display = "block";
                    // change browser url
                    if (window.history.replaceState) {
                        window.history.replaceState("", "", "?name=hub/prescriptions/prescribe/prescriptions&var=prescriptions");
                    }
                }

            });
        }
    }

    function deleteDrug(prescribedDrugsId, drugsId) {
        //alert(drugId);

        $.ajax({
            type: "POST",
            url: 'hub/prescriptions/prescribe/models/deletedrug.php',
            dataType: 'json',
            data: { prescribedDrugsId: prescribedDrugsId },
            success: function (drugId) {

                document.getElementById(drugId.prescribedDrugsId).remove();

                for (var i = 0; i < prescribedDrugIds.length; i++) {
                    if (prescribedDrugIds[i] === drugsId) {
                        prescribedDrugIds.splice(i, 1);
                    }
                }
            }

        });

    }

    function setQtyUnit(selectedUnit) {
        $('#qtyUnit').val(selectedUnit).trigger('chosen:updated');

    }

    function setDurationUnit(durationUnit) {

        if (durationUnit.includes("hour") || durationUnit.includes("day") || durationUnit.includes("Immediately")) {
            $('#durationUnit').val("Day(s)").trigger('chosen:updated');
            $('#days').prop('disabled', false).trigger("chosen:updated");
            $('#weeks').prop('disabled', false).trigger("chosen:updated");
        }

        if (durationUnit.includes("week")) {
            $('#durationUnit').val("Week(s)").trigger('chosen:updated');
            $('#days').prop('disabled', true).trigger("chosen:updated");
            $('#weeks').prop('disabled', false).trigger("chosen:updated");

        }

        if (durationUnit.includes("month")) {
            $('#durationUnit').val("Month(s)").trigger('chosen:updated');
            $('#days').prop('disabled', true).trigger("chosen:updated");
            $('#weeks').prop('disabled', true).trigger("chosen:updated");
        }

        calculateQty();

    }

    function calculateQty() {
        var frequencyO = document.getElementById("frequency").value;
        var durationUnitO = document.getElementById("durationUnit").value;
        frequency = frequencyO.replace(/\s/g, '');
        durationUni = durationUnitO.replace("(", "");
        durationUnit = durationUni.replace(")", "");

        //alert(durationUnit)

        var Frequency = {
            Immediately: "1",
            Onceaday: "1",
            Twiceaday: "2",
            Thriceaday: "3",
            Fourtimesaday: "4",
            Every2hours: "12",
            Every3hours: "8",
            Every4hours: "6",
            Every6hours: "4",
            Every8hours: "3",
            Every12hours: "2",
            Onalternativedays: "1/2",
            Onceaweek: "1/7",
            Twiceaweek: "2/7",
            Thriceaweek: "3/7",
            Every2weeks: "1/14",
            Every3weeks: "1/21",
            Onceamonth: "1/30",
            Fivetimesaday: "5",
            Fourdaysaweek: "4/7",
            Fivedaysaweek: "5/7",
            Sixdaysaweek: "6/7"
        };

        var DurationUnit = {
            Days: "1",
            Weeks: "7",
            Months: "30"
        };

        frquencyValue = Frequency[frequency];


        durationUnitValue = DurationUnit[durationUnit];
        var dose = document.getElementById("dose").value;
        var duration = document.getElementById("duration").value;

        frquencyValue = frquencyValue == undefined ? 1 : frquencyValue;
        durationUnitValue = durationUnitValue == undefined ? 1 : durationUnitValue;
        dose = dose == "" ? 0 : dose;
        duration = duration == "" ? 1 : duration;
        if (frquencyValue.indexOf("/") !== -1) {
            var exp = frquencyValue.split("/");
            var numerator = exp[0];
            var denominator = exp[1];
            frquencyValue = numerator / denominator;
        }
        var totalQty = dose * frquencyValue * duration * durationUnitValue;
        totalQty = Math.ceil(totalQty);
        document.getElementById("totalQty").value = totalQty;
        //alert(dose + " " + frquencyValue + " " + durationUnitValue + " " + duration + " = " + totalQty)
    }

    function gitterDisplay(drugId) {
        document.getElementById("gritterPopup").value = drugId;
        $('#gritterPopup').click();
    }
</script>

<script src="../js/jquery.gritter.min.js"></script>

<script type="text/javascript">

    // onchange event listner for drugname
    $(function () {
        $("#drugName").on('change', function () {
            var drugName = document.getElementById("drugName").value;
            var drugId = document.querySelector("#drugNames option[value='" + drugName + "']").dataset.value;
            document.getElementById("gritterPopup").value = drugId;
            //Remove focus from drug name
            document.getElementById("drugName").blur();

            var checkDrug = prescribedDrugIds.includes(drugId);
            if (checkDrug == false) {
                prescribedDrugIds.push(drugId);
            } else {
                document.getElementById("checkDrugDuplication").value = 1;
                document.getElementById("drugName").value = "";
            }
            $('#gritterPopup').click();

        })
    });

    $(function ($) {

        $('#gritterPopup').on(ace.click_event, function () {

            var drugsId = document.getElementById("gritterPopup").value;

            $.ajax({
                type: "POST",
                url: 'hub/prescriptions/prescribe/models/drugdetails.php',
                dataType: 'json',
                data: { drugsId: drugsId },
                success: function (drug) {

                    var checkDrugDuplication = document.getElementById("checkDrugDuplication").value;
                    if (checkDrugDuplication == 0) {
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: drug.drugsName,
                            // (string | mandatory) the text inside the notification
                            text: '<b style="font-size:12px;">Side Effects :</b> ' + drug.sideEffects + '<br><br><b style="font-size:12px;">Drug Interactions :</b> ' + drug.drugInteractions + '<br><a target="_blank" href="?name=dashboard/drugdetailsinfo&var=prescriptions&drugsId=' + drugsId + '">See full drug information</a>',
                            class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : ' gritter-light')
                        });
                    } else {
                        $.gritter.add({
                            title: '<span style="color:white;">' + drug.drugsName + '</span>',
                            text: '<span style="color:white;"> Is in the list of Drugs to be Prescribed. If you want to edit the drug medication first remove the drug from the list by clicking the <b>X</b> and add to the list again.</span>',
                            class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
                        });
                    }

                    document.getElementById("checkDrugDuplication").value = 0;
                }
            });
            return true;
        });



    });
</script>