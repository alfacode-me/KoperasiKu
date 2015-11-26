// Controller Head
koperasiku.controller('main', function ($scope) {
  $scope.title = "Beranda";
  $scope.refresh = function () {
    location.reload();
    console.log("REFRESH");
  }
});
// Controller Beranda
koperasiku.controller('beranda', function ($scope) {
  $scope.$parent.title = "Beranda";
  //
});
// Controller Simpanan
koperasiku.controller('simpanan', function ($http, $scope) {
  $scope.$parent.title = "Simpanan";
  // Tabel Data [FIX]
  var req = {
    method: 'GET',
    url: '/api/simpanan/anggota',
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
  // Tabel Data [FIX]
  var req = {
    method: 'GET',
    url: '/api/simpanan/master_simpanan',
    headers: {'Content-Type': 'application/json'},
    data: {
    }
  }
  // Memanggil API Data [FIX]
  $http(req).then(function(response) {
    $scope.master_simpanan = response.data;
  }, function () {
  console.log("SERVER ERROR");
  });
});

// Controller Pinjaman
koperasiku.controller('pinjaman', function ($scope) {
  // Variable
  $scope.$parent.title = "Pinjaman";
  $scope.psn = "SELAMAT";
  $scope.pesan = "Data Anggota telah tersimpan";
  // $scope.lihat_anggota = function () {
    // Tabel anggota
  //   var req = {
  //     method: 'GET',
  //     url: '/api/anggota/all',
  //     headers: {'Content-Type': 'application/json'},
  //     data: {
  //     }
  //   }
  //   // Memanggil API Masuk
  //   $http(req).then(function(response) {
  //     $scope.ak = response.data;
  //     console.log("OK");
  //   }, function () {
  //   console.log("SERVER ERROR");
  //   });
  // };
  // $scope.lihat_anggota();
  $scope.pinjaman = {};
  // Validasi Form
  $(function () {
    // $('.ui.basic.modal').modal('attach events','#hapus','show');
    $('.ui.form')
      .form({
        fields: {
          nmak: {
            identifier: 'nm-ak',
            rules: [
              {
                type   : 'empty',
                prompt : 'Nama Anggota tidak boleh kosong'
              }
            ]
          },
          tglp: {
            identifier: 'tgl-p',
            rules: [
              {
                type   : 'empty',
                prompt : 'Tanggal Pinjaman tidak boleh kosong'
              }
            ]
          },
          jp: {
            identifier: 'jp',
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
  // Tambah Anggota
  $scope.tambah_anggota = function () {
    var req = {
      method: 'POST',
      url: '/api/pinjaman',
      headers: {'Content-Type': 'application/json'},
      data: {
        pinjaman: $scope.pinjaman
      }
    }
    // Memanggil API Masuk
    $http(req).then(function(response) {
      console.log("OK");
      $(function () {
        $('#dimmer').addClass('active').delay(1500).fadeIn(1000, function () {
          $('#dimmer').removeClass('active').fadeOut(200);
          $('#pesan').addClass('active');
        });
      })
    }, function () {
      console.log("FAIL");
    });
  }
  // Hapus
  $scope.hapus = function (id) {
    console.log(id);
  }
  // Fungsi Close
  $scope.tutup = function () {
    $(function () {
      $('#pesan').removeClass('active');
    })
    // $scope.lihat_anggota();
  }
});
// Controller Angsuran
koperasiku.controller('angsuran', function ($scope) {
  $scope.$parent.title = "Angsuran";
});
// Controller Anggota
koperasiku.controller('anggota', function ($http, $route, $scope, $filter) {
  // Variable [FIX]
  $scope.$parent.title = "Anggota";
  // Refresh Data [FIX]
  $scope.lihat_anggota = function () {
    // Tabel [FIX]
    var req = {
      method: 'GET',
      url: '/api/anggota/all',
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
  // Validasi Form Tambah [FIX]
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
                prompt : 'Nama Anggota tidak boleh kosong'
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
  // Tambah [FIX]
  $scope.tambah_anggota = function () {
    $scope.anggota.tglg = $filter('date')($scope.anggota.tglg, 'yyyy-MM-dd');
    $scope.anggota.tgll = $filter('date')($scope.anggota.tgll, 'yyyy-MM-dd');
    var req = {
      method: 'POST',
      url: '/api/anggota',
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
    $scope.update_ak     = ag;
    $scope.del_ak        = ag;
    $scope.rincian_ak    = ag;
  }
  // Update [FIX]
  $scope.updated = function () {
    $scope.update_ak.tgl_gabung = $filter('date')($scope.update_ak.tgl_gabung, 'yyyy-MM-dd');
    $scope.update_ak.tgl_lahir = $filter('date')($scope.update_ak.tgl_lahir, 'yyyy-MM-dd');
    var req = {
      method: 'PUT',
      url: '/api/anggota/'+$scope.update_ak.id_anggota,
      headers: {'Content-Type': 'application/json'},
      data: {
        update: $scope.update_ak
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
      url: '/api/anggota/'+$scope.del_ak.id_anggota,
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
// Controller Laporan
koperasiku.controller('laporan', function ($scope) {
  $scope.$parent.title = "Laporan";
});
