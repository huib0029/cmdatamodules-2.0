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
          var urlapi = 'https://apps.hz.nl/Services/algemeen/v1/opleidingsvarianten?statusid=';
          $scope.StartAPI(statusid, taalid, urlapi);
        };
        $scope.ZoekCrohos = function (index) {
            // invoervelden van api.blade.php doorvoeren naar url van http get
            var statusid  = document.getElementById('inputStatusid_crohos').value;
            var taalid  = document.getElementById('inputTaalid_crohos').value;
            // API call naar publieke endpoint voor crohos
            var urlapi = 'https://apps.hz.nl/Services/algemeen/v1/crohos?statusid=';
            $scope.StartAPI(statusid, taalid, urlapi);
        };
        // Start API met variabelen uit bepaalde functies
        $scope.StartAPI = function (statusid, taalid, urlapi) {
            $http({
                method: 'GET',
                dataType: "Json",
                url: urlapi + statusid + '&taalid=' + taalid
            }).then(function(response) {
                // array list maken voor api blade met ng-repeat en data uit array halen en in scope plaatsten
                // op basis van geldende url
                if (urlapi === 'https://apps.hz.nl/Services/algemeen/v1/crohos?statusid=') {
                    $scope.crohosapi = response.data }
                if (urlapi === 'https://apps.hz.nl/Services/algemeen/v1/opleidingsvarianten?statusid=') {
                    $scope.opleidingsvariantenapi = response.data }
            }).catch(function(error) {
                alert("De API functioneert niet, noteer foutcode of kijk in de console log (F12)");
                alert(error.data);
                $scope.recordErrors(error);
            });
            // laat error code tevens in console.log zien
            $scope.recordErrors = function (error) {
                $scope.errors = [];
                if (error.data.errors.name) {
                    $scope.errors.push(error.data.errors.name[0]);
                }
                if (error.data.errors.description) {
                    $scope.errors.push(error.data.errors.description[0]);
                }
            };
        }





  }]);
