$(function () {
  $('.ui.selection.dropdown')
    .dropdown()
  ;
  $('.ui.form')
    .form({
      fields: {
        email: {
          identifier: 'email',
          rules: [
            {
              type   : 'empty',
              prompt : 'Alamat Email tidak boleh kosong'
            },
            {
              type   : 'email',
              prompt : 'Alamat Email tidak valid'
            }
          ]
        }
      },
      inline : true,
      on     : 'blur',
      onSuccess : function () {
        $('#masuk-dimmer').addClass('active').delay(1500).fadeOut('fast');
        $('#masukPesan-dimmer').addClass('active');
      }
    })
  ;
})
