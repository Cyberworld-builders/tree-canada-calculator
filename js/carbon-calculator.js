jQuery(document).ready(function($){

  $('.nav-item').click(function(e){
    $('.nav-item').removeClass('active');
    $(this).addClass('active');
    $('.tab-pane').removeClass('show');
    $('.tab-pane').addClass('hide');
    $('#' + $(this).attr('aria-controls')).addClass('show');
  });

  $('#other-transport-tab').click();

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
    $('.need-id').each(function(){
      var default_id = $(this).attr('id');
      $(this).attr('id',default_id + increment);
      $(this).removeClass('need-id');
      if($(this).attr('for').length != -1){
        var default_for = $(this).attr('for');
        $(this).attr('for',default_for + increment);
      }
    });

  });

  $('.hyperlink').click(function(){ window.open($(this).data('url')); });

});
