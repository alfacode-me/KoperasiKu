// Controller Angsuran
koperasiku.controller('angsuran', function ($scope, $http, $filter) {
  $scope.title = "Angsuran";
  $scope.lihat_angsuran = function () {
    var req = {
      method: 'GET',
      url: '/angsuran/all',
      headers: {'Content-Type': 'application/json'},
      data: {
      }
    }
    $http(req).then(function(response) {
      $scope.ags = response.data;
    }, function () {
      console.log("SERVER ERROR");
    });
  };
  $scope.lihat_angsuran();
  $scope.angsuran = {};
  var req = {
    method: 'GET',
    url: '/anggota/all',
    headers: {'Content-Type': 'application/json'},
    data: {
    }
  }
  $http(req).then(function(response) {
    $scope.anggota = response.data;
  }, function () {
  console.log("SERVER ERROR");
  });
  var req = {
    method: 'GET',
    url: '/pinjaman/all',
    headers: {'Content-Type': 'application/json'},
    data: {
    }
  }
  $http(req).then(function(response) {
    $scope.pinjaman = response.data;
  }, function () {
    console.log("SERVER ERROR");
  });
  $scope.tambah_angsuran = function () {
    var req = {
      method: 'POST',
      url: '/angsuran',
      headers: {'Content-Type': 'application/json'},
      data: {
        angsuran: $scope.angsuran
      }
    }
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
  $scope.pilih = function (ag) {
    $scope.rincian   = ag;
    $scope.update    = ag;
    $scope.delete    = ag;
  }
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
      $http(req).then(function(response) {
        $scope.lihat_angsuran();
      }, function () {
        $scope.lihat_angsuran();
      });
  }
  $scope.hapus = function () {
    var req = {
      method: 'DELETE',
      url: '/angsuran/'+$scope.delete.id_angsuran,
      headers: {'Content-Type': 'application/json'},
      data: {
          delete: $scope.delete
      }
    }
    $http(req).then(function(response) {
      $scope.lihat_angsuran();
    }, function (argument) {
      $scope.lihat_angsuran();
    });
  }
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
    $scope.lihat_angsuran();
  }
  $scope.pilihagt = function (id) {
    if (id) {
      $scope.pjn   = $filter('filter')($scope.pinjaman, {id_anggota: id});
      $scope.sis = "";
    }
    $scope.sis = "";
  }
  $scope.sisa = function (id) {
    if (id) {
      $scope.pj   = $filter('filter')($scope.pinjaman, {id_pinjaman: id});
      $scope.sis = $scope.pj[0].jml_pinjaman - $scope.pj[0].jml_cicilan - $scope.angsuran.jml_angsuran;
    }
  }
});

$(function () {
  $('.ui.form')
  .form({
    fields: {
      agt: {
        identifier: 'agt',
        rules: [
          {
            type   : 'empty',
            prompt : 'Nama Anggota tidak boleh kosong'
          }
        ]
      },
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
