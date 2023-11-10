// Utiliza jQuery para detectar el evento focus y blur en los campos de entrada
$('.input').on('focus', function() {
    $(this).next('.placeholder-label').addClass('active');
  });
  
  $('.input').on('blur', function() {
    if (!$(this).val()) {
      $(this).next('.placeholder-label').removeClass('active');
    }
  });
  
  // Comprueba si los campos de entrada tienen algún valor al cargar la página
  $('.input').each(function() {
    if ($(this).val()) {
      $(this).next('.placeholder-label').addClass('active');
    }
  });
  