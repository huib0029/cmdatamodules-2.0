@extends('layouts.master')

@section('page-title')
 API - testing
@endsection

@section('title')
 API testing (publieke resources)
@endsection

@section('content')
<div class="container-fluid" ng-controller="APIController">
<form class="form-horizontal">
  <fieldset>
    <legend>Genereer opleidingsvarianten</legend>
      <div class="col-lg-2">
        <label class="control-label" for="inputSmall">Status id</label>
        <input class="form-control input-sm" placeholder="2 (actief) of 4 (historisch)" type="text" id="inputStatusid">
    </div>
    <div class="col-lg-2">
      <label class="control-label" for="inputSmall">Taal id</label>
      <input class="form-control input-sm" placeholder="1 (NL) of 2 (EN)" type="text" id="inputTaalid">
    </div>
<div class="col-lg-2">
  	<br>
    <button ng-click="ZoekOpleidingsVarianten()" class="btn btn-success">
      Genereer opleidingsvarianten
    </button>
</div>

  <table class="table table-striped table-hover small table-responsive">
    <thead>
      <tr>
        <th>ID</th>
        <th>Inschrijven via studielink</th>
        <th>Contract onderwijs</th>
        <th>Naam</th>
        <th>Lijstnaam</th>
        <th>Status ID</th>
        <th>Status naam</th>
        <th>Kostenplaats naam</th>
        <th>Academie code</th>
        <th>Academie naam</th>
        <th>HZ opleiding naam</th>
        <th>TaalID</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="api in apis">
        <td>@{{api.id}}</td>
        <td>@{{api.inschrijvenviastudielink}}</td>
        <td>@{{api.iscontractonderwijs}}</td>
        <td>@{{api.naam}}</td>
        <td>@{{api.lijstnaam}}</td>
        <td>@{{api.status_id}}</td>
        <td>@{{api.status_naam}}</td>
        <td>@{{api.kostenplaats_naam}}</td>
        <td>@{{api.academie_code}}</td>
        <td>@{{api.academie_naam}}</td>
        <td>@{{api.hzopleiding_naam}}</td>
        <td>@{{api.taalid}}</td>
      </tr>
    </tbody>
  </table>

</div>
</fieldset>
</form>
@endsection

@section('scripts')
@endsection
