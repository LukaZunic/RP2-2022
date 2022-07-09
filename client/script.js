function showInternships() {
  
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById("internships").innerHTML = this.responseText;
        }
    }

    xmlhttp.open("GET","../server/getInternships.php", true);
    xmlhttp.send();
 
}