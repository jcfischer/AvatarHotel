// simple form validation plugin - just an example to get 
// started, could be much more elaborate 
// jcf, 4.10.2010
//

(function ($) {


  var methods = {
    check_form : function(){
                  alert("in submit"); 
                } 
  };
  $.fn.validate() {
    return this.each(function(){
      // $this holds our form
      var $this = $(this);
      $this.bind('submit.validate',  methods.check_form );
    });
  };

})(jQuery);
