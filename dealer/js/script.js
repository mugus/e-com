function ValidatePaint () {
  if($("#paint_name").val() === ''){
    $("#p_name_msg").html("Fill out this field")
    $('#paint_name').focus();
    return false;
  }else if($('#paint_name').val().length > 25){
    $("#p_name_msg").html("Paint name must not be large than 25 chars")
    $('#paint_name').focus();
    return false;
  }else if($('#paint_name').val().length < 8){
    $("#p_name_msg").html("Paint name must have atleast 8 chars")
    $('#paint_name').focus();
    return false;
  }else if($('#category').val() === ''){
    $("#cat_msg").html("Choose category");
    $("#p_name_msg").html("")
    $('#category').focus();
    return false;
  }else if($('#technics').val() === ''){
    $("#tech_msg").html("Choose Technic");
    $("#cat_msg").html("")
    $('#technics').focus();
    return false;
  }else if($('#height').val() === ''){
    $("#sizes_msg").html("Add Height of your paint");
    $("#tech_msg").html("")
    $('#height').focus();
    return false;
  }else if($('#height').val().length > 3){
    $("#sizes_msg").html("Height is too long");
    $("#tech_msg").html("")
    $('#height').focus();
    return false;
  }else if($('#width').val() === ''){
    $("#sizes_msg").html("Add Width of your paint");
    $("#tech_msg").html("")
    $('#width').focus();
    return false;
  }else if($('#width').val().length > 3){
    $("#sizes_msg").html("Width is too long");
    $("#tech_msg").html("")
    $('#width').focus();
    return false;
  }else if($('#quantity').val() === ''){
    $("#sizes_msg").html("Add Stock of your paint");
    $("#tech_msg").html("")
    $('#quantity').focus();
    return false;
  }else if($('#price').val() === ''){
    $("#sizes_msg").html("Add Price of your paint");
    $("#tech_msg").html("")
    $('#price').focus();
    return false;
  }else if($('#dates').val() === ''){
    $("#date_msg").html("Add Date of your Idea");
    $("#sizes_msg").html("")
    $('#dates').focus();
    return false;
  }else if($('#desc').val() === ''){
    $("#desc_msg").html("Add Descriptions of your paint");
    $("#date_msg").html("")
    $('#desc').focus();
    return false;
  }else if($('#desc').val().length > 200){
    $("#desc_msg").html("Descriptions of your paint must be less than 200 chars");
    $("#date_msg").html("")
    $('#desc').focus();
    return false;
  }else{
    return true;
  }
}

