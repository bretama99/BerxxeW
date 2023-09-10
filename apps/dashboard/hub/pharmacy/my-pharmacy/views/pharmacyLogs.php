<?php ?>
<div id="pharmacyLogs" class="tab-pane">

    <div id="noPharmacyLogHistory"></div>

    <table style="float:right; display:block;" id="filterLogPharmacyByDate">
        <tr style="float:right; display:block;margin-bottom:15px;">

            <td>Pharmacy Status <input type="radio" id="pharmacyLogStatus" name="statusLog" value="1" checked /> &nbsp; &nbsp; &nbsp;</td>
            <td>Pharmacist Status <input type="radio" id="pharmacistLogStatus" name="statusLog" value="2" />&nbsp; &nbsp; &nbsp;</td>
            <td>&nbsp;</td>
            <td style="font-style:italic;">&nbsp;From Date:&nbsp;&nbsp;</td>
            <td><input type="date" id="filterLogPharmacyFromDate" name="fromDate" class="form-control input-md" required /></td>

            <td style="font-style:italic;">&nbsp;To Date:&nbsp;&nbsp;</td>
            <td> <input type="date" id="filterLogPharmacyToDate" name="toDate" class="form-control input-md" required /></td>
            <td> <input type="button" class="form-control" value="Search" onclick="displayPharmacyLogs(<?php echo $_SESSION['pharmacyId']; ?>, <?php echo $_SESSION['usrUsersId']; ?>, 1);" /></td>
        </tr>
        <tr>
            <span style="font-size:1.1em;font-style: italic;display: block;margin-left:10%;">Log History for pharmacy: <b><?php echo $_SESSION['pharmacyName']; ?>, &nbsp; <?php echo $_SESSION['pharmacyType']; ?></b> (Filter using calendar and select box) ..<br><br></span>
        </tr>
    </table>
    <table id="pharmacyLogsTable" class="table table-striped table-bordered table-hover">

    </table>
</div>