$(document).ready(function() {
	var addtocart = document.getElementById("add-to-cart-btn");
	//for increasing and decreasing the quantity
	var count = 1;
	var qty_btn = document.querySelectorAll("div[data=qty-btn]");
	var stocks = document.getElementById("qty").value;
	var avg_reviews = document.getElementById("reviews-text").innerText;
	var prod_id = document.getElementById("prod_id").value;
	$("#rateYo").rateYo({
   		rating: avg_reviews
  	});

	var option = {
		animation: true,
		delay: 1000
	};
	$.get("http://localhost/ecommerce/cart/load_nav/"+prod_id, function(res) {
		$("#nav").html(res);
	});
	$("#add-cart-form").submit(function() {
		if (parseInt(qty_cart()) + parseInt(qty_order(count)) <= parseInt(stocks)) {
			$.post($(this).attr("action"), $(this).serialize(), function(res) {
				$("#nav").html(res);
				setToken();
			});
		}
		else {
		}
		return false;
	});
	for (var i = 0 ; i < qty_btn.length ; i++) {
		qty_btn[i].addEventListener("click", function() {
			var id = this.id;
			if (id == "increment-btn") {
				increase_price();
			}
			else if(id == "decrement-btn"){
				decrease_price();
			}
			else {

			}
		});
	}
	function qty_cart() {
		var qty = document.getElementById("cart_qty").value;
		return qty;
	}
	function qty_order(value) {
		var qty_order = document.getElementById("quantity").value = value;
		return qty_order;
	}
	function increase_price() {
		// document.getElementById("quantity").value = count+=1;
		qty_order(count+=1);
		tot_price();	
	}
	function decrease_price() {
		var qty = qty_order(count);
		count = (qty > 1) ? count-=1 : 1;
		tot_price();
	}
	function tot_price() {
		var qty = qty_order(count);
		var price = document.getElementById("price_prod").value;
		var tot = parseInt(price) * parseInt(qty);
		document.getElementById("price").innerHTML = "Price: &#8369;"+tot;		
	}
	function refresh_token() {
		return document.getElementsByClassName('csrf_cart')[0].id;
	}
	function setToken() {
		$("#csrf_token").val(refresh_token());
	}
	setTimeout(function() { setToken(); }, 500); 
	addtocart.addEventListener("click", function() {
		var text_toast = document.getElementById("text-toast");
		var icon_toast = document.querySelector("#icon-success");
		var toast_div = document.getElementById("toast-msg");
		var qty = document.getElementById("stock-count").innerText;
		if (parseInt(qty_cart()) + parseInt(qty_order(count)) <= parseInt(stocks)) {
			
		}
		else {
			toast_div.style.background = "#f8d7da";
			toast_div.style.height = "180px";
			icon_toast.classList.remove("fa-check-circle");
			icon_toast.classList.add("fa-exclamation-circle");
			text_toast.style.fontSize = "16px";
			text_toast.style.color = "#842029";
			text_toast.innerText = "Unable to add the item in the cart, there are only "+qty+" item/s left in the stocks";
		}
		
		var toast_msg = new bootstrap.Toast(toast_div, option);
		toast_msg.show();
	});

});
