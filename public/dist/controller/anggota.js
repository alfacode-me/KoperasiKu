// Controller Anggota
koperasiku.controller('anggota', function ($scope, $http, $filter) {
  // Refresh [FIX]
  $scope.refresh = function () {
    location.reload();
  }
  // Variable [FIX]
  $scope.title = "Anggota";
  // Refresh Data [FIX]
  $scope.lihat_anggota = function () {
    // Tabel [FIX]
    var req = {
      method: 'GET',
      url: '/anggota/all',
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Data [FIX]
    $http(req).then(function(response) {
      $scope.ak = response.data;
    }, function () {
    console.log("SERVER ERROR");
    });
  };
  $scope.lihat_anggota();
  $scope.anggota = {};
  // Tambah [FIX]
  $scope.tambah_anggota = function () {
    $scope.anggota.tglg = $filter('date')($scope.anggota.tglg, 'yyyy-MM-dd');
    $scope.anggota.tgll = $filter('date')($scope.anggota.tgll, 'yyyy-MM-dd');
    var req = {
      method: 'POST',
      url: '/anggota',
      headers: {'Content-Type': 'application/json'},
      data: {
        anggota: $scope.anggota
      }
    }
    // Memanggil API Tambah
    $http(req).then(function(response) {
      $scope.psn = "SELAMAT";
      $scope.pesan = "Data Anggota telah tersimpan";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_anggota();
    }, function () {
      $scope.psn = "MOHON MAAF";
      $scope.pesan = "Terjadi kesalahan, silahkan cek kembali inputan anda.";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_anggota();
    });
  }
  // Pilih [FIX]
  $scope.pilih = function (ag) {
    $scope.update     = ag;
    $scope.delete     = ag;
    $scope.rincian    = ag;
    console.log("OK");
  }
  // Update [FIX]
  $scope.updated = function () {
    $scope.update.tgl_gabung = $filter('date')($scope.update.tgl_gabung, 'yyyy-MM-dd');
    $scope.update.tgl_lahir = $filter('date')($scope.update.tgl_lahir, 'yyyy-MM-dd');
    var req = {
      method: 'PUT',
      url: '/anggota/'+$scope.update.id_anggota,
      headers: {'Content-Type': 'application/json'},
      data: {
        update: $scope.update
      }
    }
    // Memanggil API Masuk
    $http(req).then(function(response) {
      $scope.lihat_anggota();
    }, function (argument) {
      $scope.lihat_anggota();
    });
  }
  // Hapus [FIX]
  $scope.hapus = function () {
    var req = {
      method: 'DELETE',
      url: '/anggota/'+$scope.delete.id_anggota,
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Delete
    $http(req).then(function(response) {
      $scope.lihat_anggota();
    }, function (argument) {
      $scope.lihat_anggota();
    });
  }
  // Fungsi Close [FIX]
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
    $scope.lihat_anggota();
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
              prompt : 'Nama Anggota tidak boleh kosong'
            }
          ]
        },
        tglg: {
          identifier: 'tglG',
          rules: [
            {
              type   : 'empty',
              prompt : 'Tanggal Gabung tidak boleh kosong'
            }
          ]
        },
        jk: {
          identifier: 'jk',
          rules: [
            {
              type   : 'empty',
              prompt : 'Jenis Kelamin tidak boleh kosong'
            }
          ]
        },
        nt: {
          identifier: 'nt',
          rules: [
            {
              type   : 'empty',
              prompt : 'Nomor Telephone tidak boleh kosong'
            },
            {
              type   : 'number',
              prompt : 'Nomor Telephone tidak valid'
            }
          ]
        },
        kota: {
          identifier: 'kota',
          rules: [
            {
              type   : 'empty',
              prompt : 'Kota tidak boleh kosong'
            }
          ]
        },
        tgll: {
          identifier: 'tgll',
          rules: [
            {
              type   : 'empty',
              prompt : 'Tanggal Lahir tidak boleh kosong'
            }
          ]
        },
        p: {
          identifier: 'p',
          rules: [
            {
              type   : 'empty',
              prompt : 'Pekerjaan tidak boleh kosong'
            }
          ]
        },
        al: {
          identifier: 'al',
          rules: [
            {
              type   : 'empty',
              prompt : 'Alamat tidak boleh kosong'
            }
          ]
        },
      },
      inline : true,
      on     : 'blur'
    })
  ;
});
