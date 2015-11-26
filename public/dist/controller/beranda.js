// Controller Beranda
koperasiku.controller('beranda', function ($scope, $http, $filter) {
  $scope.title = "Beranda";
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
});
