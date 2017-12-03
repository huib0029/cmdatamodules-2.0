// taken controller:
angular.module('LaravelAngular').controller('TaskController', ['$scope', '$http', function ($scope, $http) {

    // Scope instellen voor tasks
        $scope.tasks = [];

        // Alle taken laden
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
