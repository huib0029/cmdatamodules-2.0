  // API controller voor de API's
angular.module('LaravelAngular').controller('APIController', ['$scope', '$http', function ($scope, $http) {

        // Scope instellen voor webpagina
        $scope.api = []
        // Functie maken die een API call oproepts
        $scope.ZoekOpleidingsVarianten = function (index) {
          // API call naar publieke endpoint voor opleidingsvarianten
          $http({
            method: 'GET',
            dataType: "Json",
            url: 'https://apps.hz.nl/Services/algemeen/v1/opleidingsvarianten?statusid=&taalid='
          }).then(function(response) {
                // array list maken voor api blade met ng-repeat
                $scope.apis = response.data
                // Data uit array halen
                $scope.api.id = response.data[0].id;
                $scope.api.inschrijvenviastudielink = response.data[0].inschrijvenviastudielink;
                $scope.api.iscontractonderwijs = response.data[0].iscontractonderwijs;
                $scope.api.naam = response.data[0].naam;
                $scope.api.lijstnaam = response.data[0].lijstnaam;
                $scope.api.status_id = response.data[0].status_id;
                $scope.api.status_naam = response.data[0].status_naam;
                $scope.api.kostenplaats_naam = response.data[0].kostenplaats_naam;
                $scope.api.academie_code = response.data[0].academie_code;
                $scope.api.academie_naam = response.data[0].academie_naam;
                $scope.api.hzopleiding_naam = response.data[0].hzopleiding_naam;
                $scope.api.taalid = response.data[0].taalid;
          }).catch(function(error) {
          alert("De API functioneert niet, noteer foutcode");
          alert(error.data);
        });
        }





  }]);
