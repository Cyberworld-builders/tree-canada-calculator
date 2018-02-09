jQuery(document).ready(function($){
  //
  $('.nav-item').click(function(){
    $('.nav-item').removeClass('active');
    $(this).addClass('active');
  });
  $('#energy-tab').click();
  $('.add-dynamic').click(function(e){
    e.preventDefault();
    var template = $('#' + $(this).data('template'));
    var count = Number($(this).data('count'));
    var name = $(this).data('name');
    var increment = count + 1;
    var id = name + '-' + increment;
    template
      .clone()
      .removeAttr('id')
      .attr('id', id)
      .removeClass('hide')
      .insertBefore('#' + template.attr('id'));
      $('.remove-dynamic').click(function(e){
        e.preventDefault();
        $(this).parent().parent().remove();
      });
    $(this).data('count',increment);
  });
});
