  // API controller voor de API's
angular.module('LaravelAngular').controller('SearchController', ['$scope', '$http', function ($scope, $http) {

        // Scope instellen voor webpagina, begin met lege velden in variabelen
        $scope.projects = [];
        $scope.laden = false;
        $scope.error = '';
        $scope.query = '';
        // Functie maken die een API call oproept naar de Laravel Scout API
        $scope.ZoekInProjecten = function () {

            // Door laden op true te zetten gaat de knop Zoeken... weergeven
            $scope.laden = true;
            // Maak een GET request via de api route op routes/api
            $http.get('api/search?q=' + $scope.query).then(function(response) {
                $scope.projects = response.data;
                $scope.error = response.data.error;
                // Zet de laad knop weer op false
                $scope.laden = false;
                // Zet de query weer leeg
                $scope.query = '';

            }).catch(function(error) {
                // Als er een error is, zet de foutmelding op het scherm
                alert("De API functioneert niet, noteer foutcode of kijk in de console log (F12)");
                alert(error.data);
                // Zet de laad knop weer op false
                $scope.laden = false;
                // Zet de query weer leeg
                $scope.query = '';

            });

        };
  }]);
