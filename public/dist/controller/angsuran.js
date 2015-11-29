// Controller Angsuran
koperasiku.controller('angsuran', function ($scope, $http, $filter) {
  $scope.title = "Angsuran";
  // Refresh Data [FIX]
  $scope.lihat_angsuran = function () {
    // Tabel Data [FIX]
    var req = {
      method: 'GET',
      url: '/angsuran/all',
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    // Memanggil API Data [FIX]
    $http(req).then(function(response) {
      $scope.ags = response.data;
    }, function () {
      console.log("SERVER ERROR");
    });
  };
  $scope.lihat_angsuran();
  $scope.angsuran = {};
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
    $scope.pinjaman = response.data;
  }, function () {
    console.log("SERVER ERROR");
  });
  // Tambah pinjaman [FIX]
  $scope.tambah_angsuran = function () {
    var req = {
      method: 'POST',
      url: '/angsuran',
      headers: {'Content-Type': 'application/json'},
      data: {
        angsuran: $scope.angsuran
      }
    }
    // Memanggil API Tambah
    $http(req).then(function(response) {
      $scope.psn = "SELAMAT";
      $scope.pesan = "Data Angsuran telah tersimpan";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_angsuran();
    }, function () {
      $scope.psn = "MOHON MAAF";
      $scope.pesan = "Terjadi kesalahan, silahkan cek kembali inputan anda.";
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      });
      $scope.lihat_angsuran();
    });
  }
  // Pilih [FIX]
  $scope.pilih = function (ag) {
    $scope.rincian   = ag;
    $scope.update    = ag;
    $scope.delete    = ag;
  }
  // Update [FIX]
  $scope.updated = function () {
      $scope.update.tgl_angsuran = $filter('date')($scope.update.tgl_angsuran, 'yyyy-MM-dd');
      var req = {
        method: 'PUT',
        url: '/angsuran/'+$scope.update.id_angsuran,
        headers: {'Content-Type': 'application/json'},
        data: {
          update: $scope.update
        }
      }
      // Memanggil API Masuk
      $http(req).then(function(response) {
        $scope.lihat_angsuran();
      }, function () {
        $scope.lihat_angsuran();
      });
  }
  // Hapus [FIX]
  $scope.hapus = function () {
    var req = {
      method: 'DELETE',
      url: '/angsuran/'+$scope.delete.id_angsuran,
      headers: {'Content-Type': 'application/json'},
      data: {
          delete: $scope.delete
      }
    }
    // Memanggil API Delete
    $http(req).then(function(response) {
      $scope.lihat_angsuran();
    }, function (argument) {
      $scope.lihat_angsuran();
    });
  }
  // Fungsi Close [FIX]
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
    $scope.lihat_angsuran();
  }
});


// Validasi Form [FIX]
$(function () {
  $('.ui.form')
  .form({
    fields: {
      pjn: {
        identifier: 'pjn',
        rules: [
          {
            type   : 'empty',
            prompt : 'ID Pinjaman tidak boleh kosong'
          }
        ]
      },
      tglA: {
        identifier: 'tglA',
        rules: [
          {
            type   : 'empty',
            prompt : 'Tanggal Angsuran tidak boleh kosong'
          }
        ]
      },
      ang: {
        identifier: 'ang',
        rules: [
          {
            type   : 'empty',
            prompt : 'Jumlah Angsuran tidak boleh kosong'
          }
        ]
      }
    },
    inline : true,
    on     : 'blur'
  })
  ;
});
