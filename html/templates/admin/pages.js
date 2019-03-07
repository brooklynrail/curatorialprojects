/*global angular */
'use strict';

/**
 * The main app module
 * @name app
 * @type {angular.Module}
 */
var adminApp = angular.module('adminApp', ['flow', 'textAngular', 'ui.bootstrap']);

adminApp.controller('adminController', ['$scope', '$http', '$modal', function($scope, $http, $modal, $log) {
   
    console.log('pages');
    console.log(pages);
   
    $scope.pages = pages;
    console.log($scope.pages);

    $scope.new = {
        name:        '',
        description: ''
    }

    $scope.addPage = function(){
        $http.post('/admin/page/add', 
            { "name": $scope.new.name, "description": $scope.new.description })
        .success(function(data) {
            console.log(data);
            if(data.success){
                $scope.pages = data.data;
                $scope.new   = { name: '', description: '' }
            }else{
                alert('Could not add page. ' + data.message);
            }
        })
        .error(function(data) {
            alert('Could not add page. Server error.');
        });
    }

}]);

adminApp.controller('fileSelectModalController', function ($scope, $modalInstance, files) {

    $scope.files = files;
    
    $scope.selected = $scope.files[0].webpath;

    $scope.select = function(select){
        $scope.selected = select
    }

    $scope.ok = function () {
        $modalInstance.close($scope.selected);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});