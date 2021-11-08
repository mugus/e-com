// Auto close alert
$(".alert").fadeTo(6000, 500).slideUp(2000, function (){ 
  $(this).remove();
});







// Show delete item warning 
function ShowWarning(ps_id){
	$("#div"+ps_id).show();
	$(".show_ps_id").hide();
}
function HideWarning(ps_id){
	$("#div"+ps_id).hide();
	$(".show_ps_id").show();

}
// End Show delete item warning 




// get duplicated sizes input
// $('#btnAdd').click(function() {
// 	let num = $('.clonedSection').length;
// 	let newNum  = new Number(num + 1);
	
// 	let newSection = $('#clonedSection'+num).clone().attr('id', 'clonedSection'+newNum);
	
// 	newSection.children(':first').children(':first').attr('id', 'product_size' + newNum).attr('name', 'product_size' + newNum).attr('value', '' + newNum);
// 	newSection.children(':nth-child(2)').children(':first').attr('id', 'price' + newNum).attr('name', 'price' + newNum).attr('value', '' + newNum);
// 	newSection.children(':nth-child(2)').children(':first').attr('id', 'stock' + newNum).attr('name', 'stock' + newNum).attr('value', '' + newNum);

// 	$('.clonedSection').last().append(newSection)
// 	$('#btnDel').css('display','block');
	
// });

// $('#btnDel').click(function() {
// 	let num = $('.clonedSection').length; // how many "duplicatable" input fields we currently have
// 	$('#clonedSection'+num).remove();     // remove the last element
	
// 	if (num-1 == 1)
// 		$('#btnDel').css('display','none');
// });
// $('#btnDel').css('display','none');

		
// Get phone div to update phone number
function Getphone(){
	if($('#getdiv').is(":checked"))   
		$(".phone_div").show();
	else
		$(".phone_div").hide();
}



$('#password, #password2').on('keyup', function () {
	if ($('#password').val() == $('#password2').val()) {
		$('#phone').show();
	} else 
	  $('#phone').hide();
  });

// Add search box on select input
$(document).ready(function () {
	$('select').selectize({
		sortField: 'text'
	});
});

//Auto Generate Reg No
function makeid(length) {
	var result           = '';
	var characters       = '0123456789';
	var charactersLength = characters.length;
	for ( var i = 0; i < length; i++ ) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
	return result;
}
let id = makeid(8);
$("#farmer_reg_no").val("INGABO-"+id);



// Check availability of Product name
$('.product_name').on('blur', function(){
	let product_name = $(this).val().trim();
	// console.log(product_name);
	$.ajax({
		url: "../ajax/product.php",
		data: {
			product_name:product_name
		},
		type: 'POST',
		success: function(data){
			$('#p_name_msg').html(data);
		}
	});
});


// Review Product size details
$(document).on('click', '.product_size_details', function(e){
	e.preventDefault();
	var product_size_details = $(this).data('id');
	// console.log('Id is ',product_size_details);
	getProduct_size_Datails(product_size_details);
  });

  function getProduct_size_Datails(product_size_details){
	$.ajax({
		type: 'POST',
		url: '../ajax/product.php',
		data: {product_size_details:product_size_details},
		// dataType: 'json',
		success: function(response){
			$('#sizes_data').html(response);
		}
	});
  }


    // Register FarmerID

	$(document).on('blur', '#farmer_firstname', function(e){
		e.preventDefault();
		var farmer_firstname = $(this).val();
		let farmId = farmer_firstname.substring(0, 4);
		// console.log("farmer ", farmId);
		Get_Farmer_Chars(farmId);
	});
	function Get_Farmer_Chars(farmId){
		$.ajax({
			type: 'POST',
			url: '../ajax/farmer.php',
			data: {farmId:farmId},
			// dataType: 'json',
			success: function(response){
				$('#FarmerNewId').val(response);
				// console.log(response);
			}
		});
	}


  // Update Farmer details
  $(document).on('click', '.edit_farmer', function(e){
	e.preventDefault();
	var farmer_ids = $(this).data('id');
	Edit_Farmer_Datails(farmer_ids);
  });
  function Edit_Farmer_Datails(farmer_ids){
	console.log('Id is ',farmer_ids);

	$.ajax({
		type: 'POST',
		url: '../ajax/farmer.php',
		data: {farmer_ids:farmer_ids},
		dataType: 'json',
		success: function(response){
			$('#farmer_id').val(response.farmer_id);
			$('#farmer_firstname').val(response.farmer_firstname);
			$('#farmer_lastname').val(response.farmer_lastname);
			// $('#farmer_reg_no').val(response.farmer_reg_no);
			$('#province').val(response.province);
			$('#district').val(response.district);
			$('#sector').val(response.sector);
			$('#cell').val(response.cell);
			$('#village').val(response.village);
			$('#f_phone').val(response.farmer_phone);
			$('#farmer_landsize').val(response.farmer_landsize);
			// $('#id').val(response.id);
			console.log('name ',response.farmer_lastname);
		}
	});
  }


  // New Product size details

  $(document).on('click', '.new_ps', function(e){
	e.preventDefault();
	var new_ps = $(this).data('id');
	// console.log('New Id is ',new_ps);
	New_Product_size_Datails(new_ps);
  });
  function New_Product_size_Datails(new_ps){
	$.ajax({
		type: 'POST',
		url: '../ajax/product.php',
		data: {new_ps:new_ps},
		dataType: 'json',
		success: function(response){
			$('#product_name').html(response.name);
			$('#product_id').val(response.product_id);
			// console.log('pro id ',response.product_id);
		}
	});
  }
  // End New Product size details



