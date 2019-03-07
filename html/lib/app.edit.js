'use strict';

var RCPAdminApp = angular.module('RCPAdminApp', ['ngSanitize', 'textAngular', 'ui.bootstrap', 'ui.bootstrap.carousel', 'bootstrapLightbox'])
/**
 * $sceDelegateProvider
 */
.config(function ($sceDelegateProvider) {
    $sceDelegateProvider.resourceUrlWhitelist([
        'self',
        '*://mapsengine.google.com/**',
        '*://*google.com/maps/**'
    ]);
})
/**
 * Lightbox Provider
 */
.config(function (LightboxProvider) {
  // set a custom template
  LightboxProvider.templateUrl = '/templates/public/lightbox.html';
})
/**
 * Main Controller
 */
.controller('RCPAdminController', ['$scope', '$http', '$modal', '$parse', 'Lightbox', '$sce', function($scope, $http, $modal, $parse, Lightbox, $sce) {
  
    $scope.page           = page;
    $scope.templates      = templates;
    $scope.template_names = [];
    
    // assign numbered sections to named data objects
    $scope.data = {};
    console.log($scope.page.sections);
    $scope.page.sections.forEach(function(e){
        if(e.tplfile != null){
            console.log(e.tplfile);
            if(typeof e.tplfile.name !== typeof undefined){
                $scope.data[e.tplfile.name] = e.data;
                console.log($scope.data[e.tplfile.name]);
            }
        }
    });
   
    $scope.alert = function(variable){
        alert(variable);
    }
   
    //get names only, for dropdowns
    $scope.templates.forEach(function(e){
        $scope.template_names.push(e.name);
    });
    
    $scope.templateChanged = function(index, name){
        var tplfile = $.grep(templates, function(e) { return e.name == name });
        $scope.page.sections[index].tplfile = tplfile[0];
    }

    $scope.moveUp = function(array, index){
        var new_index;
        new_index = Number(index) - 1;
        console.log('moveUp ' + index + ', ' + new_index);
        array.move(index, new_index);
        array = array.filter(function(){ return true; });
        console.log('moveUp ' + index + ', ' + new_index);
    }

    $scope.moveDown = function(array, index){
        var new_index;
        new_index = Number(index) + 1;
        console.log('moveDown ' + index + ', ' + new_index); 
        array.move(index, new_index);
        array = array.filter(function(){ return true; });
        console.log('moveDown ' + index + ', ' + new_index);                
    }    

    $scope.removeIndex = function(array, index){
        array.splice(index, 1);
    }

    $scope.removeElement = function(element){
        console.log(element);
        element = null;
        console.log(element);
    }

    /** carousel */
    $scope.myInterval = 5000;

    /** lightbox */
    $scope.openLightboxSingle = function (file) {

        var webpaths = [{ 
            "url":     "http://curatorialprojects.brooklynrail.org" + file.webpath,
            "caption": file.caption
        }];

        files.forEach(function(e, i){
            webpaths.push();
        });

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

    
    $scope.sectionSave = function(index){
        console.log($scope.page.sections[index]);
        $http
        .post('/admin/section_save/' + page.permalink + '/' + index, 
              $scope.page.sections[index])
        .success(function(data) {
            console.log(data);
            if(data.success){
                
               // $scope.page.sections[index] = data.data;

                $("div[dg-section="+index+"]").find("[ng-model]").each(function(){
                    $(this).data('$ngModelController').$setPristine();
                });                
                
            }else{
                alert('Could not save section. ' + data.message);
            }
        })
        .error(function(data) {
            alert('Could not add page. Server error.');
        });
    }    

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

    $scope.modal = { 
        open    : false,
        tplfile : null,
        toggle  : function(){ this.open = !this.open; }
    };
    
    $scope.current_edit;
    $scope.setCurrentEdit = function(variable){ $scope.current_edit = variable; console.log($scope.current_edit); };
    $scope.other = {};

    $scope.editor = {
        data : null,
        placeData : function(data){
            $scope.setValue($scope.current_edit, $scope.editor.data);
        }    
    }
    
    $scope.files = {
        folders    : null,
        folder     : null,
        getFolders : function(){
            $http
            .get('/admin/folders/get')
            .success(function(data){ $scope.files.folders = data;  })
            .error(function(){ alert('could not get folders.'); });
        },
        getFolder : function(folder){
            console.log(folder);
            $http
            .get('/admin/folder/get/' + folder)
            .success(function(data){ console.log(data); $scope.files.folder = data; })
            .error(function(){ alert('could not get folders.'); });
            console.log(this.folder);
        },
        placeFile : function(file){
            $scope.setValue($scope.current_edit, file);
        }
    };

    $scope.getValue = function(variable){
        return $scope.$eval(variable);
    }

    $scope.setValue = function(variable, value){
        var model;
        model = $parse(variable);
        model.assign($scope, value);
        $scope.modal.toggle();
    }
    
    $scope.dgEditModal = function(type){
        
        $scope.modal.open    = true;
                
        switch(type){
            case 'file':
                $scope.modal.tplfile = "/templates/editors/imagePicker.html";
                $scope.files.getFolders();
                break;
            case 'textarea':
                $scope.modal.tplfile = "/templates/editors/textareaEditor.html";            
                $scope.editor.data = $scope.getValue($scope.current_edit);
                break;
            case 'text':
                $scope.modal.tplfile = "/templates/editors/textEditor.html";            
                $scope.editor.data = $scope.getValue($scope.current_edit);            
                break;
            case 'artist':
                $scope.modal.tplfile = "/templates/editors/artistsEditor.html";            
                $scope.editor.data = $scope.getValue($scope.current_edit);            
                break;                
        }
        $scope.$apply();
    }
    
    $scope.addRepeatingElement = function(repeating_element, parent){

        parent = $scope.getValue(parent);
        if(typeof parent[repeating_element] === typeof undefined){
            parent[repeating_element] = [];
        }
        parent[repeating_element].push({});
        $scope.$apply();
    }
    
}])
/**
 * dgEdit
 */
.directive('dgEdit', ['$document', function($document) {
    return {
        transclude: true,
        link: function(scope, element, attr) {
            
            console.log("attr.dgEditHover " + attr.dgEditHover);
            
            if(attr.dgEditBtn == "true"){
                element.wrap('<button class="button btn btn-md btn-success" />');
            }
            
            if(attr.dgEditHover != "false")
                element.css({ "outline": "1px dotted #DDD", "min-height": "20px", "cursor": "pointer" });
            
            switch(attr.dgEdit){
                case 'file':
                    element.css({ "cursor": "copy" });
                    break;
                case 'textarea':
                    element.css({ "cursor": "text" });
                    break;
                case 'text':
                    element.css({ "cursor": "text" });        
                    break;
                case 'artist':
                    element.css({ "cursor": "copy" });         
                    break;                
            }

            element.on('mouseover', function(event) {
                if(attr.dgEditHover != "false")
                    element.css({ "outline": "3px dotted red" });
            });
            
            element.on('mouseout', function(event) {
                if(attr.dgEditHover != "false")
                    element.css({ "outline": "1px dotted #DDD" });
            });            

            element.on('click', function(event) {
                scope.setCurrentEdit(attr.dgEdit);
                scope.dgEditModal(attr.dgEditType);    
            });
        }
    }
}])
/**
 * dgRepeaet
 */
.directive('dgRepeat', ['$document', function($document) {
    return {
        transclude:true,
        templateUrl: '/templates/angular/repeat.html',
        link: function (scope, element, attrs) {
            
            var addBtn;
            
            addBtn = element.find('.btn');
            
            addBtn.on('click', function(){
                var repeating_element = attrs.dgRepeat;
                var parent            = attrs.dgRepeatParent;
                scope.addRepeatingElement(repeating_element, parent);
            });
        }
    }
}])
/**
 * dgImagePosition
 */
.directive('dgImagePosition', ['$document', function($document) {
    return function(scope, element, attr) {
        var startX = 0, startY = 0, x = 0, y = 0, allow_resize = false;

        element.css({
            position: 'relative',
            cursor: 'move'
        });

        $document.on('keyup', function(event) {
            if(typeof scope.editor.data.image.width == typeof undefined)
                scope.editor.data.image.width = 200;

            if(event.which == 187){
                scope.editor.data.image.width = scope.editor.data.image.width + 10;
            }
            if(event.which == 189){
                scope.editor.data.image.width = scope.editor.data.image.width - 10;        
            }

            scope.$apply();
        });

        element.on('mousedown', function(event) {
            // Prevent default dragging of selected content
            event.preventDefault();
            startX = event.pageX - x;
            startY = event.pageY - y;
            $document.on('mousemove', mousemove);
            $document.on('mouseup', mouseup);
        });

        function mousemove(event) {
            y = event.pageY - startY;
            x = event.pageX - startX;
            element.css({
                top: y + 'px',
                left:  x + 'px'
            });
        }

        function mouseup() {
            scope.editor.data.image.top = y;
            scope.editor.data.image.left = x;
            $document.off('mousemove', mousemove);
            $document.off('mouseup', mouseup);
        }
    };
}])
/**
 * sanitize
 */
.filter("sanitize", ['$sce', function($sce) {
    return function(htmlCode){
        return $sce.trustAsHtml(htmlCode);
    }
}]);


/**
 * Helpers
 */
Array.prototype.move = function (old_index, new_index) {
    if (new_index >= this.length) {
        var k = new_index - this.length;
        while ((k--) + 1) {
            this.push(undefined);
        }
    }
    this.splice(new_index, 0, this.splice(old_index, 1)[0]);
    return this; // for testing purposes
};