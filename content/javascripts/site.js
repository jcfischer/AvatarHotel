$(document).ready(function(){

  // validation of contact form
  //
  $('#contact').validate();
  $('#search_room').validate();


  // Google Map
  //
  $('#map').gMap({ markers: [{ latitude: 21.128685, 
                              longitude: -157.296238,
                              html: "Location of Avatar Hotel, Moloka'i", 
                              popup: true }],
                  zoom: 9 });

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
    old_image.fadeOut('slow', function() {
      $(this).remove();
    });
    return false;

  });
     
   });

