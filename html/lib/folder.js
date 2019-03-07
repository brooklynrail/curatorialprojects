/*global angular */
'use strict';

/**
 * The main app module
 * @name app
 * @type {angular.Module}
 */
var adminApp = angular.module('adminApp', ['flow', 'textAngular', 'ui.bootstrap']);

adminApp.controller('adminController', ['$scope', '$http', '$modal', function($scope, $http, $modal, $log) {
   
    console.log('folder');
    console.log(folder);
   
    $scope.folder = folder;
    console.log($scope.folder);

    $scope.updateFolderData = function(){
        $http
        .post('/admin/folder/update', 
            { "name"        : $scope.folder.name, 
              "title"       : $scope.folder.title, 
              "description" : $scope.folder.description })
        .success(function(data) {
            if(data.success){
                $scope.folder = data.data;
            }else{
                alert('Could not update folder. ' + data.message);
            } })
        .error(function(data) { 
            alert('Could not update folder. Server error.'); });
    }

    $scope.fileCaptionSave = function(filename, index){
        $http
        .post('/admin/folder/file_caption_save', 
            { "folder"   : $scope.folder.name,
              "filename" : filename,
              "caption"  : $scope.folder.files[index].caption })
        .success(function(data) {
            if(data.success){
                $scope.folder.files = data.data;
            }else{
                alert('Could not update caption. ' + data.message);
            } })
        .error(function(data){ 
            alert('Could not update caption. Server error.'); });
    }
    
    $scope.fileDelete = function(filename){
        
        $http
        .post('/admin/folder/file_delete', 
            { "folder"   : $scope.folder.name, 
              "filename" : filename })
        .success(function(data) {
            if(data.success){
                $scope.folder.files = data.data;
            }else{
                alert('Could not delete file. ' + data.message);
            }
        })
        .error(function(data){ 
            alert('Could not delete file. Server error.'); });
    }
    
    /**
     * working with files
     */

//     function updateFilesList(){
//         $http.get('files_list.php').success(function(data) {
//             $scope.files = data;
//         });
//     }
// 
//     updateFilesList();

    $scope.$on('flow::fileAdded', function (event, $flow, flowFile) {
        //alert('file added');
    });    
    
    $scope.$on('flow::complete', function (event, $flow, flowFile) {
        location.reload();
    });

// *
//      * files selector
//      */    
//     $scope.openFileSelector = function (location) {
// 
//         var fileSelectModal = $modal.open({
//             templateUrl: 'fileSelector.html',
//             controller: 'fileSelectModalController',
//             size: '100%',
//             resolve: {
//                 files: function () {
//                     return $scope.files;
//                 }
//             }
//         });
// 
//         fileSelectModal.result.then (function (selected) {
//             $scope[location] = selected;
//             $scope.saveText(location);
//         }, function () {
//             $log.info('Modal dismissed at: ' + new Date());
//         });
//     };    
// 
// *
//      * update files
//     
//     
//     function updateFilesList(){
//         $http.get('files_list.php').success(function(data) {
//             $scope.files = data;
//         });
//     }
// 
//     $scope.deleteFile = function (filename){
//         $http.get('file_delete.php?filename=' + filename).success(function(data) {
//             console.log(data);
//             if(data.success){
//             
//                 updateFilesList();
//             }else{
//                 alert('Could not delete file. ' + data.errors.join("\n"));
//             }
//         })
//         .error(function(data) {
//             alert('Could not delete file. Server error.');
//         });
//     }
// 
//     $scope.$on('flow::fileAdded', function (event, $flow, flowFile) {
//         //alert('file added');
//     });    
//     
//     $scope.$on('flow::complete', function (event, $flow, flowFile) {
//         //alert('complete');
//         updateFilesList();
//     });
//     
//     $scope.saveCaption = function (index){
//         
//         var filename, caption;
//         
//         filename = $scope.files[index].name + '.txt';
//         caption  = $scope.files[index].caption;
//         
//         $http.post('save_text.php', { "file" : filename, "text" : caption } ).success(function(data) {
//             console.log(data);
//             if(data.success){
//                 //alert('Saved!');
//             }else{
//                 alert('Could not save text! ' + data.errors.join("\n"));
//             }
//         })
//         .error(function(data) {
//             alert('Could not save text. Server error.');
//         });        
//     }    
//     
//     updateFilesList();
//     
// *
//      * update files
//     
//     $scope.savePositioning = function(){
//         
//         var positions = [];
//         
//         $scope.files.forEach(function(e, i){
//             
//             var position = {};
//             
//             position.webpath  = e.webpath;
//             position.position = e.position;
//             
//             positions.push(position);
//         });
//         
//         console.log(positions);
//         
//         $http.post('save_positions.php', { "positions" : positions } ).success(function(data) {
//             if(data.success){
//                 alert('Saved!');
//             }else{
//                 alert('Could not save positions! ' + data.errors);
//             }
//         })
//         .error(function(data) {
//             alert('Could not save positions. Server error.');
//         });
//     } 
//          
//     
//     // text blocks
// 
//     $scope.homepage = null;
// 
//     $scope.homepageImage = '';
// 
//     $scope.homepageContent = '<em>loading...</em>';
//     
//     $scope.cvContent = '<em>loading...</em>';
//  
//     $scope.textBlocks = [ 'cvContent', 'homepageContent', 'homepageImage' ];
//  
//     $scope.getText = function (contentName){
//         
//         console.log(contentName);
//         
//         $http.get('get_text.php?file=' + contentName).success(function(data) {
//             if(data.success){
//                 $scope[contentName] = data.text;
//             }else{
//                 alert('Could not get text! ' + data.errors.join("\n"));
//             }
//         })
//         .error(function(data) {
//             alert('Could not get text. Server error.');
//         });        
//     }
//     
//     $scope.textBlocks.forEach(function(e, i){
//         $scope.getText($scope.textBlocks[i]);
//     });
//     
//     $scope.imageCaptions = [];
//     
//     $scope.imageCaptions.forEach(function(e, i){
//         $scope.getText($scope.imageCaptions[i]);
//     });    
//     
//     $scope.saveText = function (contentName){
//         
//         $http.post('save_text.php', { "file" : contentName, "text" : $scope[contentName] } ).success(function(data) {
//             console.log(data);
//             if(data.success){
//                 alert('Saved!');
//             }else{
//                 alert('Could not save text! ' + data.errors.join("\n"));
//             }
//         })
//         .error(function(data) {
//             alert('Could not save text. Server error.');
//         });        
//     }
//     
}]);

adminApp.config(['flowFactoryProvider', function (flowFactoryProvider) {
    flowFactoryProvider.defaults = {
        query: { "folder" : folder.name },
        target: '/admin/files/upload',
        permanentErrors: [404, 500, 501],
        maxChunkRetries: 1,
        chunkRetryInterval: 5000,
        simultaneousUploads: 4
    };
    flowFactoryProvider.on('catchAll', function (event) {
        console.log('catchAll', arguments);
    });
    // Can be used with different implementations of Flow.js
    // flowFactoryProvider.factory = fustyFlowFactory;
}]);