$(document).ready(function(){
  $(".alert").fadeTo(6000, 500).slideUp(2000, function (){ 
    $(this).remove();
  });






// View Product
  $(document).on('click', '.view_product', function(e){
    e.preventDefault();
    var paint_id = $(this).data('id');
    paintInfo(paint_id);
    // console.log(paint_id);
  });
  function paintInfo(paint_id){
    $.ajax({
      type: 'POST',
      url: './ajax/paint_data.php',
      data: {paint_id:paint_id},
      dataType: 'json',
      success: function(res){
        $('#price').html($('<span>',{text: res.price}));
        $('#name').html($('<span>',{text: res.paint_name}));
        $('#height').html($('<span>',{text: res.height}));
        $('#width').html($('<span>',{text: res.width}));
        $('#stock').html($('<span>',{text: res.quantity}));
        $('#status').html($('<span>',{text: res.status}));
        // for(let i = ){

        // }
        console.log("image is ", res.price);
        $('#image').html($('#image').attr('src', './Photos/Paints/'+res.photo_name));
        $('#owner').html($('<span>',{text: res.vendor_address}));
        $('#email').html($('<span>',{text: res.vendor_email}));
        $('#ve_name').html($('<span>',{text: res.businessName}));
        $('#category').html($('<span>',{text: res.category_name}));
        // $('#created_by1').html($('<span>',{text: res.created_by}));
      },
      error: function(){
        console.log("Failed");
      }
    });
  }

  // Delete Paint
  $(document).on('click', '.delete_pa', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    DelePaint(id);
    // console.log(id);
  });
  function DelePaint(id){
    $.ajax({
      type: 'POST',
      url: './ajax/delete_paint.php',
      data: {id:id},
      dataType: 'json',
      success: function(res){
        $('#pid').val(res.pid);
        console.log(res);
      }
    })
  }


    // Edit Paint
    $(document).on('click', '.editInfo', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      EditPaint(id);
      console.log(id);
    });
    function EditPaint(id){
      $.ajax({
        type: 'POST',
        url: './ajax/edit_paint.php',
        data: {id:id},
        dataType: 'json',
        success: function(res){
          $('#edit_name').val(res.paint_name);
          $('#edit_category').val(res.category_name);
          $('#edit_technics').val(res.tech_name);
          $('#edit_height').val(res.height);
          $('#edit_width').val(res.width);
          $('#edit_quantity').val(res.quantity);
          $('#edit_price').val(res.price);
          $('#edit_image').html($('#edit_image').attr('src', './Photos/Paintings/'+res.photo_name));
          $('#photoid').val(res.photoid);
          // $('#height').html($('<span>',{text: res.height}));
          // $('#width').html($('<span>',{text: res.width}));
          // $('#stock').html($('<span>',{text: res.quantity}));
          // $('#status').html($('<span>',{text: res.status}));
          // $('#image').html($('#image').attr('src', './Photos/Paints/'+res.photo_name));
          // $('#owner').html($('<span>',{text: res.vendor_address}));
          // $('#email').html($('<span>',{text: res.vendor_email}));
          // $('#ve_name').html($('<span>',{text: res.businessName}));
          // $('#category').html($('<span>',{text: res.category_name}));
          // $('#created_by1').html($('<span>',{text: res.created_by}));
          $('#new_image').on('change', function(){
            let name = document.getElementById("new_image").files[0].name;
            let photoid = document.getElementById("photoid").value;
            let form_data = new FormData();

            let ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['png','jpg', 'jpeg']) == -1){
              alert("Invalid image format");
            }else{
              let oFReader = new FileReader();
              oFReader.readAsDataURL(document.getElementById("new_image").files[0]);
              let f = document.getElementById("new_image").files[0];
              let fsize = f.size||f.fileSize;
              if(fsize > 2000000){
                alert("image is very big");
              }else{
                form_data.append("new_image", document.getElementById("new_image").files[0]);
                form_data.append("photoid", photoid);
                console.log("Photo id ", form_data);
                $.ajax({
                  url: "./ajax/new_img.php",
                  method: "POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function(){
                    $("#uploaded_image").html("<small class='text-success'>Image Uploading....</small>");
                  },
                  success: function(data){
                    $("#uploaded_image").html(data)
                  }
                });
              }
            }
          });

        }
      });
    }




});



class Slideshow {

  constructor() {
    this.initSlides();
    this.initSlideshow();
  }
  
  // Set a `data-slide` index on each slide for easier slide control.
  initSlides() {
    this.container = $('[data-slideshow]');
    this.slides = this.container.find('img');
    this.slides.each((idx, slide) => $(slide).attr('data-slide', idx));
  }
  
  // Pseudo-preload images so the slideshow doesn't start before all the images
  // are available.
  initSlideshow() {
    this.imagesLoaded = 0;
    this.currentIndex = 0;
    this.setNextSlide();
    this.slides.each((idx, slide) => {
      $('<img>').on('load', $.proxy(this.loadImage, this)).attr('src', $(slide).attr('src'));
    });
  }
  
  // When one image has loaded, check to see if all images have loaded, and if
  // so, start the slideshow.
  loadImage() {
    this.imagesLoaded++;
    if (this.imagesLoaded >= this.slides.length) { this.playSlideshow() }
  }
  
  // Start the slideshow.
  playSlideshow() {
    this.slideshow = window.setInterval(() => { this.performSlide() }, 3500);
  }
  
  // 1. Previous slide is unset.
  // 2. What was the next slide becomes the previous slide.
  // 3. New index and appropriate next slide are set.
  // 4. Fade out action.
  performSlide() {
    if (this.prevSlide) { this.prevSlide.removeClass('prev fade-out') }
  
    this.nextSlide.removeClass('next');
    this.prevSlide = this.nextSlide;
    this.prevSlide.addClass('prev');
  
    this.currentIndex++;
    if (this.currentIndex >= this.slides.length) { this.currentIndex = 0 }
  
    this.setNextSlide();
  
    this.prevSlide.addClass('fade-out');
  }
  
  setNextSlide() {
    this.nextSlide = this.container.find(`[data-slide="${this.currentIndex}"]`).first();
    this.nextSlide.addClass('next');
  }
  
  }
  
  $(document).ready(function() {
  new Slideshow;
  });
  