// const load_price = () => {
	// let id = $("#size").val();
	// $("#qty").attr("disabled", false);
// alert(id);
// }
// update Stock
$(document).on('click', '.edit_stock', function(e){
	e.preventDefault();
	var edit_stock = $(this).data('id');
	// console.log('New Id is ',edit_stock);
	Update_Stock(edit_stock);
  });
function Update_Stock(edit_stock){
	$.ajax({
		type: 'POST',
		url: '../ajax/product.php',
		data: {edit_stock:edit_stock},
		dataType: 'json',
		success: function(response){
			$('#stock').val(response.stock);
			$('#st_id').val(response.id);
			$('#coop_name').html(response.coop_name);
			$('.product_size').html(response.product_size);
			$('#pro_size_id').val(response.ps_id);
			console.log('pro size ',response.ps_id);
		}
	});
}


// end update stock


  // Update Product size details
$(document).on('click', '.ps_id', function(e){
	e.preventDefault();
	var ps_id = $(this).data('id');
	// console.log('Id is ',ps_id);
	Edit_Product_size_Datails(ps_id);
  });

  function Edit_Product_size_Datails(ps_id){
	$.ajax({
		type: 'POST',
		url: '../ajax/product.php',
		data: {ps_id:ps_id},
		dataType: 'json',
		success: function(response){
			$('#product_size').val(response.product_size);
			$('#stock').val(response.stock);
			$('#price').val(response.price);
			$('#man_date').val(response.man_date);
			$('#exp_date').val(response.exp_date);
			$('#id').val(response.id);
			console.log('size ',response.id);
		}
	});
  }




// Check availability of Reg No
$('#farmer_reg_no').on('blur', function (){
  let farmer_reg_no = $('#farmer_reg_no').val().trim();
	// console.log("fafhvf ", farmer_reg_no);
  $.ajax({
		url: "../ajax/farmer.php",
		data: {farmer_reg_no: farmer_reg_no},
		type: "POST",
		success: function(data){
			$(".reg_info").html(data);
			console.log(data);
		}
	});
});


// checking phone availability
$('#farmer_phone').on('blur', function (){
  let farmer_phone = $('#farmer_phone').val().trim();
	// console.log("fafhvf ", farmer_phone);
  $.ajax({
		url: "../ajax/farmer.php",
		data: {farmer_phone: farmer_phone},
		type: "POST",
		success: function(data){
			$(".phone_info").html(data);
			console.log(data);
		}
	});
});





$('.open').on('click', function(){
	$(".close").toggle();
	$("#phone_nav").css('display', 'block');
});
// $('.close').on('click', function(){
// 	$(".open").css('display', 'block');
// 	$("#phone_nav").css('display', 'none');
// });

