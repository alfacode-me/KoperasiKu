// Controller Jenis Simpanan
koperasiku.controller('jenis_simpanan', function ($http, $scope, $filter) {
  // Variable [FIX]
  $scope.$parent.title = "Jenis Simpanan";
  // Refresh Data [FIX]
  $scope.lihat_jns_simpanan = function () {
    // Tabel Data [FIX]
    var req = {
      method: 'GET',
      url: '/jenis_simpanan/all',
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Data [FIX]
    $http(req).then(function(response) {
      $scope.js = response.data;
    }, function () {
    console.log("SERVER ERROR");
    });
  };
  $scope.lihat_jns_simpanan();
  $scope.jns_simpanan = {};

  // Tambah Anggota [FIX]
  $scope.tambah_jenis_simpanan = function () {
    var req = {
      method: 'POST',
      url: '/jenis_simpanan',
      headers: {'Content-Type': 'application/json'},
      data: {
        jenis_simpanan: $scope.jenis_simpanan
      }
    }
    // Memanggil API Tambah
    $http(req).then(function(response) {
      $scope.psn = "SELAMAT";
      $scope.pesan = "Data Jenis Simpanan telah tersimpan";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_jns_simpanan();
    }, function () {
      $scope.psn = "MOHON MAAF";
      $scope.pesan = "Terjadi kesalahan, silahkan cek kembali inputan anda.";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_jns_simpanan();
    });
  }
  // Pilih [FIX]
  $scope.pilih = function (jss) {
    $scope.rincian   = jss;
    $scope.update    = jss;
    $scope.delete    = jss;
  }
  // Update [FIX]
  $scope.updated = function () {
    var req = {
      method: 'PUT',
      url: '/jenis_simpanan/'+$scope.update.id_jns_simpanan,
      headers: {'Content-Type': 'application/json'},
      data: {
        update: $scope.update
      }
    }
    // Memanggil API Masuk
    $http(req).then(function(response) {
      $scope.lihat_jns_simpanan();
    }, function (argument) {
      $scope.lihat_jns_simpanan();
    });
  }
  // Hapus [FIX]
  $scope.hapus = function () {
    var req = {
      method: 'DELETE',
      url: '/jenis_simpanan/'+$scope.delete.id_jns_simpanan,
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Delete
    $http(req).then(function(response) {
      $scope.lihat_jns_simpanan();
    }, function (argument) {
      $scope.lihat_jns_simpanan();
    });
  }
  // Fungsi Close [FIX]
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
    $scope.lihat_jns_simpanan();
  }
});


// Validasi Form [FIX]
$(function () {
  $('.ui.form')
    .form({
      fields: {
        nama: {
          identifier: 'nama',
          rules: [
            {
              type   : 'empty',
              prompt : 'Nama Jenis Simpanan tidak boleh kosong'
            }
          ]
        },
        bunga: {
          identifier: 'bunga',
          rules: [
            {
              type   : 'empty',
              prompt : 'Bunga tidak boleh kosong'
            },
            {
              type   : 'number',
              prompt : 'Bunga tidak valid'
            },
            {
              type   : 'maxLength[3]',
              prompt : 'Bunga maksimal 3 karakter'
            },
          ]
        },
      },
      inline : true,
      on     : 'blur'
    })
  ;
});
