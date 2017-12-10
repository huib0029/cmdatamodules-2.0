  // API controller voor de API's
angular.module('LaravelAngular').controller('APIController', ['$scope', '$http', function ($scope, $http) {

        // Scope instellen voor webpagina
        $scope.api = []
        // Functie maken die een API call oproepts
        $scope.ZoekOpleidingsVarianten = function (index) {
          // invoervelden van api.blade.php doorvoeren naar url van http get
          var statusid  = document.getElementById('inputStatusid_opleidingsvarianten').value;
          var taalid  = document.getElementById('inputTaalid_opleidingsvarianten').value;
          // API call naar publieke endpoint voor opleidingsvarianten
          $http({
            method: 'GET',
            dataType: "Json",
            url: 'https://apps.hz.nl/Services/algemeen/v1/opleidingsvarianten?statusid=' + statusid + '&taalid=' + taalid
          }).then(function(response) {
                // array list maken voor api blade met ng-repeat en data uit array halen
                $scope.opleidingsvariantenapi = response.data

          }).catch(function(error) {
          alert("De API functioneert niet, noteer foutcode");
          alert(error.data);
        });
        }
        $scope.ZoekCrohos = function (index) {
          // invoervelden van api.blade.php doorvoeren naar url van http get
          var statusid  = document.getElementById('inputStatusid_crohos').value;
          var taalid  = document.getElementById('inputTaalid_crohos').value;
          // API call naar publieke endpoint voor opleidingsvarianten
          $http({
            method: 'GET',
            dataType: "Json",
            url: 'https://apps.hz.nl/Services/algemeen/v1/crohos?statusid=' + statusid + '&taalid=' + taalid
          }).then(function(response) {
                // array list maken voor api blade met ng-repeat en data uit array halen
                $scope.crohosapi = response.data
          }).catch(function(error) {
          alert("De API functioneert niet, noteer foutcode");
          alert(error.data);
        });
        }





  }]);
