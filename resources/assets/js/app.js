
require('./bootstrap');
// Angular importeren in de applicatie
import 'angular';

// Angular laden in de laravel applicatie
var app = angular.module('LaravelAngular', []
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

// verwijzen naar de taskcontroller
app.controller('TaskController', ['$scope', '$http', function ($scope, $http) {

  // Iets doen in de taskcontroller
      $scope.tasks = [];

      // List tasks
      $scope.loadTasks = function () {
          $http.get('task')
              .then(function success(e) {
                  $scope.tasks = e.data.tasks;
              });
      };
      $scope.loadTasks();

      $scope.errors = [];

    $scope.task = {
        name: '',
        description: ''
    };
    $scope.initTask = function () {
        $scope.resetForm();
        $("#add_new_task").modal('show');
    };

    // Nieuwe task toevoegen
    $scope.addTask = function () {
        $http.post('task', {
            name: $scope.task.name,
            description: $scope.task.description
        }).then(function success(e) {
            $scope.resetForm();
            $scope.tasks.push(e.data.task);
            $("#add_new_task").modal('hide');

        }, function error(error) {
            $scope.recordErrors(error);
        });
    };
    // errors laten zien indien nodig
    $scope.recordErrors = function (error) {
        $scope.errors = [];
        if (error.data.errors.name) {
            $scope.errors.push(error.data.errors.name[0]);
        }

        if (error.data.errors.description) {
            $scope.errors.push(error.data.errors.description[0]);
        }
    };
    // formulier resetten na error
    $scope.resetForm = function () {
        $scope.task.name = '';
        $scope.task.description = '';
        $scope.errors = [];
    };
    $scope.edit_task = {};
    // initialize update action
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_task = $scope.tasks[index];
        $("#edit_task").modal('show');
    };

    // Task updaten functie aanmaken
    $scope.updateTask = function () {
        $http.patch('task/' + $scope.edit_task.id, {
            name: $scope.edit_task.name,
            description: $scope.edit_task.description
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_task").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };
    // Task deleten
    $scope.deleteTask = function (index) {

        var conf = confirm("Weet je zeker dat je de taak wilt verwijderen?");

        if (conf === true) {
            $http.delete('task/' + $scope.tasks[index].id)
                .then(function success(e) {
                    $scope.tasks.splice(index, 1);
                });
        }
    };

}]);
app.controller('APIController', ['$scope', '$http', function ($scope, $http) {

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
