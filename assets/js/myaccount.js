$(document).ready(function() {
	var hash = "";
	$.get("myaccounts", function(res) {
		$("#content").html(res);
	});

	$(document).on("click", ".tag", function() {
		hash = refresh_token();
		var id = this.id;
		var current = document.querySelector(".active-link");
		current.classList.remove("active-link");
		current.classList.add("inactive-link");
		var active = document.getElementById(id);
		active.classList.remove("inactive-link");
		active.classList.add("active-link");
		$.post("myaccounts/switch_page/" + id, {"csrf_test_name": hash}, function(res) {
			$("#content").html(res);
		});
		return false;
	});
	$(document).on("submit", "form", function() {
		$.post($(this).attr("action"), $(this).serialize(), function(res) {
			$("#content").html(res);
		});
		return false;
	});
	$(document).on("click", ".edit-address", function() {
		id = this.id;
		if (id == "edit-shipping") {
			all_input("shipping");
			document.getElementById("save-btn-shipping").disabled = false;
		}
		else {
			all_input("billing");
			document.getElementById("save-btn-billing").disabled = false;
		}
	});
	function all_input(input) {
		var all_input = document.getElementsByClassName(input);
		console.log(all_input);
		for (var x = 0 ; x < all_input.length ; x++) {
			document.getElementById(all_input[x].id).disabled = false;
		}

	}
	function refresh_token() {
		return document.getElementsByClassName('csrf_token')[0].id;
	}
});