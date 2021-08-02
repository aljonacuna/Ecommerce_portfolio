$(document).ready( function() {
	var hash = "";
	$.get("ajaxcustomers/render_products", function(res) {
		$("#prod-list").html(res);
	});
	var all_category_li= document.querySelectorAll("li[class=category-li]");
	console.log(all_category_li);
	for (var x = 0 ; x < all_category_li.length ; x++) {
		all_category_li[x].addEventListener("click", function() {
			var id = this.id;
			hash = refresh_token();
			$.post("ajaxcustomers/search_category/"+id, {"csrf_test_name": hash}, function(res) {
				$("#prod-list").html(res);
				setToken();
			});
			// return false;
		});	
		
	}
	$(document).on("submit","#paging-form", function() {
		$.post($(this).attr("action"), $(this).serialize(), function(res) {
			$("#prod-list").html(res);
			setToken();
		});
		return false;
	});
	$(document).on("keyup","#form-search", function() {
		var search_value = document.getElementById("search").value;
		search_value = (search_value == "") ? "1" : search_value;
		$.post("ajaxcustomers/search_prodname/"+search_value, $(this).serialize(), function(res) {
			$("#prod-list").html(res);
			setToken();
		});
		return false;
	});
	$(document).on("change", "#sort-form", function() {
		var sort_value = document.getElementById("sort-list").value;
		$.post("ajaxcustomers/sort_by/"+sort_value, $(this).serialize(), function(res) {
			$("#prod-list").html(res);
			setToken();
		});
		return false;
	});
	function refresh_token() {
		return document.getElementsByClassName('csrf_token')[0].id;
	}
	function setToken() {
		$('input[name=csrf_test_name]').val(refresh_token());
	}
	setTimeout(function() { setToken(); }, 500); 
});