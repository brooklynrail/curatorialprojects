<!DOCTYPE html>
<html ng-app="adminApp" ng-controller="adminController" flow-init>
<head>
  
    <title>Rail Curatorial Projects | Administration</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.13/angular.js"></script>
    <script src="/lib/angular-ui/ui-bootstrap-0.12.0.min.js"></script>
    <script src="/lib/angular-ui/ui-bootstrap-tpls-0.12.0.min.js"></script>
    <script src="/lib/ng-flow/dist/ng-flow-standalone.js"></script>
    <script src="/lib/textAngular/dist/textAngular-rangy.min.js"></script>
    <script src="/lib/textAngular/dist/textAngular-sanitize.min.js"></script>
    <script src="/lib/textAngular/dist/textAngular.min.js"></script>
    
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=News+Cycle:400,700" type="text/css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic" type="text/css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="/lib/textAngular/src/textAngular.css" rel="stylesheet"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="/css/app.edit.css"></style>
    <style type="text/css">

        .ta-scroll-window > .ta-bind{
            min-height: 20px;
            height: auto;
            overflow: auto;
            font-family: inherit;
            font-size: 100%;
        } 

        .padded{
            width:100px;
            height:100px;
            overflow:hidden;
            cursor:pointer;
        } 
        
        .page-info{ height:150px; overflow:scroll; }
        
        small{ font-family: 'News Cycle', sans-serif; } 

    </style>

    <script type="text/ng-template" id="fileSelector.html">
        <div class="modal-header">
            <h3 class="modal-title">Select a file</h3>
        </div>
        <div class="modal-body container">
            <div class="row">
                <div class="col-md-2" ng-repeat="sfile in files track by $index">
                    <div class="padded" ng-click="select(sfile.webpath)">
                        <img ng-src="{{sfile.webpath}}" width="100" height="100" /><br />
                        <small>{{sfile.name}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            Selected: <b>{{selected}}</b>
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>
  
  
</head>

<? include("{$page}.php"); ?>

</html>