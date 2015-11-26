// Controller Jenis Simpanan
koperasiku.controller('simpanan', function ($http, $scope, $filter) {
  // Variable [FIX]
  $scope.$parent.title = "Simpanan";
  // Refresh Data [FIX]
  $scope.lihat_simpanan = function () {
    // Tabel Data [FIX]
    var req = {
      method: 'GET',
      url: '/simpanan/all',
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Data [FIX]
    $http(req).then(function(response) {
      $scope.smp = response.data;
    }, function () {
      console.log("SERVER ERROR");
    });
  };
  $scope.lihat_simpanan();
  $scope.simpanan = {};
  // Anggota
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
  // Jenis Simpanan
  var req = {
    method: 'GET',
    url: '/jenis_simpanan/all',
    headers: {'Content-Type': 'application/json'},
    data: {
    }
  }
  // Memanggil API Data [FIX]
  $http(req).then(function(response) {
    $scope.jenis_simpanan = response.data;
  }, function () {
    console.log("SERVER ERROR");
  });
  // Tambah Simpanan [FIX]
  $scope.tambah_simpanan = function () {
    var req = {
      method: 'GET',
      url: '/jenis_simpanan/'+$scope.simpanan.id_jns_simpanan,
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Data [FIX]
    $http(req).then(function(response) {
      $scope.simpanan.tgl_simpanan = $filter('date')($scope.simpanan.tgl_simpanan, 'yyyy-MM-dd');
      $scope.jenis_bunga = response.data[0].bunga_simpanan;
      $scope.simpanan.bunga = ($scope.jenis_bunga / 100) * $scope.simpanan.simpanan;
      $scope.simpanan.jml_simpanan = $scope.simpanan.simpanan*1 + $scope.simpanan.bunga*1;
      var req = {
        method: 'POST',
        url: '/simpanan',
        headers: {'Content-Type': 'application/json'},
        data: {
          simpanan: $scope.simpanan
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
        $scope.lihat_simpanan();
      }, function () {
        $scope.psn = "MOHON MAAF";
        $scope.pesan = "Terjadi kesalahan, silahkan cek kembali inputan anda.";
        $(function () {
          $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
            $('#dimmer').removeClass('active').fadeOut(200);
            $('#pesan').addClass('active');
          });
        });
        $scope.lihat_simpanan();
      });
    }, function () {
      console.log("SERVER ERROR");
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
      method: 'GET',
      url: '/jenis_simpanan/'+$scope.update.id_jns_simpanan,
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Data [FIX]
    $http(req).then(function(response) {
      $scope.update.tgl_simpanan = $filter('date')($scope.update.tgl_simpanan, 'yyyy-MM-dd');
      $scope.jenis_bunga = response.data[0].bunga_simpanan;
      $scope.update.bunga = ($scope.jenis_bunga / 100) * $scope.update.simpanan;
      $scope.update.jml_simpanan = $scope.update.simpanan*1 + $scope.update.bunga*1;
      console.log($scope.update.jml_simpanan);
      var req = {
        method: 'PUT',
        url: '/simpanan/'+$scope.update.id_simpanan,
        headers: {'Content-Type': 'application/json'},
        data: {
          update: $scope.update
        }
      }
      // Memanggil API Masuk
      $http(req).then(function(response) {
        $scope.lihat_simpanan();
      }, function () {
        $scope.lihat_simpanan();
      });
    }, function () {
      console.log("Error");
    });
  }
  // Hapus [FIX]
  $scope.hapus = function () {
    var req = {
      method: 'DELETE',
      url: '/simpanan/'+$scope.delete.id_simpanan,
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Delete
    $http(req).then(function(response) {
      $scope.lihat_simpanan();
    }, function (argument) {
      $scope.lihat_simpanan();
    });
  }
  // Fungsi Close [FIX]
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
    $scope.lihat_simpanan();
  }
});
// Validasi Form [FIX]
$(function () {
  $('.ui.form')
  .form({
    fields: {
      nama_simpanan: {
        identifier: 'nama_simpanan',
        rules: [
          {
            type   : 'empty',
            prompt : 'Nama Anggota tidak boleh kosong'
          }
        ]
      },
      jns: {
        identifier: 'jns',
        rules: [
          {
            type   : 'empty',
            prompt : 'Jenis Simpanan tidak boleh kosong'
          }
        ]
      },
      tglS: {
        identifier: 'tglS',
        rules: [
          {
            type   : 'empty',
            prompt : 'Tanggal Simpanan tidak boleh kosong'
          }
        ]
      },
      sim: {
        identifier: 'sim',
        rules: [
          {
            type   : 'empty',
            prompt : 'Simpanan tidak boleh kosong'
          },
          {
            type   : 'number',
            prompt : 'Simpanan tidak valid'
          }
        ]
      }
    },
    inline : true,
    on     : 'blur'
  })
  ;
});
