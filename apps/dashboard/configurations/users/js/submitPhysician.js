function submitPhysicianForm() {
    var educationalLevelId = document.getElementById('educationalLevelId2').value;
    var graduatedFrom = document.getElementById('graduatedFrom2').value;
    var graduationYear = document.getElementById('graduationYear2').value;
    var specialization = document.getElementById('specialization2').value;
    var licenceNo = document.getElementById('licenceNo2').value;
    var licenceExpirationDate = document.getElementById('licenceExpirationDate2').value;
    var HealthInstitutionName = document.getElementById('HealthInstitutionName').value;
    if (HealthInstitutionName != "" && educationalLevelId != "" && graduatedFrom != "" && graduationYear != "" && specialization != "" && licenceNo != "" && licenceExpirationDate != "") {
        document.getElementById('physicianinfo').submit();
    } else {
        document.getElementById('ErrorDisplay2').innerHTML = "<b style='color:red;'>Please fill all the fields</b>";
    }
}
