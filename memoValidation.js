function validateForm() {
    var vTitle = document.forms["addMemoForm"]["fTitle"].value;
    var vSender = document.forms["addMemoForm"]["fSender"].value;
    var vRecipients = document.forms["addMemoForm"]["fRecipients"].value;
    var vDate = document.forms["addMemoForm"]["fDate"].value;
    var vMessage = document.forms["addMemoForm"]["fMessage"].value;
    var vUrl = document.forms["addMemoForm"]["fUrl"].value;

    if (vTitle == "") {
        document.getElementById('idTitle').innerHTML="invalid title";
        return false;
    }
    if (vSender == "") {
        alert("Please enter a Sender");
        return false;
    }
    if (vRecipients == "") {
        alert("Please enter a Recipient");
        return false;
    }
    if (vDate == "") {
        alert("Please enter a Date");
        return false;
    }
    if (vMessage == "") {
        alert("Please enter a Message");
        return false;
    }
    if (vUrl == "") {
        alert("Please enter a URL");
        return false;
    }
}
