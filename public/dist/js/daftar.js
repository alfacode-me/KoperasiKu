koperasi.controller('daftar', function ($scope, $http) {
  $(function () {
    $('.ui.dropdown')
      .dropdown()
    ;
    $('.ui.form')
      .form({
        fields: {
          namaPengguna: {
            identifier: 'namaPengguna',
            rules: [
              {
                type   : 'empty',
                prompt : 'Nama Pengguna tidak boleh kosong'
              },
              {
                type   : 'minLength[6]',
                prompt : 'Nama Pengguna minimal 6 karakter'
              },
              {
                type   : 'maxLength[32]',
                prompt : 'Nama Pengguna maksimal 32 karakter'
              }
            ]
          },
          katasandi: {
            identifier: 'katasandi',
            rules: [
              {
                type   : 'empty',
                prompt : 'Katasandi tidak boleh kosong'
              },
              {
                type   : 'minLength[8]',
                prompt : 'Katasandi minimal 8 karakter'
              },
              {
                type   : 'maxLength[52]',
                prompt : 'Katasandi maksimal 52 karakter'
              }
            ]
          },
          c_katasandi: {
            identifier: 'k_katasandi',
            rules: [
              {
                type   : 'empty',
                prompt : 'Katasandi tidak boleh kosong'
              },
              {
                type   : 'match[katasandi]',
                prompt : 'Konfirmasi katasandi tidak sesuai'
              }
            ]
          },
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
          },
          jenisKelamin: {
            identifier: 'jenisKelamin',
            rules: [
              {
                type   : 'empty',
                prompt : 'Jenis Kelamin tidak boleh kosong'
              }
            ]
          },
          namalengkap: {
            identifier: 'namaLengkap',
            rules: [
              {
                type   : 'empty',
                prompt : 'Nama Lengkap tidak boleh kosong'
              },
              {
                type   : 'maxLength[75]',
                prompt : 'Nama Lengkap maksimal 75 karakter'
              }
            ]
          },
          noTelp: {
            identifier: 'noTelp',
            rules: [
              {
                type   : 'empty',
                prompt : 'Alamat Email tidak boleh kosong'
              },
              {
                type   : 'number',
                prompt : 'No Telephone tidak valid'
              },
              {
                type   : 'maxLength[15]',
                prompt : 'No Telephone maksimal 15 karakter'
              }
            ]
          },
          alamat: {
            identifier: 'alamat',
            rules: [
              {
                type   : 'empty',
                prompt : 'Alamat tidak boleh kosong'
              }
            ]
          }
        },
        inline : true,
        on     : 'blur'
      })
    ;
  });
  $scope.daftar = function () {
    var req = {
      method: 'POST',
      url: '/api/daftar',
      headers: {'Content-Type': 'application/json'},
      data: {
        namaPengguna: $scope.namaPengguna,
        katasandi: $scope.katasandi,
        email: $scope.email,
        namaLengkap: $scope.namaLengkap,
        jenisKelamin: $scope.jenisKelamin,
        noTelp: $scope.noTelp,
        alamat: $scope.alamat
      }
    }
    $http(req).then(function(response){
      var res = response.data;
      if (res == "Email telah terdaftar") {
        $scope.psn = "MOHON MAAF";
        $scope.pesan = "Alamat Email telah terdaftar";
        $scope.btn = "Coba lagi";
        $scope.gagal = true;
        $(function () {
          $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
            $('#dimmer').removeClass('active').fadeOut(200);
            $('#pesan').addClass('active');
          });
        })
      }
      if (res == "Nama Pengguna telah terdaftar") {
        $scope.psn = "MOHON MAAF";
        $scope.pesan = "Nama Pengguna telah terdaftar";
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
        $scope.pesan = "Akun telah sukses terdaftar";
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
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
  }
})
