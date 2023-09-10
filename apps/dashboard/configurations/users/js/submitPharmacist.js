function submitPharmacistForm() {
    var educationalLevelId = document.getElementById('educationalLevelId').value;
    var graduatedFrom = document.getElementById('graduatedFrom').value;
    var graduationYear = document.getElementById('graduationYear').value;
    var qualification = document.getElementById('qualification').value;
    var licenceNo = document.getElementById('licenceNo').value;
    var licenceExpirationDate = document.getElementById('licenceExpirationDate').value;
    if (educationalLevelId != "" && graduatedFrom != "" && graduationYear != "" && qualification != "" && licenceNo != "" && licenceExpirationDate != "") {
        document.getElementById('pharmacistinfo').submit();
    } else {
        document.getElementById('ErrorDisplay').innerHTML = "<b style='color:red;'>Please fill all the fields</b>";
    }
}