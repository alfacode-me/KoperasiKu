// Controller Pinjaman
koperasiku.controller('pinjaman', function ($scope, $http, $filter) {
  $scope.title = "Pinjaman";
  // Refresh Data [FIX]
  $scope.lihat_pinjaman = function () {
    // Tabel Data [FIX]
    var req = {
      method: 'GET',
      url: '/pinjaman/all',
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Data [FIX]
    $http(req).then(function(response) {
      $scope.pjn = response.data;
    }, function () {
      console.log("SERVER ERROR");
    });
  };
  $scope.lihat_pinjaman();
  $scope.pinjaman = {};
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
    $scope.anggota = response.data;
  }, function () {
    console.log("SERVER ERROR");
  });
  // Tambah pinjaman [FIX]
  $scope.tambah_pinjaman = function () {
    var req = {
      method: 'POST',
      url: '/pinjaman',
      headers: {'Content-Type': 'application/json'},
      data: {
        pinjaman: $scope.pinjaman
      }
    }
    // Memanggil API Tambah
    $http(req).then(function(response) {
      $scope.psn = "SELAMAT";
      $scope.pesan = "Data Pinjaman telah tersimpan";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_pinjaman();
    }, function () {
      $scope.psn = "MOHON MAAF";
      $scope.pesan = "Terjadi kesalahan, silahkan cek kembali inputan anda.";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_pinjaman();
    });
  }
  // Tambah Simpanan [FIX]
  $scope.tambah_pinjaman = function () {
    $scope.pinjaman.tgl_pinjaman = $filter('date')($scope.pinjaman.tgl_pinjaman, 'yyyy-MM-dd');
    $scope.pinjaman.jml_pinjaman = (($scope.pinjaman.bunga_pinjaman/100)*$scope.pinjaman.pinjaman)*1+$scope.pinjaman.pinjaman*1;
    var req = {
      method: 'POST',
      url: '/pinjaman',
      headers: {'Content-Type': 'application/json'},
      data: {
        pinjaman: $scope.pinjaman
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
      $scope.lihat_pinjaman();
    }, function () {
      $scope.psn = "MOHON MAAF";
      $scope.pesan = "Terjadi kesalahan, silahkan cek kembali inputan anda.";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
    });
  }
  // Pilih [FIX]
  $scope.pilih = function (pj) {
    $scope.rincian   = pj;
    $scope.update    = pj;
    $scope.delete    = pj;
  }
  // Update [FIX]
  $scope.updated = function () {
      $scope.update.tgl_pinjaman = $filter('date')($scope.update.tgl_pinjaman, 'yyyy-MM-dd');
      $scope.update.jml_pinjaman = (($scope.update.bunga_pinjaman/100)*$scope.update.pinjaman)*1+$scope.update.pinjaman*1;
      var req = {
        method: 'PUT',
        url: '/pinjaman/'+$scope.update.id_pinjaman,
        headers: {'Content-Type': 'application/json'},
        data: {
          update: $scope.update
        }
      }
      // Memanggil API Masuk
      $http(req).then(function(response) {
        $scope.lihat_pinjaman();
      }, function () {
        $scope.lihat_pinjaman();
      });
  }
  // Hapus [FIX]
  $scope.hapus = function () {
    var req = {
      method: 'DELETE',
      url: '/pinjaman/'+$scope.delete.id_pinjaman,
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Delete
    $http(req).then(function(response) {
      $scope.lihat_pinjaman();
    }, function (argument) {
      $scope.lihat_pinjaman();
    });
  }
  // Fungsi Close [FIX]
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
    $scope.lihat_pinjaman();
  }
});


// Validasi Form [FIX]
$(function () {
  $('.ui.form')
  .form({
    fields: {
      pinjaman: {
        identifier: 'pinjaman',
        rules: [
          {
            type   : 'empty',
            prompt : 'Nama Anggota tidak boleh kosong'
          }
        ]
      },
      tglP: {
        identifier: 'tglP',
        rules: [
          {
            type   : 'empty',
            prompt : 'Tanggal Pinjaman tidak boleh kosong'
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
          }
        ]
      },
      jumlah: {
        identifier: 'jumlah',
        rules: [
          {
            type   : 'empty',
            prompt : 'Jumlah Pinjaman tidak boleh kosong'
          },
          {
            type   : 'number',
            prompt : 'Jumlah Pinjaman tidak valid'
          }
        ]
      }
    },
    inline : true,
    on     : 'blur'
  })
  ;
});
