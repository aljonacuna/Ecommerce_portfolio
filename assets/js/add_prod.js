$(document).ready( function() {
	var image_file = document.getElementById("uploadImageFile");
	var all_input = document.querySelectorAll("input[class=form-control]");
	for(var x = 0 ; x < all_input.length ; x++) {
		all_input[x].addEventListener("keyup", function() {
			var id = this.id;
			var input_text = document.getElementById(id).value;
			document.getElementById(id+"-text").innerText = input_text;
		});
	}
	var desc = document.getElementById("desc");
	desc.addEventListener("keyup", function() {
		var desc_text = desc.value;
		document.getElementById("desc-text").innerText = desc_text;
	});
	image_file.addEventListener("change", function() {
		imagepreview();
	});
	function imagepreview() {
		document.getElementById("newgallery").style.display = "block";
		var total_file = image_file.files.length;
		var count = 0;
		console.log(URL.createObjectURL(event.target.files[0]));
		if (total_file >= 5 && total_file <= 5) {
			for(var i = 0 ; i < total_file ; i++) {
				count++;
				$('#imagediv').append("<img src='"+ 
					URL.createObjectURL(event.target.files[i])+"' id='preview_img'>"+
					"<input type='radio' name='radio' class='form-check-input mt-3 mx-5'"+
					" value='"+count+"' id='main-radio"+count+"'>"+
					"<label>main</label><br>");
				$(".li-"+count).attr("data-thumb", URL.createObjectURL(event.target.files[i]));
				$(".img"+count).attr("src", URL.createObjectURL(event.target.files[i]));
			}
		}
		gallery();
		var all_radio = document.querySelectorAll("input[type=radio]");
		for(var x = 0 ; x < all_radio.length ; x++) {
			all_radio[x].addEventListener("click", function() {
				var id = this.id;
				var new_id = id.substr(-1, id.length)
				var prev_main = $(".img1").attr("src");
				var img = $(".img"+new_id).attr("src");
				$(".li-1").attr("data-thumb", img);
				$(".img1").attr("src", img);
				// gallery()
			});
		}
	}
	function gallery() {
		$('#newgallery').lightSlider({
			gallery: true,
			item: 1,
			loop:false,
			slideMargin: 0,
			thumbItem: 5
		});
	}
	
});