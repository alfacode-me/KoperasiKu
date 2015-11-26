<!-- Main App KoperasiKu -->
<html ng-app="koperasiku" ng-controller="beranda">
<!-- Head [FIX]-->
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="@{{ csrf_token() }}">
  <title>KoperasiKu | @{{title}}</title>
  <link rel="stylesheet" href="/semantic/semantic.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/dist/koperasi.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/dist/css/beranda.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
  <div class="ui container">
    <div class="ui segments title">
      <!-- Header [FIX] -->
      <div class="ui center aligned segment">
        <h1 class="ui violet header koperasi">K o p e r a s i K u</h1>
      </div>
      <!-- MenuBar [FIX] -->
      <div class="ui top attached inverted violet menu kpr-menu">
        <a ng-click="refresh()" ng-href="/" class="active item">
          <i class="home icon"></i> BERANDA
        </a>
        <a ng-click="refresh()" ng-href="/simpanan" class="item">
          <i class="dollar icon"></i> SIMPANAN
        </a>
        <a ng-click="refresh()" ng-href="/pinjaman" class="item">
          <i class="money icon"></i> PINJAMAN
        </a>
        <a ng-click="refresh()" ng-href="/angsuran" class="item">
          <i class="ticket icon"></i> ANGSURAN
        </a>
        <a ng-click="refresh()" ng-href="/jenis_simpanan" class="item">
          <i class="tags icon"></i> JENIS SIMPANAN
        </a>
        <a ng-click="refresh()" ng-href="/anggota" class="item">
          <i class="users icon"></i> ANGGOTA
        </a>
        <a ng-click="refresh()" ng-href="/laporan" class="item">
          <i class="file text icon"></i> LAPORAN
        </a>
        <div class="right menu">
          <div dropdown class="ui pointing dropdown item">
            <b>Hay, SuryaINetz</b><i class="dropdown icon"></i>
            <div class="menu kpr-dd">
              <a href="/keluar" class="item"><i class="sign out icon"></i> Keluar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Breadcrumb -->
      <div class="ui segment">
        <a class="ui violet large ribbon label"> <h4>@{{title}}</h4> </a>
        <div class="ui breadcrumb kpr-bc">
          <a href="#/" class="section">KoperasiKu</a>
          <i class="right chevron icon divider"></i>
          <div class="active section">@{{title}}</div>
        </div>
        <span class="kpr-time">
          <h4><span id="waktu"></span></h4>
        </span>
      </div>
      <!-- Halaman -->
      <div class="ui segment">
        <div class="ui five cards">
          <div class="card">
            <div class="content">
              <div class="header">Total @{{smp.length}} Data</div>
              <div class="description">
                <div class="kpr-icon"><i class="dollar violet icon"></i></div>
              </div>
            </div>
            <a href="/simpanan" class="ui bottom attached green button">
              <i class="add icon"></i>
              SIMPANAN
            </a>
          </div>
          <div class="card">
            <div class="content">
              <div class="header"> Total @{{pjn.length}} Data</div>
              <div class="description">
                <div class="kpr-icon"><i class="money violet icon"></i></div>
              </div>
            </div>
            <a href="/pinjaman" class="ui bottom attached green button">
              <i class="add icon"></i>
              PINJAMAN
            </a>
          </div>
          <div class="card">
            <div class="content">
              <div class="header">Total @{{ags.length}} Data</div>
              <div class="description">
                <div class="kpr-icon"><i class="ticket violet icon"></i></div>
              </div>
            </div>
            <a href="/angsuran" class="ui bottom attached green button">
              <i class="add icon"></i>
              ANGSURAN
            </a>
          </div>
          <div class="card">
            <div class="content">
              <div class="header">Total @{{jss.length}} Data</div>
              <div class="description">
                <div class="kpr-icon"><i class="tags violet icon"></i></div>
              </div>
            </div>
            <a href="/jenis_simpanan" class="ui bottom attached green button">
              <i class="add icon"></i>
              JENIS SIMPANAN
            </a>
          </div>
          <div class="card">
            <div class="content">
              <div class="header">Total @{{anggota.length}} Data</div>
              <div class="description">
                <div class="kpr-icon"><i class="users violet icon"></i></div>
              </div>
            </div>
            <a href="/anggota" class="ui bottom attached green button">
              <i class="add icon"></i>
              ANGGOTA
            </a>
          </div>
        </div>
        <div class="ui violet inverted center aligned segment">
          <h3 class="ui header">SELAMAT DATANG</h3>
          <p>Sekali lagi selamat datang di <b>KoperasiKu</b>, apa sih <b>KoperasiKu</b> itu ?. </p>
          <p><b>KoperasiKu</b> merupakan aplikasi web yang bertemakan Koperasi Simpan Pinjam yang memiliki design yang simpel, fresh dan modern serta memiliki fitur dan modul yang lengkap. <b>KoperasiKu</b> juga mengutamakan kepuasan terhadap User Experience selain User Interface yang menarik.</p>
          <p><b>KoperasiKu</b> dibangun menggunakan 4 bahasa pemrograman yaitu PHP, Javascript, HTML, dan CSS. Selain itu <b>KoperasiKu</b> juga dibangun menggunakan <b>Framework Laravel</b> yang berjalan disisi Server, dan <b>Framework AngularJS</b> yang berjalan disisi Client, serta <b>Framework SemanticUI</b> untuk design.</p>
          <p>Kelebihan lain dari <b>KoperasiKu</b> adalah selalu diperbarui jika ditemukan bug ataupun fitur maupun modul baru yang ingin ditambahkan melalui repository <b>Github</b>. Jadi silahkan berikan kritik maupun saran, ataupun jika ingin menyumbangkan kode untuk kemajuan <b>KoperasiKu</b> dapat disampaikan di repository <b>Github</b>. <h5>Terima Kasih</h5></p>
        </div>
        <div class="ui two column doubling stackable grid container">
          <div class="column">
            <div class="ui segments">
              <div class="ui green inverted segment">
                <h4>Anggota Terbaru</h4>
              </div>
              <div class="ui green secondary segment">
                <table class="ui very basic table">
                  <thead>
                    <tr>
                      <th>ID Anggota</th>
                      <th>Nama Anggota</th>
                      <th>Jenis Kelamin</th>
                      <th>Kota</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="agt in anggota | orderBy:'tgl_gabung':true | limitTo: 3">
                      <td>@{{agt.id_anggota}}</td>
                      <td>@{{agt.nama}}</td>
                      <td>@{{agt.jenis_kelamin}}</td>
                      <td>@{{agt.kota}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="ui segments">
              <div class="ui green inverted segment">
                <h4>Simpanan Terbaru</h4>
              </div>
              <div class="ui green secondary segment">
                <table class="ui very basic table">
                  <thead>
                    <tr>
                      <th>ID Simpanan</th>
                      <th>Nama Anggota</th>
                      <th>Jenis Simpanan</th>
                      <th>Jumlah Simpanan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="sm in smp | orderBy:'tgl_simpanan':true | limitTo: 3">
                      <td>@{{sm.id_simpanan}}</td>
                      <td>@{{sm.nama}}</td>
                      <td>@{{sm.jns_simpanan}}</td>
                      <td>Rp @{{sm.jml_simpanan}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="ui two column doubling stackable grid container">
          <div class="column">
            <div class="ui segments">
              <div class="ui violet inverted segment">
                <h4>Pinjaman Terbaru</h4>
              </div>
              <div class="ui violet secondary segment">
                <table class="ui very basic table">
                  <thead>
                    <tr>
                      <th>ID Pinjaman</th>
                      <th>Nama Anggota</th>
                      <th>Jumlah Pinjaman</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="pj in pjn | orderBy:'tgl_gabung':true | limitTo: 3">
                      <td>@{{pj.id_pinjaman}}</td>
                      <td>@{{pj.nama}}</td>
                      <td>Rp @{{pj.jml_pinjaman}}</td>
                      <td>@{{pj.status}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="ui segments">
              <div class="ui violet inverted segment">
                <h4>Angsuran Terbaru</h4>
              </div>
              <div class="ui violet secondary segment">
                <table class="ui very basic table">
                  <thead>
                    <tr>
                      <th>ID Angsuran</th>
                      <th>Nama Anggota</th>
                      <th>ID Pinjaman</th>
                      <th>Jumlah Angsuran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="ag in ags | orderBy:'tgl_angsuran':true | limitTo: 3">
                      <td>@{{ag.id_angsuran}}</td>
                      <td>@{{ag.nama}}</td>
                      <td>@{{ag.id_pinjaman}}</td>
                      <td>Rp @{{ag.jml_angsuran}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="ui secondary segment">
        <p>Copyright <i class="copyright icon"></i> 2015 by <b><a href="/">KoperasiKu</a></b><span style="float: right">Design & Coding by <b>SuryaINetz</b></span></p>
      </div>
    </div>
  </div>
</body>

<script src="/jquery/jquery-2.1.4.js" charset="utf-8"></script>
<script src="/semantic/semantic.js" charset="utf-8"></script>
<script src="/angular/angular.js" charset="utf-8"></script>
<script src="/dist/koperasi.js" charset="utf-8"></script>
<script src="/dist/script.js" charset="utf-8"></script>
<script src="/dist/directive.js" charset="utf-8"></script>
<script src="/dist/controller/beranda.js" charset="utf-8"></script>

</html>
