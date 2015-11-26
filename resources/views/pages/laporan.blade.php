<!-- Main App KoperasiKu -->
<html ng-app="koperasiku" ng-controller="laporan">
<!-- Head [FIX]-->
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="@{{ csrf_token() }}">
  <title>KoperasiKu | @{{title}}</title>
  <link rel="stylesheet" href="/semantic/semantic.css" media="print, screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/dist/koperasi.css" media="print, screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="/dist/css/beranda.css" media="print, screen" title="no title" charset="utf-8">
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
        <a ng-click="refresh()" ng-href="/" class="item">
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
        <a ng-click="refresh()" ng-href="/laporan" class="active item">
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
        <div class="ui raised segments">
          <div class="ui green inverted segment">
            <h4>Membuat Laporan</h4>
          </div>
          <div class="ui segment">
            <div class="ui form">
              <div class="inline fields">
                <div class="six wide field">
                  <label>Jenis Laporan</label>
                  <select name="jk" ng-model="lap" dropdown class="ui dropdown">
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="anggota">Laporan Anggota</option>
                    <option value="simpanan">Laporan Simpanan</option>
                    <option value="pinjaman">Laporan Pinjaman</option>
                    <option value="angsuran">Laporan Angsuran</option>
                  </select>
                </div>
                <div class="seven wide field">
                  <div ng-if="lap == 'anggota'">
                  <label>Nama Anggota</label>
                  <select name="jk" ng-model="aggt" dropdown class="ui dropdown">
                    <option value="">Pilih Nama Anggota</option>
                    <option ng-repeat="agt in anggota | orderBy:'nama':false" value="@{{agt.id_anggota}}">@{{agt.nama}}</option>
                  </select>
                  </div>
                </div>
                <div class="three wide field">
                    <button ng-click="lapo()" class="ui right floated green labeled icon button">
                      <i class="book icon"></i>
                      Buat Laporan
                    </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div ng-if="lap == 'anggota'" id="laporan" class="ui secondary raised segment">
          <h1 style="text-align:center" class="ui header">K O P E R A S I K U</h1>
          <div class="ui clearing divider"></div>
          <div class="ui form">
            <div style="float:right"><div id="tanggal"></div></div>
            <div class="ui grid">
              <span class="three wide column kpr">
                Perihal
                <br>ID Admin
                <br>Administrator
              </span>
              <span class="thirteen wide column kpr">
                : Laporan Anggota
                <br>: @{{ad[0].id_admin}}
                <br>: @{{ad[0].nama_admin}}
              </span>
            </div>
            <div class="ui grid">
              <span class="three wide column kpr">
                <b>Kepada</b>
                <br>ID Anggota
                <br>Anggota
              </span>
              <span class="thirteen wide column kpr">

                <br>: @{{ak[0].id_anggota}}
                <br>: @{{ak[0].nama}}
              </span>
            </div>
            <br>
            <b>Informasi Anggota</b>
            <div class="ui grid">
              <span class="three wide column kpr">
                Tanggal Gabung
                <br>No. Telp
                <br>Tanggal Lahir
                <br>Jenis Kelamin
              </span>
              <span class="five wide column kpr">
                : @{{ak[0].tgl_gabung | date: 'dd-MMM-yyyy'}}
                <br>: @{{ak[0].telp}}
                <br>: @{{ak[0].tgl_lahir | date: 'dd-MMM-yyyy'}}
                <br>: @{{ak[0].jenis_kelamin}}
              </span>
              <span class="three wide column kpr">
                Pekerjaan
                <br>Kota
                <br>Alamat Lengkap
              </span>
              <span class="five wide column kpr">
                : @{{ak[0].pekerjaan}}
                <br>: @{{ak[0].kota}}
                <br>: @{{ak[0].alamat}}
              </span>
            </div>
          </div>
          <br>
          <b>Informasi Transaksi</b>
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Jenis Transaksi</th>
                <th>Jumlah Transaksi</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Simpanan</td>
                <td>@{{sm.length}}</td>
                <td>Rp @{{tSM}}</td>
              </tr>
              <tr>
                <td>Pinjaman</td>
                <td>@{{pj.length}}</td>
                <td>Rp @{{tPJ}}</td>
              </tr>
              <tr>
                <td>Angsuran</td>
                <td>@{{as.length}}</td>
                <td>Rp @{{tAS}}</td>
              </tr>
            </tbody>
          </table>
          <b>Riwayat Transaksi Simpanan</b>
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>ID Simpanan</th>
                <th>Jenis Simpanan</th>
                <th>Simpanan</th>
                <th>Bunga</th>
                <th>Jumlah Simpanan</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="s in sm | orderBy:'tgl_simpanan':true">
                <td>@{{s.tgl_simpanan | date: 'dd-MMM-yyyy'}}</td>
                <td>@{{s.id_simpanan}}</td>
                <td>@{{s.jns_simpanan}}</td>
                <td>Rp @{{s.simpanan}}</td>
                <td>Rp @{{s.bunga}}</td>
                <td>Rp @{{s.jml_simpanan}}</td>
              </tr>
            </tbody>
          </table>
          <b>Riwayat Transaksi Pinjaman</b>
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>ID Pinjaman</th>
                <th>Jumlah Pinjaman</th>
                <th>Jumlah Angsuran</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="j in pj | orderBy:'tgl_pinjaman':true">
                <td>@{{j.tgl_pinjaman | date: 'dd-MMM-yyyy'}}</td>
                <td>@{{j.id_pinjaman}}</td>
                <td>Rp @{{j.jml_pinjaman}}</td>
                <td>Rp @{{j.jml_cicilan}}</td>
                <td>@{{j.status}}</td>
              </tr>
            </tbody>
          </table>
          <b>Riwayat Transaksi Angsuran</b>
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>ID Angsuran</th>
                <th>ID Pinjaman</th>
                <th>Jumlah Angsuran</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="a in as | orderBy:'tgl_angsuran':true">
                <td>@{{a.tgl_angsuran | date: 'dd-MMM-yyyy'}}</td>
                <td>@{{a.id_angsuran}}</td>
                <td>Rp @{{a.id_pinjaman}}</td>
                <td>Rp @{{a.jml_angsuran}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div ng-if="lap == 'simpanan'" id="laporan" class="ui secondary raised segment">
          <h1 style="text-align:center" class="ui header">K O P E R A S I K U</h1>
          <div class="ui clearing divider"></div>
          <div class="ui form">
            <div style="float:right"><div id="tanggal"></div></div>
            <div class="ui grid">
              <span class="three wide column kpr">
                Perihal
                <br>ID Admin
                <br>Administrator
              </span>
              <span class="thirteen wide column kpr">
                : Laporan Simpanan
                <br>: @{{ad[0].id_admin}}
                <br>: @{{ad[0].nama_admin}}
              </span>
            </div>
            <div class="ui grid">
              <span class="five wide column kpr">
                <b>Kepada</b>
                <br>Yth. Pimpinan Koperasi
                <br><b>Mohammad Hatta</b>
              </span>
              <span class="thirteen wide column kpr">
              </span>
            </div>
          </div>
          <div style="float: right">
            <b>Total Simpanan</b><br><h3>Rp @{{tSIM}}</h3>
          </div>
          <br><br>
          <b>Riwayat Transaksi Simpanan</b>
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>ID Simpanan</th>
                <th>Nama Anggota</th>
                <th>Jenis Simpanan</th>
                <th>Jumlah Simpanan</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="s in smp | orderBy:'tgl_simpanan':true">
                <td>@{{s.tgl_simpanan | date: 'dd-MMM-yyyy'}}</td>
                <td>@{{s.id_simpanan}}</td>
                <td>@{{s.nama}}</td>
                <td>@{{s.jns_simpanan}}</td>
                <td>Rp @{{s.jml_simpanan}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div ng-if="lap == 'pinjaman'" id="laporan" class="ui secondary raised segment">
          <h1 style="text-align:center" class="ui header">K O P E R A S I K U</h1>
          <div class="ui clearing divider"></div>
          <div class="ui form">
            <div style="float:right"><div id="tanggal"></div></div>
            <div class="ui grid">
              <span class="three wide column kpr">
                Perihal
                <br>ID Admin
                <br>Administrator
              </span>
              <span class="thirteen wide column kpr">
                : Laporan Pinjaman
                <br>: @{{ad[0].id_admin}}
                <br>: @{{ad[0].nama_admin}}
              </span>
            </div>
            <div class="ui grid">
              <span class="five wide column kpr">
                <b>Kepada</b>
                <br>Yth. Pimpinan Koperasi
                <br><b>Mohammad Hatta</b>
              </span>
              <span class="thirteen wide column kpr">
              </span>
            </div>
          </div>
          <div style="float: right">
            <b>Total Pinjaman</b><br><h3>Rp @{{tPIN}}</h3>
          </div>
          <br><br>
          <b>Riwayat Transaksi Pinjaman</b>
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>ID Pinjaman</th>
                <th>Nama Anggota</th>
                <th>Jumlah Pinjaman</th>
                <th>Jumlah Angsuran</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="s in pjn | orderBy:'tgl_pinjaman':true">
                <td>@{{s.tgl_pinjaman | date: 'dd-MMM-yyyy'}}</td>
                <td>@{{s.id_pinjaman}}</td>
                <td>@{{s.nama}}</td>
                <td>Rp @{{s.jml_pinjaman}}</td>
                <td>Rp @{{s.jml_cicilan}}</td>
                <td>@{{s.status}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div ng-if="lap == 'angsuran'" id="laporan" class="ui secondary raised segment">
          <h1 style="text-align:center" class="ui header">K O P E R A S I K U</h1>
          <div class="ui clearing divider"></div>
          <div class="ui form">
            <div style="float:right"><div id="tanggal"></div></div>
            <div class="ui grid">
              <span class="three wide column kpr">
                Perihal
                <br>ID Admin
                <br>Administrator
              </span>
              <span class="thirteen wide column kpr">
                : Laporan Angsuran
                <br>: @{{ad[0].id_admin}}
                <br>: @{{ad[0].nama_admin}}
              </span>
            </div>
            <div class="ui grid">
              <span class="five wide column kpr">
                <b>Kepada</b>
                <br>Yth. Pimpinan Koperasi
                <br><b>Mohammad Hatta</b>
              </span>
              <span class="thirteen wide column kpr">
              </span>
            </div>
          </div>
          <div style="float: right">
            <b>Total Angsuran</b><br><h3>Rp @{{tANG}}</h3>
          </div>
          <br><br>
          <b>Riwayat Transaksi Angsuran</b>
          <table class="ui very basic table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>ID Angsuran</th>
                <th>Nama Anggota</th>
                <th>ID Pinjaman</th>
                <th>Jumlah Angsuran</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="s in ags | orderBy:'tgl_angsuran':true">
                <td>@{{s.tgl_angsuran | date: 'dd-MMM-yyyy'}}</td>
                <td>@{{s.id_angsuran}}</td>
                <td>@{{s.nama}}</td>
                <td>@{{s.id_pinjaman}}</td>
                <td>Rp @{{s.jml_angsuran}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <button ng-if="lap" onclick="printDiv('laporan')" class="ui right floated violet labeled icon button">
          <i class="print icon"></i>
          Cetak
        </button>
        <br><br>
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
<script src="/dist/controller/laporan.js" charset="utf-8"></script>

</html>
