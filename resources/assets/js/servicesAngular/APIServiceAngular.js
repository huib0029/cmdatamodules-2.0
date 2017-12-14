  // API controller voor de API's
angular.module('LaravelAngular').service('APIservice', ['$rootScope', '$http', function ($rootScope, $http) {

        var APIservice = {};
        // Start API met variabelen uit bepaalde functies
        APIservice.StartAPI = function (statusid, taalid, urlapi) {
            $http({
                method: 'GET',
                dataType: "Json",
                url: urlapi + statusid + '&taalid=' + taalid
            }).then(function(response) {
                // array list maken voor api blade met ng-repeat en data uit array halen en in scope plaatsten
                // op basis van geldende url
                if (urlapi === 'https://apps.hz.nl/Services/algemeen/v1/crohos?statusid=') {
                    $rootScope.crohosapi = response.data }
                if (urlapi === 'https://apps.hz.nl/Services/algemeen/v1/opleidingsvarianten?statusid=') {
                    $rootScope.opleidingsvariantenapi = response.data }
            }).catch(function(error) {
                alert("De API functioneert niet, noteer foutcode of kijk in de console log (F12)");
                alert(error.data);
                $rootScope.recordErrors(error);
            });
            // laat error code tevens in console.log zien
            $rootScope.recordErrors = function (error) {
                $rootScope.errors = [];
                if (error.data.errors.name) {
                    $rootScope.errors.push(error.data.errors.name[0]);
                }
                if (error.data.errors.description) {
                    $rootScope.errors.push(error.data.errors.description[0]);
                }
            };
        }
        return APIservice;





  }]);
