// simple form validation plugin - just an example to get 
// started, could be much more elaborate 
// jcf, 4.10.2010
//

(function ($) {

  var messages = {
    'required': 'This field must be filled out',
    'email': 'The format of the email is wrong'
  };

  var validations = {
    'required' : function(element) {
        return $.trim(element.val()).length > 0;
      },
    'email' : function(element) {
        var mail_regexp = /^[\w\-\.\?+]+@([\w\-]+\.)+(\w){2,4}$/;
        return mail_regexp.test($.trim(element.val())); 
      }
    
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
                     var error_message_id = $field.attr('id') + "_error";
                     var klasses = $field.attr('class');
                     var klasses = klasses.split(" ");
                     for (var i in klasses) {
                       var klass = klasses[i];
                       // is there a validation available that has the
                       // same name as the class of the field?
                       if(validations[klass]) {
                         // then call the method associated and hand it the 
                         // field
                         if(!validations[klass]($field)) {
                           $field.addClass('fieldError');
                           // add the message div if it doesn't yet exist
                           if( $("#" + error_message_id).length == 0) {
                            var error = $('<div>', {
                                            id: error_message_id,
                                            text: messages[klass]}).
                                        addClass('fieldMessage');
                             $field.after(error);
                           }
                          submitable = false;
                         } else {
                           // remove the message div and the 
                           // error class on the field
                           $("#" + error_message_id).remove();
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
