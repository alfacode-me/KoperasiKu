koperasiku.directive('dropdown', function() {
  var linker = function (scope, element, attrs) {
    $(function () {
      $(element).dropdown();
    })
  }
  return {
    link: linker
  }
});
koperasiku.directive('modalrinci', function() {
  var linker = function (scope, element, attrs) {
    $(function () {
      $(element).click(function () {
        $('#rinci').modal('setting', 'closable', false).modal({blurring: true}).modal('show');
      })
    })
  }
  return {
    link: linker
  }
});
koperasiku.directive('modalubah', function() {
  var linker = function (scope, element, attrs) {
    $(function () {
      $(element).click(function () {
        $('#ubah').modal('setting', 'closable', false).modal({blurring: true}).modal('show');
      })
    })
  }
  return {
    link: linker
  }
});
koperasiku.directive('modalhapus', function() {
  var linker = function (scope, element, attrs) {
    $(function () {
      $(element).click(function () {
        $('#hapus').modal('setting', 'closable', false).modal({blurring: true}).modal('show');
      })
    })
  }
  return {
    link: linker
  }
});
