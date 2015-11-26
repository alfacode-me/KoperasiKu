// Controller Masuk
koperasiku.controller('masuk', function ($scope, $http) {
  // Validasi Form
  $(function () {
    $('.ui.form')
      .form({
        fields: {
          username: {
            identifier: 'username',
            rules: [
              {
                type   : 'empty',
                prompt : 'Username tidak boleh kosong'
              },
              {
                type   : 'minLength[6]',
                prompt : 'Username minimal 6 karakter'
              },
              {
                type   : 'maxLength[42]',
                prompt : 'Username maksimal 42 karakter'
              }
            ]
          },
          password: {
            identifier: 'password',
            rules: [
              {
                type   : 'empty',
                prompt : 'Password tidak boleh kosong'
              },
              {
                type   : 'minLength[8]',
                prompt : 'Password minimal 8 karakter'
              },
              {
                type   : 'maxLength[64]',
                prompt : 'Password maksimal 64 karakter'
              }
            ]
          }
        },
        inline : true,
        on     : 'blur'
      })
    ;
  });
  // Fungsi Daftar
  $scope.masuk = function () {
    if ($scope.username && $scope.password) {
      // Data API Masuk
      var req = {
        method: 'POST',
        url: '/api/masuk',
        headers: {'Content-Type': 'application/json'},
        data: {
          username: $scope.username,
          password: $scope.password
        }
      }
      // Memanggil API Masuk
      $http(req).then(function(response){
        var res = response.data;
        if (res == "Username Salah") {
          $scope.psn = "Mohon Maaf";
          $scope.pesan = "Username tidak terdaftar";
          $scope.btn = "Coba lagi";
          $scope.gagal = true;
          $(function () {
            $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
              $('#dimmer').removeClass('active').fadeOut(200);
              $('#pesan').addClass('active');
            });
          })
        }
        if (res == "Password Salah") {
          $scope.psn = "MOHON MAAF";
          $scope.pesan = "Password tidak sesuai";
          $scope.btn = "Coba lagi";
          $scope.gagal = true;
          $(function () {
            $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
              $('#dimmer').removeClass('active').fadeOut(200);
              $('#pesan').addClass('active');
            });
          })
        }
        if (res == "OK") {
          $scope.psn = "SELAMAT";
          $scope.pesan = "Akun anda sesuai";
          $scope.btn = "Lanjutkan";
          $scope.ok = true;
          $(function () {
            $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
              $('#dimmer').removeClass('active').fadeOut(200);
              $('#pesan').addClass('active');
            });
          })
        }
      }, function () {
        console.log("SERVER ERROR");
      })
    }
  }
  // Fungsi Close
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
  }
})
