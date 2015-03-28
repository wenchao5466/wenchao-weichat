$(function() {
  
  $('.navbar-toggle').click(function() {
    var targetSelector = $(this).data('target');
    var hidden = $(targetSelector).css('display') == 'none';
    $('.navbar-togglable').hide();
    if (hidden) {
      $(targetSelector).show();
      $('#content').css('margin-top', 80 + $(this).data('height'));
    }
    else {
      $(targetSelector).hide();
      $('#content').css('margin-top', 80);
    }
  });

});