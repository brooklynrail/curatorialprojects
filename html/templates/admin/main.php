<!DOCTYPE html>
<html lang="en" ng-app="RCPAdminApp">
<head>

    <!-- ADMIN EDIT -->
    
    <title>{{page.name}}</title>
    
    <!-- meta -->
    <meta charset="UTF-8">
    <meta name="keywords"    content="{{page.sections[7].keywords}}" />
    <meta name="description" content="{{page.sections[7].description}}" />
    <meta name="viewport"    content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- /meta -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="http://necolas.github.io/normalize.css/3.0.2/normalize.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=News+Cycle:400,700" type="text/css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic" type="text/css" />
    <link rel="stylesheet" href="/lib/angular-loading-bar/build/loading-bar.css" />
    <link rel="stylesheet" href="/lib/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.css" />
    <link rel="stylesheet" href="/lib/textAngular/src/textAngular.css" />
    <link rel="stylesheet" href="/css/app.edit.css" />    

</head>
<body ng-controller="RCPAdminController" ng-cloak>

    <div class="container">

        <div style="margin-bottom:25px;" id="nav-top" class="row" data-spy="affix">
            <h1>
                <i class="fa fa-pencil-square-o"></i>
                {{page.name}}
            </h1>
            <div class="clearfix"></div>          
            
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href="/">Go to Site</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href="/admin">Pages</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href="/admin/folders">Folders</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href=""></a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href=""></a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href=""></a>
            </div>		
        </div>    
        
        <div style="height:84px;"></div>
    
        <div class="row">
            <div id="section-0" ng-include="page.sections[0].tplfile.edit_file"></div>
        </div>

        <div class="section-head row">    
            <div class="col-md-6">
                <input class="form-control" type="text" ng-model="page.sections[0].title" />
            </div>           
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <!-- Split button -->
                <div class="btn-group pull-right" dropdown>
                    <button type="button" class="btn" style="cursor:none">
                        Template: <strong style="text-transform: capitalize;">{{page.sections[0].tplfile.name}}</strong>
                    </button>
                    <button type="button" class="btn dropdown-toggle btn-primary" dropdown-toggle>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li ng-repeat="name in template_names">
                            <a ng-click="templateChanged(0, name)">{{name}}</a>
                        </li>
                    </ul>
                </div>            
            </div>            
            <div class="col-md-1">                
                <button type="button" class="pull-right btn btn-success" ng-click="sectionSave(0)">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <!-- affixed nav element -->
        <div id="nav-top" class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1>{{page.sections[0].title}}</h1>
            </div>
            <div class="clearfix"></div>          

            <div class="nav-btn col-md-2 col-sm-2 col-xs-2" ng-class="{'hover' : page.sections[1]}">
                <a href="#section-1">{{page.sections[1].title}}</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2" ng-class="{'hover' : page.sections[2]}">
                <a href="#section-2">{{page.sections[2].title}}</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2" ng-class="{'hover' : page.sections[3]}">
                <a href="#section-3">{{page.sections[3].title}}</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2" ng-class="{'hover' : page.sections[4]}">
                <a href="#section-4">{{page.sections[4].title}}</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2" ng-class="{'hover' : page.sections[5]}">
                <a href="#section-5">{{page.sections[5].title}}</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2" ng-class="{'hover' : page.sections[6]}">
                <a href="#section-6">{{page.sections[6].title}}</a>
            </div>		

        </div>

        <div class="row" dg-section="7">
            <div class="section-head col-lg-12 col-md-12 col-xs-12 text-right">
                <button type="button" class="pull-right btn btn-success" ng-click="sectionSave(7)">
                    <i class="fa fa-floppy-o"></i> Save
                </button>
                <div class="pull-right"><h3>Show Information</h3></div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Short name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" ng-model="page.sections[7].short_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Hashtag:</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" ng-model="page.sections[7].hashtag">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Description:</label>
                    <div class="col-sm-10">          
                        <textarea class="form-control" ng-model="page.sections[7].description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Keywords:</label>
                    <div class="col-sm-10">          
                         <textarea class="form-control" ng-model="page.sections[7].keywords"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Live:</label>
                    <div class="col-sm-2">          
                        <button type="button" 
                                class="btn btn-default"
                                ng-class='{"btn-danger": page.sections[7].live}' 
                                ng-model="page.sections[7].live" 
                                btn-checkbox btn-checkbox-true="1" btn-checkbox-false="0" 
                                ng-click="page.sections[7].live">
                            {{ page.sections[7].live ? 'LIVE' : 'NOT LIVE' }}
                        </button>
                    </div>
                    <label class="control-label col-sm-2" for="pwd">Position:</label>
                    <div class="col-sm-2">          
                        <input type="text" class="form-control" ng-model="page.sections[7].position">
                    </div>                        
                </div>                                                            

            </div>
        </div>


        <div class="row" ng-repeat="index in [1, 2, 3, 4, 5, 6]" dg-section="{{index}}">
            <div class="section-head col-lg-12 col-md-12 col-xs-12 text-right">
        
                <h3>{{page.sections[index].title}}</h3>
        
                <hr />

                <div class="col-md-6">
                    <input class="form-control" type="text" ng-model="page.sections[index].title" />
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-3">
                    <!-- Template Selector -->
                    <div class="btn-group pull-right" dropdown>
                        <button type="button" class="btn" style="cursor:none">
                            Template: <strong style="text-transform: capitalize;">{{page.sections[index].tplfile.name}}</strong>
                        </button>
                        <button type="button" class="btn dropdown-toggle btn-primary" dropdown-toggle>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li ng-repeat="name in template_names">
                                <a ng-click="templateChanged(index, name)">{{name}}</a>
                            </li>
                        </ul>
                    </div>            
                </div>            
                <!-- Save Template Changes -->
                <div class="col-md-1">                
                    <button type="button" class="pull-right btn btn-success" ng-click="sectionSave(index)">
                        <i class="fa fa-floppy-o"></i> Save
                    </button>
                </div>
                <div class="clearfix"></div>                
        
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="section-{{index}}" ng-include="page.sections[index].tplfile.edit_file"></div>      
            </div>   
        </div>

        <div id="section-last" class="row">
            <div></div>
        </div>
    </div>

    <!-- "modal" -->
    <div id="modal_blackout" ng-show="modal.open">
    </div>
    <div id="modal_box" ng-show="modal.open">
        <div id="modal_content">
            <div class="container container-100" ng-include="modal.tplfile">
            </div>
        </div>
        <div id="modal_controls">
            <button type="button" class="btn btn-warning pull-right" ng-click="modal.toggle()"> 
                CLOSE
            </button>
        </div>
    </div>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"></script> 
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.12/angular.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular-sanitize.js"></script>
    <script type="text/javascript" src="/lib/ui-router/release/angular-ui-router.js"></script>   
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>    
    <script type="text/javascript" src="/ui-bootstrap-tpls-0.12.0.min.js"></script>
    <script type="text/javascript" src="/lib/angular-loading-bar/build/loading-bar.js"></script>
    <script type="text/javascript" src="/lib/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.js"></script>    
    <script type="text/javascript" src="/lib/textAngular/dist/textAngular-rangy.min.js"></script>
    <script type="text/javascript" src="/lib/textAngular/dist/textAngular-sanitize.min.js"></script>
    <script type="text/javascript" src="/lib/textAngular/dist/textAngular.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular-touch.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/lib/bootstrap.custom.edit.js"></script>
    <script type="text/javascript">
    
        var page = {}, templates = [];
    
        page      = <?=$data?>;
        templates = <?=$templates?>;

    </script>
    <script type="text/javascript" src="/lib/app.edit.js"></script>

</body>
</html>