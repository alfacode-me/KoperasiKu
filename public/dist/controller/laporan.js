// Controller Beranda
koperasiku.controller('laporan', function ($scope, $http, $filter) {
  $scope.title = "Laporan";
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
  var req = {
    method: 'GET',
    url: '/jenis_simpanan/all',
    headers: {'Content-Type': 'application/json'},
    data: {
    }
  }
  // Memanggil API Data [FIX]
  $http(req).then(function(response) {
    $scope.jss = response.data;
  }, function () {
  console.log("SERVER ERROR");
  });
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
  var req = {
    method: 'POST',
    url: '/admin',
    headers: {'Content-Type': 'application/json'},
    data: {
      admin: "aktif"
    }
  }
  // Memanggil API Data [FIX]
  $http(req).then(function(response) {
    $scope.ad = response.data;
  }, function () {
    console.log("SERVER ERROR");
  });
  // Laporan
  $scope.lapo = function () {
    $scope.ak = $filter('filter')($scope.anggota, {id_anggota: $scope.aggt});
    $scope.sm = $filter('filter')($scope.smp, {id_anggota: $scope.aggt});
    $scope.pj = $filter('filter')($scope.pjn, {id_anggota: $scope.aggt});
    $scope.as = $filter('filter')($scope.ags, {id_anggota: $scope.aggt});
    $scope.tSM = 0;
    $scope.tPJ = 0;
    $scope.tAS = 0;
    $scope.tSIM = 0;
    $scope.tPIN = 0;
    $scope.tANG = 0;
    for (var i = 0; i < $scope.sm.length; i++) {
      $scope.tSM = $scope.tSM + $scope.sm[i].jml_simpanan;
    }
    for (var i = 0; i < $scope.pj.length; i++) {
      $scope.tPJ = $scope.tPJ + $scope.pj[i].jml_pinjaman;
    }
    for (var i = 0; i < $scope.as.length; i++) {
      $scope.tAS = $scope.tAS + $scope.as[i].jml_angsuran;
    }
    for (var i = 0; i < $scope.smp.length; i++) {
      $scope.tSIM = $scope.tSIM + $scope.smp[i].jml_simpanan;
    }
    for (var i = 0; i < $scope.pjn.length; i++) {
      $scope.tPIN = $scope.tPIN + $scope.pjn[i].jml_pinjaman;
    }
    for (var i = 0; i < $scope.ags.length; i++) {
      $scope.tANG = $scope.tANG + $scope.ags[i].jml_angsuran;
    }
  }
});
