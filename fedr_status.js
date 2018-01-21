var alist;

jQuery(document).ready(function() {
  // jQuery("#debug").html("test0");
	jQuery.post("https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php", {}, function(data, status) {
  // jQuery.post("fedr.php", {}, function(data, status) {
    addRows(data);
    jQuery("#output1").html(status);
  })
});

function addRows(lst) {
	var rt = "";
	var tab = document.getElementById('sites');
	var i = tab.rows.length;
	var len = lst.length;

	for (j = len - 1; j >= 0; j--) {
    rt  = "<tr>";
    rt += "<td id=\"" + lst[j].Team + "_status\" style=\"background-color: yellow;\"> unresponsive </td>"; // status of each team's page

    rt += "<td id=\"" + lst[j].Team + "_num\" style=\"background-color: yellow;\">";
		rt += lst[j].Team; // team numbers
		rt += "</td>";

    rt += "<td id=\"" + lst[j].Team + "_sname\" style=\"background-color: yellow;\">";
    rt += lst[j].nameShort; // team short name
    rt += "</td>";

    rt += "<td id=\"" + lst[j].Team + "_lname\" style=\"background-color: yellow;\">";
    rt += lst[j].nameLong; // team long name
    rt += "</td>";

    rt += "<td id=\"" + lst[j].Team + "_url\" style=\"background-color: yellow;\">";
    rt += "<a href=\"" + lst[j].baseURL + "\" target=\"_blank\">";
    rt += lst[j].baseURL; // team baseURL
    rt += "</a>"
    rt += "</td>";

    rt += "</tr>";
		var rr = tab.insertRow(i);
		rr.innerHTML = rt;
	}
  for (j = 0; j < len; j++) {
		getStatus(lst[j].baseURL, lst[j].Team);
	}
}


function getStatus(u, n){
  // alert("u: [" + u + "] n: [" + n + "]");
  if(u==""){
    //otherwise it will return the status in our ajax_status.php
    return;
  }

  var check = u.slice(0,5);
  targetSiteStatus = "";
  // alert("[" + check + "]");
  if(check != "https"){
    targetSiteStatus = "https://" + u.slice(7,-1) + "/ajax_status.php";
    // alert("target site is: " + targetSiteStatus);
  }else{
    targetSiteStatus = u + "ajax_status.php";
    // alert("target site is: " + targetSiteStatus);
  }



  jQuery.post(targetSiteStatus, {a : n}, function(data, status) {
    target = "#" + n + "_status";
    jQuery(target).text(data.status);
    // alert(data.status);

    target1 = "#" + n + "_num";
    target2 = "#" + n + "_lname";
    target3 = "#" + n + "_sname";
    target4 = "#" + n + "_url";

    switch(data.status){
      case "closed":
        jQuery(target).css("background-color", "red");
        jQuery(target1).css("background-color", "red");
        jQuery(target2).css("background-color", "red");
        jQuery(target3).css("background-color", "red");
        jQuery(target4).css("background-color", "red");
        break;
      case "open":
        jQuery(target).css("background-color", "lawngreen");
        jQuery(target1).css("background-color", "lawngreen");
        jQuery(target2).css("background-color", "lawngreen");
        jQuery(target3).css("background-color", "lawngreen");
        jQuery(target4).css("background-color", "lawngreen");
        break;
    }
  })

}
