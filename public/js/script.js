function deleteRow() {
    $('div.product-item').each(function(index, item){
       jQuery(':checkbox', this).each(function () {
          if ($(this).is(':checked')) {
         $(item).remove();
          }
       });
    });
 }

 function addMore() {
    $("<div>").load("items", function() {
       $(".container").append($(this).html());
    });	
 }