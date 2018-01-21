
jQuery(document).ready(function() {
	let url = "https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php";
	// let url = "fedr.php";
	jQuery.post(url, {}, function(data, status) {
		buildTable(data);
		jQuery("#output1").html(status);
	})

});

function buildTable(sites){
	let length = sites.length;
	// alert("length is : [" + length + "]");
	for(i = 0; i < length; i++){
		entryFromSite(sites[i]);
	}
}

function entryFromSite(site){
	var baseURL = site.baseURL;
	var name = site.nameShort;
	// alert("name: [" + name + "], baseURL: [" + baseURL + "]");
	$.ajax(
			{
				url: baseURL + "ajax_status.php",
				success: function(result){
					let dstat = result.status;
					if(dstat != undefined && dstat == "open"){
						addSiteListing(baseURL);
					}
				},
				error: function(result){
					jQuery("#output1").html(baseURL + " failed to load");
				}
			}
	);
}

function addSiteListing(url){
	if(url == ""){
		return;
	}
	$.post(url + "ajax_listing.php", {}, function(data, status){
		for(i = 0; i < data.length; i++){
			// alert(url + ": [" + data[i].name + "]");
			if(data[i].name != undefined){
				addRow(data[i], url);
			}
		}
		jQuery("#output1").html(status);
	});
}

function addRow(listing, url){
	let row_html  = "<tr>";
	// add link here
	// row_html += "<td>" + listing.name + "</td>";
	// row_html += "<td><a href=\"h/Users/nathanbarteaux/IFY/ajax_viewingr.php?ing=" + listing.name + "&link=" + url + "\" target=\"_blank\">" + listing.name + "</a></td>";
	row_html += "<td><a href=\"/Users/nathanbarteaux/IFY/ajax_viewingr.php?ing=" + listing.name + "&cost=" + listing.cost+ "&link=" + url + "\" target=\"_blank\">" + listing.name + "</a></td>";
	row_html += "<td>" + listing.unit + "</td>";
	row_html += "<td>" + "$" + listing.cost + "</td>";
	row_html += "<td><a href=\"" + url + "\">" + url + "</a></td>";
	// row_html += "<td><a href=\"h/Users/nathanbarteaux/IFY/ajax_ingredient.php?ing=" + listing.name + "\">Click Here</a> For More Info!</td>";
	row_html += "</tr>";
	$("#ings").append(row_html);
}
