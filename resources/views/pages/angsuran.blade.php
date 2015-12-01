<!-- Main App KoperasiKu -->
<html ng-app="koperasiku" ng-controller="angsuran">
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
        <a ng-click="refresh()" ng-href="/" class="item">
          <i class="home icon"></i> BERANDA
        </a>
        <a ng-click="refresh()" ng-href="/simpanan" class="item">
          <i class="dollar icon"></i> SIMPANAN
        </a>
        <a ng-click="refresh()" ng-href="/pinjaman" class="item">
          <i class="money icon"></i> PINJAMAN
        </a>
        <a ng-click="refresh()" ng-href="/angsuran" class="active item">
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
              <a class="item"><i class="sign out icon"></i> Keluar</a>
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
        <!-- Form Angsuran [FIX] -->
        <h4 class="ui violet top attached header">
          Form Angsuran
        </h4>
        <div class="ui attached segment">
          <!-- Loading [FIX] -->
          <div id="dimmer" class="ui blurring dimmer">
            <div class="content">
              <div class="ui text loader"></div>
            </div>
          </div>
          <!-- Pesan [FIX] -->
          <div id="pesan" class="ui blurring dimmer">
            <h3 class="ui grey inverted center aligned icon header">
              @{{psn}}
              <br>
              <small>@{{pesan}}</small><br><br>
              <a ng-hide="ok" ng-show="gagal" ng-click="tutup()" class="ui inverted yellow basic button"> OK </a>
            </h3>
          </div>
          <!-- Form Tambah [FIX] -->
          <div class="ui form">
            <div class="four fields">
              <div class="field">
                <label>Nama Anggota</label>
                <select ng-selected="pilihagt(angsuran.id_anggota)" name="agt" ng-model="angsuran.id_anggota" dropdown class="ui dropdown">
                  <option value="">Pilih Nama Anggota</option>
                  <option ng-repeat="aggt in anggota" value="@{{aggt.id_anggota}}">@{{aggt.nama}}</option>
                </select>
              </div>
              <div class="field">
                <label>ID Pinjaman</label>
                <select ng-selected="sisa(angsuran.id_pinjaman)" name="pjn" ng-model="angsuran.id_pinjaman" dropdown class="ui dropdown">
                  <option value="">Pilih ID Pinjaman</option>
                  <option ng-repeat="pj in pjn" value="@{{pj.id_pinjaman}}">@{{pj.id_pinjaman}}</option>
                </select>
              </div>
              <div class="field">
                <label>Tanggal Angsuran</label>
                <input name="tglA" ng-model="angsuran.tgl_angsuran" type="date">
              </div>
              <div class="field">
                <label ng-init="angsuran.jml_angsuran=0">Jumlah Angsuran</label>
                <input class="ui input kpr" name="ang" ng-model="angsuran.jml_angsuran" type="text">
              </div>
              <div class="field">

              </div>
            </div>
            <div class="four fields">
              <div class="field">
                <label>Sisa Pinjaman</label>
                <h3>Rp @{{sis}}</h3>
              </div>
              <div class="field">
              </div>
              <div class="field">
              </div>
              <div class="field">
                <div class="ui right floated buttons">
                  <button  class="ui reset button"> Reset </button>
                  <div class="or" data-text="A"></div>
                  <div ng-click="tambah_angsuran()" class="ui animated fade right floated violet submit button" tabindex="0">
                    <div class="visible content"> Tambah </div>
                    <div class="hidden content">
                      Simpan
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4 class="ui violet attached header">
          Data Angsuran
        </h4>
        <!-- Form Update [FIX]-->
        <div id="ubah" class="ui large modal">
          <div class="header">
            Mengubah Data Angsuran @{{update.id_angsuran}}
          </div>
          <div class="content">
            <div class="ui form">
              <div class="four fields">
                <div class="field">
                  <label>ID Pinjaman</label>
                  <select name="pjn" ng-model="update.id_pinjaman" dropdown class="ui dropdown">
                    <option value="@{{update.id_pinjaman}}">Pilih ID Pinjaman</option>
                    <option ng-repeat="pj in pinjaman" value="@{{pj.id_pinjaman}}">@{{pj.id_pinjaman}}</option>
                  </select>
                </div>
                <div class="field">
                  <label>Tanggal Angsuran</label>
                  <input name="tglA" value="@{{update.tgl_angsuran}}" ng-model="update.tgl_angsuran" type="date">
                </div>
                <div class="field">
                  <label>Jumlah Angsuran</label>
                  <input class="ui input kpr" name="ang" ng-model="update.jml_angsuran" type="text">
                </div>
                <div class="field">
                </div>
              </div>
            </div>
          </div>
          <div class="actions">
            <div class="two fluid ui buttons">
              <div class="ui negatif deny button">
                <i class="remove icon"></i>
                Batal
              </div>
              <div ng-click="updated()" class="ui primary deny button">
                <i class="checkmark icon"></i>
                Ubah
              </div>
            </div>
          </div>
        </div>
        <!-- Form Rincian [FIX] -->
        <div id="rinci" class="ui basic modal">
          <i class="close icon"></i>
          <div class="header">
            Rincian Data Angsuran @{{rincian.id_angsuran}}
          </div>
          <div class="image content">
            <div class="image">
              <i class="File Text Outline icon"></i>
            </div>
            <div class="description">
              <div class="ui form">
                <div class="fields">
                  <div class="field">
                    <h4>ID Angsuran</h4>
                    <h4>Nama Anggota</h4>
                    <h4>Nama Administrator</h4>
                    <h4>ID Pinjaman</h4>
                    <h4>Tanggal Angsuran</h4>
                    <h4>Jumlah Angsuran</h4>
                    <h4>Terakhir di Update</h4>
                  </div>
                  <div class="field">
                    <h4>: @{{rincian.id_angsuran}}</h4>
                    <h4>: @{{rincian.nama}}</h4>
                    <h4>: @{{rincian.nama_admin}}</h4>
                    <h4>: @{{rincian.id_pinjaman}}</h4>
                    <h4>: @{{rincian.tgl_angsuran}}</h4>
                    <h4>: Rp @{{rincian.jml_angsuran}}</h4>
                    <h4>: @{{rincian.created_at}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Form Hapus [FIX] -->
        <div id="hapus" class="ui basic modal">
          <i class="close icon"></i>
          <div class="header">
            Menghapus Data Angsuran @{{delete.id_angsuran}}
          </div>
          <div class="image content">
            <div class="image">
              <i class="trash icon"></i>
            </div>
            <div class="description">
              <p>Apakah Anda yakin akan menghapus data angsuran <b>@{{delete.id_angsuran}}</b> ?</p>
              <p>NB: Data anggota yang telah anda hapus tidak dapat dikembalikan.</p>
            </div>
          </div>
          <div class="actions">
            <div class="two fluid ui inverted buttons">
              <div class="ui red basic inverted deny button">
                <i class="remove icon"></i>
                Tidak
              </div>
              <div ng-click="hapus()" class="ui orange basic inverted deny button">
                <i class="checkmark icon"></i>
                Ya
              </div>
            </div>
          </div>
        </div>
        <div class="ui attached segment">
          <div class="ui form">
            <div class="inline fields">
              <!-- Form Jumlah Baris [FIX] -->
              <div class="six wide field">
                <select ng-model="dtmax" dropdown placeholder="ffd" class="ui small dropdown">
                  <option value="">Jumlah data per halaman</option>
                  <option value="5">5 Data</option>
                  <option value="10">10 Data</option>
                  <option value="20">20 Data</option>
                  <option value="30">30 Data</option>
                  <option value="50">50 Data</option>
                  <option value="75">75 Data</option>
                  <option value="100">100 Data</option>
                  <option value="150">150 Data</option>
                  <option value="200">200 Data</option>
                </select>
              </div>
              <!-- Form Urutkan [FIX] -->
              <div class="eight wide field">
                <div class="ui group input">
                  <select ng-model="order" dropdown class="ui small dropdown">
                    <option value="">Urut berdasarkan</option>
                    <option value="created_at">Terakhir di Ubah</option>
                    <option value="id_angsuran">Id Angsuran</option>
                    <option value="nama">Nama Anggota</option>
                    <option value="nama_admin">Nama Admin</option>
                    <option value="tgl_angsuran">Tanggal Angsuran</option>
                    <option value="jml_angsuran">Jumlah Angsuran</option>
                  </select>
                  <div ng-init="urut=true" class="ui basic icon buttons kpr">
                    <div ng-click="urut=false" ng-init="urut" class="ui button"><i class="sort alphabet ascending icon"></i></div>
                    <div ng-click="urut=true" ng-init="urut" class="ui button"><i class="sort alphabet descending icon"></i></div>
                  </div>
                </div>
              </div>
              <!-- Form Cari [FIX] -->
              <div class="four wide field">
                <div class="ui small right floated icon input">
                  <input ng-model="cari" type="text" placeholder="Cari data ...">
                  <i class="inverted violet circular search link icon"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- Tabel -->
          <table class="ui selectable inverted violet celled small striped table">
            <thead ng-if="hasil.length != 0">
              <tr>
                <th class="center aligned">Id Angsuran</th>
                <th class="center aligned">Nama Anggota</th>
                <th class="center aligned">ID Pinjaman</th>
                <th class="center aligned">Nama Administrator</th>
                <th class="center aligned">Tanggal Angsuran</th>
                <th class="center aligned">Jumlah Angsuran</th>
                <th class="center aligned">Operasi</th>
              </tr>
            </thead>
            <tbody ng-init="n=0">
              <tr ng-repeat="ag in ags | limitTo: dtmax: n | orderBy:order:urut | filter:cari as hasil">
                <td>@{{ag.id_angsuran}}</td>
                <td>@{{ag.nama}}</td>
                <td>@{{ag.id_pinjaman}}</td>
                <td>@{{ag.nama_admin}}</td>
                <td>@{{ag.tgl_angsuran}}</td>
                <td>Rp @{{ag.jml_angsuran}}</td>
                <td class="center aligned">
                  <div class="tiny ui icon buttons">
                    <div modalrinci ng-click="pilih(ag)" class="ui icon button">
                      <i class="File Text Outline icon"></i>
                    </div>
                    <div modalubah  ng-click="pilih(ag)" class="ui icon button">
                      <i class="edit icon"></i>
                    </div>
                    <div modalhapus ng-click="pilih(ag)" class="ui icon button">
                      <i class="trash icon"></i>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
            <tfoot ng-if="hasil.length != 0">
              <tr>
                <th class="center aligned">Id Angsuran</th>
                <th class="center aligned">Nama Anggota</th>
                <th class="center aligned">ID Pinjaman</th>
                <th class="center aligned">Nama Administrator</th>
                <th class="center aligned">Tanggal Angsuran</th>
                <th class="center aligned">Jumlah Angsuran</th>
                <th class="center aligned">Operasi</th>
              </tr>
            </tfoot>
          </table>
          <!-- Info Data Kosong -->
          <div ng-if="hasil.length == 0" class="ui icon message">
            <i class="inbox icon"></i>
            <div class="content">
              <div class="header">
                Mohon Maaf
              </div>
              <p>Data yang anda cari tidak kami temukan.</p>
            </div>
          </div>
          <!-- Info Jumlah Data -->
          <h4>Total Data Angsuran : @{{ags.length}} Data, Menampilkan @{{hasil.length}} data</h4>
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
<script src="/dist/controller/angsuran.js" charset="utf-8"></script>

</html>
