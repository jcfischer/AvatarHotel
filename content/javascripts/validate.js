// simple form validation plugin - just an example to get 
// started, could be much more elaborate 
// jcf, 4.10.2010
//

(function ($) {


  var validations = {
    'required' : function(element) {
        return $.trim(element.val()).length > 0;
      },
    email : 'email'
    
  }
  var methods = {
    check_form : function(){
                   var submitable = true;
                   // retrieve all inputs of the form, minus the buttons
                   console.log(this);
                   var fields =$([]).add(this.elements)
                                    .filter(':input')
                                    .not(':submit, :reset');
                   console.log(fields);
                   // check each field, see if it's css class
                   // is registred as a function handler
                   // and execute it
                   fields.each(function(index, field) {
                     var $field = $(field);
                     var klasses = $field.attr('class');
                     var klasses = klasses.split(" ");
                     for (var i in klasses) {
                       var klass = klasses[i];
                       if(validations[klass]) {
                         if(!validations[klass]($field)) {
                           $field.addClass('fieldError');
                           var error = $('<span>').addClass("fieldMessage").
                                      html("This field is in error");
                           $field.after(error);
                          submitable = false;
                         } else {
                            $field.removeClass('fieldError');
                         }
                     
                       }
                       
                     }
                   }); 
                   return submitable;
                }, 
  };
  $.fn.validate = function() {
    return this.each(function(){
      // $this holds our form
      var $this = $(this);
      $this.bind('submit',  methods.check_form );

    });
  };

})(jQuery);
