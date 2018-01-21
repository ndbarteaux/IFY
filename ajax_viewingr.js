function test(){
  alert("test");
}

function insertIngr(ing, url){
  let imgURL = url + "ajax_ingrimage.php?ing=" + ing;
  $.ajax({url: imgURL,
		success: function(result){
			$("#ingrImg").attr("src", "data://jpeg;base64," + result);
      $("#output2").html("success");
		},
    error: function(){
			$("#output2").html("Image failed to load");
		}
	});

  let ingURL = url + "ajax_ingredient.php?ing=" + ing;
  // alert("ingredient URL: " + ingURL);
  jQuery.post(ingURL, {}, function(data, status) {
		addIngr(data);
		jQuery("#output1").html(status);
	});
}

function addIngr(data){
  document.getElementById("ingrTitle").innerHTML = data.name;
  document.getElementById("ingrDesc").innerHTML = data.desc;
  document.getElementById("ingrPrice").innerHTML = data.cost;
  document.getElementById("ingrUnits").innerHTML = data.unit;
}
