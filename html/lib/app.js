'use strict';

var RCPPublicApp = angular.module('RCPPublicApp', ['ngSanitize', 'ui.bootstrap', 'ui.bootstrap.carousel', 'bootstrapLightbox'])

/**
 * RCPPublicController (Main Controller)
 */
.controller('RCPPublicController', ['$scope', '$http', '$modal', '$parse', 'Lightbox', function($scope, $http, $modal, $parse, Lightbox) {
  
    $scope.page       = page;
    $scope.tpls       = tpls;
    $scope.archives   = archives;
    $scope.tpls_names = [];

    $scope.loaded = [];
	$scope.loaded[1] = $scope.loaded[2] = $scope.loaded[3] = $scope.loaded[4] = $scope.loaded[5] = $scope.loaded[6] = $scope.loaded[7] = false;

	$scope.$watch('loaded[1]', function(newValue, oldValue) {
		if(newValue) $("#section-1").show();
	});	
	$scope.$watch('loaded[2]', function(newValue, oldValue) {
		if(newValue) $("#section-2").show();
	});	
	$scope.$watch('loaded[3]', function(newValue, oldValue) {
		if(newValue) $("#section-3").show();
	});	
	$scope.$watch('loaded[4]', function(newValue, oldValue) {
		if(newValue) $("#section-4").show();
	});	
	$scope.$watch('loaded[5]', function(newValue, oldValue) {
		if(newValue) $("#section-5").show();
	});	
	$scope.$watch('loaded[6]', function(newValue, oldValue) {
		if(newValue){
	        $("#section-6").show();
        	$("body").show();
	        console.log('show body');	
	    }
	});	
	$scope.$watch('loaded[7]', function(newValue, oldValue) {
		if(newValue)
		    $("#section-7").show();
	});							

    console.log($scope.archives);

    // assign numbered sections to named data objects
    $scope.data = {};
    $scope.page.sections.forEach(function(e){
        if(e.tplfile != null){
            console.log(e.tplfile);
            if(typeof e.tplfile.name !== typeof undefined){
                $scope.data[e.tplfile.name] = e.data;
            }
        }
    });
 
     /** carousel */
    $scope.myInterval = 5000;
    
    //get names only, for dropdowns
    $scope.tpls.forEach(function(e){
        $scope.tpls_names.push(e.name);
    });

    /** lightbox */
    $scope.openArtistLightbox = function (artists, index) {

        var webpaths = [];

        artists.forEach(function(artist, i){
            webpaths.push({ 
                "url": "http://curatorialprojects.brooklynrail.org" + artist.image.webpath,
                "caption": artist.caption
            });
        });

        Lightbox.openModal(webpaths, index);
    };

    $scope.openLightboxSingle = function (file) {

        var webpaths = [{ 
            "url":     "http://curatorialprojects.brooklynrail.org" + file.webpath,
            "caption": file.caption
        }];

        Lightbox.openModal(webpaths, 0);
    };

    $scope.openLightboxMultiple = function (files) {

        var webpaths = [];

        files.forEach(function(e, i){
            webpaths.push({ 
                "url": "http://curatorialprojects.brooklynrail.org" + e.webpath,
                "caption": e.caption 
            });
        });

        Lightbox.openModal(webpaths, 0);
    };

    function implodeTemplateObject(index){
        var tpl;
        tpl = $scope.page.sections[index].tplfile;
        $scope.page.sections[index].tplfile = tpl.name;
    }
    
    function expandTemplateObject(index){
        
        var tpl_obj, template_dir, edit_indicator;
        
        template_dir      = "/templates/tplfiles/";
        edit_indicator    = "edit";
        display_indicator = "display";
        
        tpl_obj = {
            "name":        template_name,
            "editfile":    template_dir + template_name + '.' + edit_indicator + ".html",
            "displayfile": template_dir + template_name + '.' + display_indicator + ".html",
        }
        
        return tpl_obj;
    }

    $scope.editor = {
        data : null,
        placeData : function(data){
            $scope.setValue($scope.current_edit, $scope.editor.data);
        }    
    }
    
}])
/**
 * dgArchivePopup
 */
.directive('dgArchivePopup', ['$document', function($document) {
    return {
        templateUrl: '/templates/public/archives-popup.html',
        link: function (scope, element, attrs) {

            var popup, links, top, height, width;
            
            popup  = element.find("#archives-popup");
            links  = popup.find(".archive-link");
            top    = "39px";
            height = element.height() + "px";
            width  = element.width() + "px";
            
            popup.css({ "top": top, "left": "-5px" });
            links.css({ "width": width, "height": height });
            
            popup.on('mouseover', function(event) {
                popup.show();
            });
            
            element.on('mouseover', function(event) {
                popup.show();
            });
            
            popup.on('mouseout', function(event) {
                popup.hide();
            });
       
            element.on('mouseout', function(event) {
                popup.hide();
            });
       
        }
    }
}])


/**
 * LightboxProvider
 */
.config(function (LightboxProvider) {
  // set a custom template
  LightboxProvider.templateUrl = '/templates/public/lightbox.html';
})
/**
 * LightboxCtrl
 */
.controller('LightboxCtrl', function ($scope, $window) {
    $scope.alert = function (message) {
        $window.alert(message);
    };
})


/**
 * $sceDelegateProvider
 */
.config(function ($sceDelegateProvider) {
    $sceDelegateProvider.resourceUrlWhitelist([
        'self',
        '*://mapsengine.google.com/**',
        '*://www.google.com/maps/**'        
    ]);
})
/**
 * sanitize
 */
.filter("sanitize", ['$sce', function($sce) {
    return function(htmlCode){
        return $sce.trustAsHtml(htmlCode);
    }
}]);