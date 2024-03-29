
require('./bootstrap');

// Angular importeren in de applicatie
import 'angular';

// Angular laden in de laravel applicatie
angular.module('LaravelAngular', []
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);
// laad services en controllers in aparte js files voor overzichtelijkheid
require('./servicesAngular/APIServiceAngular');
require('./controllersAngular/TaskControllerAngular');
require('./controllersAngular/APIControllerAngular');
require('./controllersAngular/SearchControllerAngular');
