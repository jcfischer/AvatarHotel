$(document).ready(function(){

  // validation of contact form
  //
  $('#contact').validate();
  $('#search_room').validate();


  $('ul.gallery li a').each(function(){
    var path = $(this).attr('href');
    var thumbnail = $("<img>", { src: path }).addClass("thumbnail"); 
    thumbnail.attr('width', 96).attr('height', 72);
    $(this).html(thumbnail);
  });

  $('ul.gallery li a').click(function(){
    var path = $(this).attr('href');
    var new_image = $("<img>", { src: path }).addClass("display").hide();
    var old_image = $('#image img');
    $('#image').append(new_image);
    new_image.fadeIn('slow');
    old_image.remove();
    return false;

  });
     
   });

