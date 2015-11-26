@extends('layouts.master')

@section('title', 'Masuk')
@section('dist', 'masuk')

@section('koperasi')
<div class="ui container">
  <div class="ui centered grid">
    <div class="sixteen wide mobile eight wide tablet five wide computer column">
      <div class="ui center aligned container">
        <h1 class="ui violet header title">KoperasiKu</h1>
        <div class="ui raised segments">
          <div class="ui violet segment">
            <h4>Masuk</h4>
          </div>
          <div class="ui violet left aligned segment">
            <div id="dimmer" class="ui blurring dimmer">
              <div class="content">
                <div class="ui text loader"></div>
              </div>
            </div>
            <div id="pesan" class="ui blurring dimmer">
              <h3 class="ui grey inverted center aligned icon header">
                <i class="ui grey inverted circular spy icon"></i>
                @{{psn}}
                <br>
                <small>@{{pesan}}</small><br><br>
                <a ng-hide="ok" ng-show="gagal" ng-click="tutup()" class="ui inverted yellow basic small button">@{{btn}}</a>
                <a ng-hide="gagal" ng-show="ok" href="/" class="ui inverted yellow basic small button">@{{btn}}</a>
              </h3>
            </div>
            <div name="masuk" class="ui form">
              {!! csrf_field() !!}
              <div class="field">
                <label>Username</label>
                <div class="ui left icon corner labeled input">
                  <input minlength="5" ng-model="username" type="text" name="username" placeholder="Masukkan Nama Pengguna">
                  <i class="user icon"></i>
                  <div class="ui corner label">
                    <i class="asterisk icon"></i>
                  </div>
                </div>
              </div>
              <div class="field">
                <label>Password</label>
                <div class="ui left icon corner labeled input">
                  <input minlength="8" ng-model="password" type="password" name="password" placeholder="Masukkan Katasandi">
                  <i class="lock icon"></i>
                  <div class="ui corner label">
                    <i class="asterisk icon"></i>
                  </div>
                </div>
              </div>
              <div class="ui fluid buttons">
                <button class="ui reset button">Reset</button>
                <div class="or" data-text="A"></div>
                <div ng-click="masuk()" class="ui animated right floated violet submit button" tabindex="0">
                  <div class="visible content">Masuk</div>
                  <div class="hidden content">
                    <i class="right arrow icon"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="ui secondary segment">
            <div class="ui center aligned container">
              <a href="/">KoperasiKu</a> <i class="copyright icon"></i>2015
              <br>
              <small>Design & Coding by <b>SuryaINetz</b></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