// Review order details
$(document).on('click', '.order_details', function(e){
	e.preventDefault();
	var order_tx_ref = $(this).data('id');
	// console.log(order_tx_ref);
	getOrderDatails(order_tx_ref);
  });
  function getOrderDatails(order_tx_ref){
	$.ajax({
		type: 'POST',
		url: '../ajax/order.php',
		data: {order_tx_ref:order_tx_ref},
		// dataType: 'json',
		success: function(response){
			// console.log('data of order ',response.farmer_lastname);
			$('#order_data').html(response)
			$('#lastname').html($('<span>',{text: response.farmer_lastname}));
		// 	$('#cart_id').val(response.cart_id);
		// 	$('#names').html($('<span>',{text: response.name}));
		// 	$('#price').html($('<span>',{text: response.price}));
		}
	});
  }




$(document).on('click', '.cart__remove', function(e){
  e.preventDefault();
  var cart = $(this).data('id');
  getCartToDelete(cart);
});

function getCartToDelete(cart){
	// console.log(cart);
	$.ajax({
		type: 'POST',
		url: './ajax/cart.php',
		data: {cart:cart},
		dataType: 'json',
		success: function(response){
			// console.log('my cart to delete ',response);
			$('#name').html($('<span>',{text: response.name}));
			$('#cart_id').val(response.cart_id);
			$('#names').html($('<span>',{text: response.name}));
			$('#price').html($('<span>',{text: response.price}));
		}
	});
	
}

// View Product 

	$(document).on('click', '.quick-view', function(e){
		e.preventDefault();
		var product_id = $(this).data('id');
		console.log(product_id);
		ViewProduct(product_id);
	});
	function ViewProduct(product_id){
		$.ajax({
			type: 'POST',
			url: './ajax/product.php',
			data: {product_id:product_id},
			dataType: 'json',
			success: function(response){
				// console.log('my cart to delete ',response);
				$('#pro_name').html($('<span>',{text: response.name}));
        $('#photo').html($('#photo').attr('src', './assets/images/products/'+response.photo));
				$('#category').html($('<span>',{text: response.cat_name}));
				$('#pro_price').html($('<span>',{text: response.price}));
				$('.rte').html($('<span>',{text: response.descriptions}));
				$('.man_date').html($('<span>',{text: response.man_date}));
				$('.exp_date').html($('<span>',{text: response.exp_date}));
				// $('#cart_id').val(response.cart_id);
			}
		});
	}



// Update qty
	$('.qty').on('change', function(){
		alert("Use + and - Button to edit this field");
		window.location.reload();
	});




	$('.plus').on('click', function(){
		let qty = $(".qty").val();
		updated_qty = parseInt(qty) + 1;
		var cart_id = $(this).data('id');
		// console.log('qty: ',updated_qty);
		UpdateQtyPlus(cart_id);
		// alert(cart_id);
	});
	function UpdateQtyPlus(qtyplus_cart_id){
		console.log('id: ',qtyplus_cart_id);
		$.ajax({
			type: 'POST',
			url: './ajax/cart.php',
			data: {
				qtyplus_cart_id:qtyplus_cart_id
			},
			// dataType: 'json',
			success: function(response){
				window.location.reload();
			}
		});
	}

	$('.minus').on('click', function(){
		let qty = $(".qty").val();
		updated_qty = parseInt(qty) - 1;
		if(updated_qty === 0){
			updated_qty = 1;
			alert('Quantity can not be zero');
		}else{
			var cart_id = $(this).data('id');
			UpdateQtyMinus(cart_id);
		}
	});
	function UpdateQtyMinus(qtyminus_cart_id){
		$.ajax({
			type: 'POST',
			url: './ajax/cart.php',
			data: {
				qtyminus_cart_id:qtyminus_cart_id
			},
			// dataType: 'json',
			success: function(response){
				// console.log(response);
				window.location.reload();
			}
		});
	}


	// coop value from db
	function load_coop_info(){
		let coop_opt = $("#coop_opt option:selected").val();
		$.post(
			"./ajax/coop.php", 
			{coop_opt: coop_opt},
			function (data){
				$('.coop_data').html(data);
			}
		);
	}


		// farmer value from db
		function load_farmer_info(){
			let farmer_opt = $("#farmer_opt option:selected").val();
			$.post(
				"./ajax/farmer.php", 
				{farmer_opt: farmer_opt},
				function (data){
					$('.farmer_data').html(data);
				}
			);
		}



