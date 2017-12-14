@extends('layouts.master')

@section('page-title')
 API - testing
@endsection

@section('title')
 API testing (publieke resources, CORS tijdelijk aanzetten)
@endsection

@section('content')
<div class="container-fluid" ng-controller="APIController">
  <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#opleidingsvariantenMenu1">Opleidingsvarianten</a></li>
  <li><a data-toggle="tab" href="#crohosMenu2">Crohos</a></li>
</ul>

<div class="tab-content">
  <div id="opleidingsvariantenMenu1" class="tab-pane fade in active">
    <form class="form-horizontal">
      <fieldset>
        <legend>Genereer opleidingsvarianten</legend>
          <div class="col-lg-2">
            <label class="control-label" for="inputSmall">Status id</label>
              <select id="inputStatusid_opleidingsvarianten" class="form-control input-sm">
                  <option value="">Alle status id's</option>
                  <option value="2">(2) Actief</option>
                  <option value="4">(4) Historisch</option>
              </select>
        </div>
        <div class="col-lg-2">
          <label class="control-label" for="inputSmall">Taal id</label>
            <select id="inputTaalid_opleidingsvarianten" class="form-control input-sm">
                <option value="">Alle taal id's</option>
                <option value="1">(1) NL - Nederlands</option>
                <option value="2">(2) EN - Engels</option>
            </select>
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
          <tr ng-repeat="api in opleidingsvariantenapi">
            <td>@{{api.id}}</td>
            <td>@{{api.inschrijvenviastudielink?"Ja":"Nee"}}</td>
            <td>@{{api.iscontractonderwijs?"Ja":"Nee"}}</td>
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

    </fieldset>
  </form>
  </div>
  <div id="crohosMenu2" class="tab-pane fade">
    <form class="form-horizontal">
      <fieldset>
        <legend>Genereer Crohos</legend>
          <div class="col-lg-2">
            <label class="control-label" for="inputSmall">Status id</label>
              <select id="inputStatusid_crohos" class="form-control input-sm">
                  <option value="">Alle status id's</option>
                  <option value="2">(2) Actief</option>
                  <option value="4">(4) Historisch</option>
              </select>
        </div>
        <div class="col-lg-2">
          <label class="control-label" for="inputSmall">Taal id</label>
            <select id="inputTaalid_crohos" class="form-control input-sm">
                <option value="">Alle taal id's</option>
                <option value="1">(1) NL - Nederlands</option>
                <option value="2">(2) EN - Engels</option>
            </select>
        </div>
    <div class="col-lg-2">
        <br>
        <button ng-click="ZoekCrohos()" class="btn btn-success">
          Genereer crohos
        </button>
    </div>

      <table class="table table-striped table-hover small table-responsive">
        <thead>
          <tr>
            <th>ID</th>
            <th>code</th>
            <th>Naam</th>
            <th>Lijstnaam</th>
            <th>Nominalestudieduur</th>
            <th>Status ID</th>
            <th>Status naam</th>
            <th>TaalID</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="api in crohosapi">
            <td>@{{api.id}}</td>
            <td>@{{api.code}}</td>
            <td>@{{api.naam}}</td>
            <td>@{{api.lijstnaam}}</td>
            <td>@{{api.nominalestudieduur}}</td>
            <td>@{{api.status_id}}</td>
            <td>@{{api.status_naam}}</td>
            <td>@{{api.taalid}}</td>
          </tr>
        </tbody>
      </table>

    </fieldset>
  </form>
  </div>
</div>

</div>

@endsection

@section('scripts')
@endsection
