<?php ?>
<div id="dispensedMedications" class="tab-pane in active">
    <div id="noDispensedMedication"></div>

    <table id="dispensedMedicationsTable" class="table table-striped table-bordered table-hover">

        <span style="font-size:1.1em;font-style: italic;display: block;margin-left:10%;">List of Dispensed Medications for pharmacy: <b><?php if (isset($_SESSION['pharmacyName']))
                                                                                                                                            echo $_SESSION['pharmacyName']; ?>, &nbsp; <?php if (isset($_SESSION['pharmacyType']))                                                                                                                                                                                           echo $_SESSION['pharmacyType']; ?></b> ..<br><br></span>
    </table>
</div>