(function ($) {
	// Start of use strict
	'use strict';
	
    /*-----------------------------------------
	  1. Preloader Loading ----------------------- 
	  -----------------------------------------*/
	function pre_loader(){
		$("#load").fadeOut();
		$('#pre-loader').delay(0).fadeOut('slow');
	}
	pre_loader();
		
	/*-----------------------------------------
	 2. Promotional Bar Header ------------------
	  -----------------------------------------*/
	function promotional_bar(){
		$(".closeHeader").on('click',function() {
			$(".promotion-header").slideUp();  
			Cookies.set('promotion', 'true', { expires: 1});  
			return false;
		});
	}
	promotional_bar();

	
	/*-----------------------------------------
	  5. Top Links Show/Hide dropdown ---------
	  -----------------------------------------*/
	  function userlink_dropdown(){  
		$('.top-header .user-menu').on("click", function() {
			if ($(window).width() < 990 ) {
				$(this).next().slideToggle(300);
				$(this).parent().toggleClass("active");
			}
		});
	 }
	 userlink_dropdown();
	 
	 /*-----------------------------------------
	  6. Minicart Dropdown ---------------------
	  ------------------------------------------ */
	  function minicart_dropdown(){
		$(".site-header__cart").on("click", function(i) {
			i.preventDefault();
			$("#header-cart").slideToggle();
		});
		// Hide Cart on document click
		$("body").on("click", function(event ) {
		  var $target = $(event.target);
		  if(!$target.parents().is(".site-cart") && !$target.is(".site-cart")){
			$("body").find("#header-cart").slideUp();
		  }
		});
	  }
	 minicart_dropdown();
	
	/*-----------------------------------------
	  7. Sticky Header ------------------------
	  -----------------------------------------*/
	window.onscroll = function(){ myFunction() };
    function myFunction() {
      if($(window).width()>1199) {
            if($(window).scrollTop()>145){
              $('.header-wrap').addClass("stickyNav animated fadeInDown");                   
            } else {
              $('.header-wrap').removeClass("stickyNav fadeInDown");              
            }
       }
    }
	
	/*-----------------------------------------
	  8. Search Trigger -----------------------
	  ----------------------------------------- */
	function search_bar(){
		$('.search-trigger').on('click', function () {
			const search = $('.search');
	
			if (search.is('.search--opened')) {
				search.removeClass('search--opened');
			} else {
				search.addClass('search--opened');
				$('.search__input')[0].focus();
			}
		});
	}
	search_bar();
	$(document).on('click', function (event) {
		if (!$(event.target).closest('.search, .search-trigger').length) {
			$('.search').removeClass('search--opened');
		}
	});
	
	/*-----------------------------------------
	  9. Mobile Menu --------------------------
	  -----------------------------------------*/
	var selectors = {
      	body: 'body',
      	sitenav: '#siteNav',
      	navLinks: '#siteNav .lvl1 > a',
      	menuToggle: '.js-mobile-nav-toggle',
      	mobilenav: '.mobile-nav-wrapper',
      	menuLinks: '#MobileNav .anm',
      	closemenu: '.closemobileMenu'
	};
     
  	$(selectors.navLinks).each(function(){
        if($(this).attr('href') == window.location.pathname) $(this).addClass('active');
    })
	
  	$(selectors.menuToggle).on("click",function(){
      body: 'body',
      $(selectors.mobilenav).toggleClass("active");
      $(selectors.body).toggleClass("menuOn");
      $(selectors.menuToggle).toggleClass('mobile-nav--open mobile-nav--close');
    });
  
    $(selectors.closemenu).on("click",function(){
      body: 'body',
      $(selectors.mobilenav).toggleClass("active");
      $(selectors.body).toggleClass("menuOn");
      $(selectors.menuToggle).toggleClass('mobile-nav--open mobile-nav--close');
    });
    $("body").on('click', function (event) {
      var $target = $(event.target);
      if(!$target.parents().is(selectors.mobilenav) && !$target.parents().is(selectors.menuToggle) && !$target.is(selectors.menuToggle)){
          $(selectors.mobilenav).removeClass("active");
          $(selectors.body).removeClass("menuOn");
          $(selectors.menuToggle).removeClass('mobile-nav--close').addClass('mobile-nav--open');
      }
    });
	$(selectors.menuLinks).on('click', function(e) {
		e.preventDefault();
		$(this).toggleClass('anm-plus-l anm-minus-l');
		$(this).parent().next().slideToggle();
    });
	
	
	/*-----------------------------------------
	  10.1 Homepage Slideshow -----------------
	  -----------------------------------------*/
	  function home_slider(){
		 $('.home-slideshow').slick({
			dots: false,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
			arrows: true,
			autoplay: true,
			autoplaySpeed: 4000,
			lazyLoad: 'ondemand'
		  });
	  }
	  home_slider();
	
	// Full Size Banner on the Any Screen
	$(window).resize(function() {
		var bodyheight = $(this).height() - 20;
		$(".sliderFull .bg-size").height(bodyheight);
	}).resize();
	
	/*-----------------------------------------
	  10.2 Product Slider Slick ---------------
	  -----------------------------------------*/
	function product_slider(){
	 $('.productSlider').slick({
		dots: false,
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: true,
		responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		}
		]
	
	  });
	}
	product_slider();

	/*-----------------------------------------
	  10.3 Product Slider Slick Style2 --------
	  -----------------------------------------*/
	function product_slider1(){
		$('.productSlider-style1').slick({
			dots: false,
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			]
		});
	}
	product_slider1();

	/*-----------------------------------------
	  10.4 Product Slider Slick Style3 --------
	  -----------------------------------------*/
	function product_slider2(){
		$('.productSlider-style2').slick({
			dots: false,
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			arrows: true,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			]
		});
	}
	product_slider2();

	/*-----------------------------------------
	  10.5 Product Slider Slick Fullwidth -----
	  ----------------------------------------- */
	  function product_slider_full(){
		$('.productSlider-fullwidth').slick({
			dots: false,
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			arrows: true,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			]
		});
	  }
	  product_slider_full();

	/*-----------------------------------------
	  10.6 Product Slider Slick Product Page --
	  ----------------------------------------- */
	function product_slider_ppage(){
		$('.productPageSlider').slick({
			dots: false,
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			arrows: true,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 680,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 380,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			]
		});
	}
	product_slider_ppage();

	/*-----------------------------------------
	  10.7 Collection Slider Slick ------------
	  ----------------------------------------- */
	function collection_slider(){
		$('.collection-grid').slick({
			dots: false,
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			arrows: true,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			}
			]
		});
	}
	collection_slider();

	/*-----------------------------------------
	  10.8 Collection Slider Slick 4 items ----
	  ----------------------------------------- */	  
	function collection_slider1(){
		$('.collection-grid-4item').slick({
			dots: false,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			arrows: true,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			}
			]
		});
	}
	collection_slider1();

	/*-----------------------------------------
	  10.9 Logo Slider Slick ------------------
	  -----------------------------------------*/
	function logo_slider(){
		$('.logo-bar').slick({
			dots: false,
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			arrows: true,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			}
			]
		});
	}
	logo_slider();

	/*-----------------------------------------
	  10.10 Testimonial Slider Slick ----------
	  -----------------------------------------*/
	function testimonial_slider(){
		$('.quotes-slider').slick({
			dots: false,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
		});
	}
	testimonial_slider();
	  
	/*-----------------------------------
	  11. Tabs With Accordian Responsive
	-------------------------------------*/
	$(".tab_content").hide();
	$(".tab_content:first").show();
	
	/* if in tab mode */
	$("ul.tabs li").on('click', function () {
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn();		
		
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		
		$(".tab_drawer_heading").removeClass("d_active");
		$(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
		
		$('.productSlider').slick('refresh');
	
	});
	/* if in drawer mode */
	$(".tab_drawer_heading").on('click', function () {
		
		$(".tab_content").hide();
		var d_activeTab = $(this).attr("rel"); 
		$("#"+d_activeTab).fadeIn();
		
		$(".tab_drawer_heading").removeClass("d_active");
		$(this).addClass("d_active");
		
		$("ul.tabs li").removeClass("active");
		$("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
		
		$('.productSlider').slick('refresh');
	});
	
	$('ul.tabs li').last().addClass("tab_last");
	
	/*-----------------------------------
	  End Tabs With Accordian Responsive
	-------------------------------------*/
	
	/*-----------------------------------
	  12. Sidebar Categories Level links
	-------------------------------------*/
	function categories_level(){
		$(".sidebar_categories .sub-level a").on("click", function() {
			$(this).toggleClass('active');
			$(this).next(".sublinks").slideToggle("slow");
		}); 
	}
	categories_level();
	
	$(".filter-widget .widget-title").on("click", function () {
		$(this).next().slideToggle('300');
		$(this).toggleClass("active");
	});
	
	/*-----------------------------------
	 13. Price Range Slider
	-------------------------------------*/
	function price_slider(){
		$("#slider-range").slider({
			range: true,
			min: 12,
			max: 200,
			values: [0, 100],
			slide: function(event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider-range").slider("values", 0) +
		" - $" + $("#slider-range").slider("values", 1));
	}
	price_slider();
	
	/*-----------------------------------
	 14. Color Swacthes
	-------------------------------------*/
	function color_swacthes(){
		$.each($(".swacth-list"), function() {
			var n = $(".swacth-btn");
			n.on("click", function() {
				$(this).parent().find(n).removeClass("checked");
				$(this).addClass("checked")
			})
		});
	}
	color_swacthes();
	
	/*-----------------------------------
	  15. Footer links for mobiles
	-------------------------------------*/
	function footer_dropdown(){
		$(".footer-links .h4").on('click', function () {
			if($(window).width() < 766){
			  $(this).next().slideToggle();
			  $(this).toggleClass("active");
			}
		});  
	}
	footer_dropdown();
	
	//Resize Function 
	var resizeTimer;
	$(window).resize(function (e) {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function () {
			$(window).trigger('delayed-resize', e);
		}, 250);
	});
	$(window).on("load resize",function(e){
		if ($(window).width() > 766 ) {
			$(".footer-links ul").show();
		}
		else {
			$(".footer-links ul").hide();
		}
	});
	
	
	/*-------------------------------
	  16. Site Animation
	----------------------------------*/
	  if($(window).width() < 771) {
		  $('.wow').removeClass('wow');
	  }
	  var wow = new WOW(
	  {
		boxClass:     'wow',      // animated element css class (default is wow)
		animateClass: 'animated', // animation css class (default is animated)
		offset:       0,          // distance to the element when triggering the animation (default is 0)
		mobile:       false,       // trigger animations on mobile devices (default is true)
		live:         true,       // act on asynchronously loaded content (default is true)
		callback:     function(box) {
		  // the callback is fired every time an animation is started
		  // the argument that is passed in is the DOM node being animated
		},
		scrollContainer: null // optional scroll container selector, otherwise use window
	  }
	);
	wow.init();
	
  	/*-------------------------------
	  17. SHOW HIDE PRODUCT TAG
	----------------------------------*/
	$(".product-tags li").eq(10).nextAll().hide(); 
	$('.btnview').on('click', function () {
	$(".product-tags li").not('.filter--active').show();
	 $(this).hide();
	});
	
  	/*-------------------------------
	  18. SHOW HIDE PRODUCT Filters
	----------------------------------*/
    $('.btn-filter').on("click", function() {
       $(".filterbar").toggleClass("active");
    });
    $('.closeFilter').on("click", function() {
      $(".filterbar").removeClass("active");
    });
  	// Hide Cart on document click
    $("body").on('click', function (event) {
      var $target = $(event.target);
      if(!$target.parents().is(".filterbar") && !$target.is(".btn-filter")){
        $(".filterbar").removeClass("active");
      }
    });
	
	/*-------------------------------
	 19. Timer Count Down
	----------------------------------*/
	$('[data-countdown]').each(function () {
		var $this = $(this),
			finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function (event) {
			$this.html(event.strftime('<span class="ht-count days"><span class="count-inner"><span class="time-count">%-D</span> <span>Days</span></span></span> <span class="ht-count hour"><span class="count-inner"><span class="time-count">%-H</span> <span>HR</span></span></span> <span class="ht-count minutes"><span class="count-inner"><span class="time-count">%M</span> <span>Min</span></span></span> <span class="ht-count second"><span class="count-inner"><span class="time-count">%S</span> <span>Sc</span></span></span>'));
		});
	});
	
	/*-------------------------------
	 20.Scroll Top ------------------
	---------------------------------*/
	function scroll_top(){
		$("#site-scroll").on("click", function() {
			$("html, body").animate({ scrollTop: 0 }, 1000);
				return false;
		}); 
	}
	scroll_top();
	
	$(window).scroll(function(){    
		if($(this).scrollTop()>300){
		  $("#site-scroll").fadeIn();
		} else {
		   $("#site-scroll").fadeOut();
		}
	});
	
	/*-------------------------------
	  21. Height Product Grid Image
	----------------------------------*/
	function productGridView() {
	  var gridRows = []; 
	  var tempRow = [];
	  productGridElements = $('.grid-products .item');
	  productGridElements.each(function (index) {
		if ($(this).css('clear') != 'none' && index != 0) {
		  gridRows.push(tempRow);
		  tempRow = []; 
		}
		tempRow.push(this);
	
		if (productGridElements.length == index + 1) {
		  gridRows.push(tempRow);
		}
	  });
	
	  $.each(gridRows, function () {
		var tallestHeight = 0;
		var tallestHeight1 = 0;
		$.each(this, function () {
		  $(this).find('.product-image > a').css('height', '');
		  elHeight = parseInt($(this).find('.product-image').css('height'));
		  if (elHeight > tallestHeight) { tallestHeight = elHeight; }
		});
	
		$.each(this, function () {
		  if($(window).width() > 768) {
			$(this).find('.product-image > a').css('height', tallestHeight);
		  }
		});
	  });
	}
	
	/*----------------------------
       22. Product details slider 2
    ------------------------------ */
	function product_thumb(){
		$('.product-dec-slider-2').slick({
			infinite: true,
			slidesToShow: 5,
			vertical: true,
			slidesToScroll: 1,
			centerPadding: '60px'
		});
	}
	product_thumb();
	
	/*----------------------------
       23. Product details slider 1
    ------------------------------ */
	function product_thumb1(){
		$('.product-dec-slider-1').slick({
			infinite: true,
			slidesToShow: 6,
			stageMargin: 5,
			slidesToScroll: 1
		});
	}
	product_thumb1();
	
	/*--------------------------
      24. Product Zoom
	---------------------------- */
	function product_zoom(){
		$(".zoompro").elevateZoom({
			gallery: "gallery",
			galleryActiveClass: "active",
			zoomWindowWidth: 300,
			zoomWindowHeight: 100,
			scrollZoom: false,
			zoomType: "inner",
			cursor: "crosshair"
		});
	}
	product_zoom();
	
	/*--------------------------
      25. Product Page Popup ---
	---------------------------- */
    function video_popup(){
		if($('.popup-video').length){
			$('.popup-video').magnificPopup({
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false
			});
		}
	}
	video_popup();
	
	function size_popup(){
		$('.sizelink').magnificPopup({
			type:'inline',
			midClick: true
		});
	}
	size_popup();
	
	function inquiry_popup(){
		$('.emaillink').magnificPopup({
			type:'inline',
			midClick: true
		});
	}
	inquiry_popup();
	
	/*----------------------------------
	  26. Quantity Plus Minus
	------------------------------------*/
	function qnt_incre(){
		$(".qtyBtn").on("click", function() {
		  var qtyField = $(this).parent(".qtyField"),
			 oldValue = $(qtyField).find(".qty").val(),
			  newVal = 1;
	
		  if ($(this).is(".plus")) {
			newVal = parseInt(oldValue) + 1;
		  } else if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		  }
		  $(qtyField).find(".qty").val(newVal);
		});
	}
	qnt_incre();
	
	/*----------------------------------
	  27. Visitor Fake Message
	------------------------------------*/
    var userLimit = $(".userViewMsg").attr('data-user'),
        userTime = $(".userViewMsg").attr('data-time');
    $(".uersView").text(Math.floor((Math.random() * userLimit)));
    setInterval(function(){
    	$(".uersView").text(Math.floor((Math.random() * userLimit)));
	}, userTime);

	/*----------------------------------
	  28. Product Tabs
	------------------------------------*/
	$(".tab-content").hide();
	$(".tab-content:first").show();
	/* if in tab mode */
	$(".product-tabs li").on('click', function () {
		$(".tab-content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn();		
		
		$(".product-tabs li").removeClass("active");
		$(this).addClass("active");
		
		$(this).fadeIn();
      	if($(window).width()<767) {
          var tabposition = $(this).offset();
          $("html, body").animate({ scrollTop: tabposition.top }, 700);
        }
	});
    
    $('.product-tabs li:first-child').addClass("active");
	$('.tab-container h3:first-child + .tab-content').show();
	
	/* if in drawer mode */
	$(".acor-ttl").on("click", function() {
		$(".tab-content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn();
		
		$(".acor-ttl").removeClass("active");
		$(this).addClass("active");
	});

    
    $(".reviewLink").on('click', function(e){
      e.preventDefault();
        $(".product-tabs li").removeClass("active");
      	$(".reviewtab").addClass("active");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
      	var tabposition = $("#tab2").offset();
      	if($(window).width()<767) {
          $("html, body").animate({ scrollTop: tabposition.top-50 }, 700);
        } else{
          $("html, body").animate({ scrollTop: tabposition.top-80 }, 700);
        }
    });
	
	/*--------------------------------------
	  29. Promotion / Notification Cookie Bar 
	  -------------------------------------- */
	  function cookie_promo(){
		  if(Cookies.get('promotion') != 'true') {   
			 $(".notification-bar").show();         
		  }
		  $(".close-announcement").on('click',function() {
			$(".notification-bar").slideUp();  
			Cookies.set('promotion', 'true', { expires: 1});  
			return false;
		  });
	  }
	  cookie_promo();
	 /* --------------------------------------
	 	End Promotion / Notification Cookie Bar 
	 -------------------------------------- */
	 
	 /* --------------------------------------
	 	30. Image to background js
	 -------------------------------------- */
    $(".bg-top" ).parent().addClass('b-top');
    $(".bg-bottom" ).parent().addClass('b-bottom');
    $(".bg-center" ).parent().addClass('b-center');
    $(".bg-left" ).parent().addClass('b-left');
    $(".bg-right" ).parent().addClass('b-right');
    $(".bg_size_content").parent().addClass('b_size_content');
    $(".bg-img").parent().addClass('bg-size');
    $(".bg-img.blur-up" ).parent().addClass('');
    jQuery('.bg-img').each(function() {

        var el = $(this),
            src = el.attr('src'),
            parent = el.parent();

        parent.css({
            'background-image': 'url(' + src + ')',
            'background-size': 'cover',
            'background-position': 'center',
            'background-repeat': 'no-repeat'
        });

        el.hide();
    });
	/* --------------------------------------
	 	End Image to background js
	 -------------------------------------- */
	
	/*----------------------------------
	32. Related Product Slider ---------
	------------------------------------*/
	function related_slider(){
		$('.related-product .productSlider').slick({
		  dots: false,
		  infinite: true,
		  item: 5,
		  slidesToScroll: 1,
		  responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToScroll: 1,
			  }
			},        
			{
			  breakpoint: 767,
			  settings: {
				slidesToScroll: 1,
			  }
			}
		  ]
		});
	}
	related_slider();
	/*----------------------------------
	  End Related Product Slider
	  ------------------------------------*/
	
	/*-----------------------------------
	  33. Infinite Scroll js
	  -------------------------------------*/
	function load_more(){
        $(".product-load-more .item").slice(0, 16).show();
        $(".loadMore").on('click', function (e) {
            e.preventDefault();
            $(".product-load-more .item:hidden").slice(0, 4).slideDown();
            if ($(".product-load-more .item:hidden").length == 0) {
                $(".infinitpagin").html('<div class="btn loadMore">no more products</div>');
            }
        });
    }
	load_more();
	
	function load_more_post(){
        $(".blog--grid-load-more .article").slice(0, 3).show();
        $(".loadMorepost").on('click', function (e) {
            e.preventDefault();
            $(".blog--grid-load-more .article:hidden").slice(0, 1).slideDown();
            if ($(".blog--grid-load-more .article:hidden").length == 0) {
                $(".loadmore-post").html('<div class="btn loadMorepost">No more Blog Post</div>');
            }
        });
    }
	load_more_post();
	/*-----------------------------------
	  End Infinite Scroll js
	  -------------------------------------*/
	

})(jQuery);
