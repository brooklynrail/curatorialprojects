<!DOCTYPE html>
<html lang="en" ng-app="RCPPublicApp" ng-controller="RCPPublicController">
<head>
    
    <!-- PUBLIC MAIN -->
    
    <? $phpdata = json_decode($data); ?>
    
    <title><?= $phpdata->sections[7]->short_name ?> | Brooklyn Rail Curatorial Projects</title>
    
    <!-- meta -->
    <meta charset="UTF-8">
    <meta name="keywords"    content="<?= $phpdata->sections[7]->keywords ?>" />
    <meta name="description" content="<?= $phpdata->sections[7]->description ?>" />
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
    <link rel="stylesheet" href="/css/app.css" />    

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"></script> 
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.12/angular.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular-sanitize.js"></script>
    <script type="text/javascript" src="/lib/ui-router/release/angular-ui-router.js"></script>   
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>    
    <script type="text/javascript" src="/ui-bootstrap-tpls-0.12.0.min.js"></script>
    <script type="text/javascript" src="/lib/angular-loading-bar/build/loading-bar.js"></script>
    <script type="text/javascript" src="/lib/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular-touch.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-24931975-5', 'auto');
        ga('send', 'pageview');

    </script>

</head>
<body class="ng-cloak">



    <div class="container">
    
        <div class="row">
            <div id="section-0" ng-include="page.sections[0].tplfile.display_file"></div>
        </div>
        
        <!-- affixed nav element -->
        <div id="nav-top" class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1>{{page.sections[0].title}}</h1>
            </div>
            <div class="clearfix"></div>          

            <div class="nav-button col-md-2 col-sm-2 col-xs-4" ng-class="{'hover' : page.sections[1].title}">
                <a href="#section-1">{{page.sections[1].title}}</a>
            </div>
            <div class="nav-button col-md-2 col-sm-2 col-xs-4" ng-class="{'hover' : page.sections[2].title}">
                <a href="#section-2">{{page.sections[2].title}}</a>
            </div>
            <div class="nav-button col-md-2 col-sm-2 col-xs-4" ng-class="{'hover' : page.sections[3].title}">
                <a href="#section-3">{{page.sections[3].title}}</a>
            </div>
            <div class="nav-button col-md-2 col-sm-2 col-xs-4" ng-class="{'hover' : page.sections[4].title}">
                <a href="#section-4">{{page.sections[4].title}}</a>
            </div>
            <div class="nav-button col-md-2 col-sm-2 col-xs-4" ng-class="{'hover' : page.sections[5].title}">
                <a href="#section-5">{{page.sections[5].title}}</a>
            </div>
            <div class="nav-button col-md-2 col-sm-2 col-xs-4" ng-class="{'hover' : page.sections[6].title}">
                <a href="#section-6">{{page.sections[6].title}}</a>
            </div>		

        </div>
        <!-- affixed nav placeholder -->    
        <div id="nav-placeholder" class="row">
            <div class="col-md-12 col-sm-12 col-xs-12"></div>
        </div>	
        <!-- end affixable element -->

        <div ng-repeat="index in [1, 2, 3, 4, 5, 6]" id="section-{{index}}" class="row" style="display:none;">
            <div ng-show="page.sections[index].title">
                <div ng-cloak class="section-head nopad-top col-lg-12 col-md-12 col-xs-12 text-right">
                    <h3>{{page.sections[index].title}}</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section row" ng-include="page.sections[index].tplfile.display_file" onload="loaded[index] = true"></div>        
                </div>   
            </div>
        </div>

        <div id="section-last" class="row">
            <div></div>
        </div>
    </div>

    <!-- "nav-footer" -->
    <nav id="nav-footer" class="navbar navbar-fixed-top">
        <div class="container">
            <div class="nav-bottom text-center col-md-2 col-sm-2 col-xs-2">
                <img id="logo_main" src="/brooklyn_rail_curatorial_projects_logo.png" />
            </div>
            <div style="padding-top:6px;" class="nav-bottom text-center col-md-2 col-sm-2 col-xs-4">
                <a href="http://twitter.com/TheBrooklynRail" target="cp.bksocial">
                    <img style="width:25px;" class="social" src="/tw.png" />
                </a>
                <a href="http://www.facebook.com/pages/The-Brookyn-Rail/236031950542" target="cp.bksocial">
                    <img style="width:25px;" class="social" src="/fb.png" />
                </a>
                <a href="http://instagram.com/brooklynrail" target="cp.bksocial">    
                    <img style="width:25px;" class="social" src="/ig.png" />
                </a>
            </div>
            <div class="nav-bottom hidden-xs text-center col-md-2 col-sm-2">
                <a href="http://twitter.com/TheBrooklynRail">
                    {{page.sections[7].hashtag}}
                </a>
            </div>
            <div class="nav-bottom hidden-xs text-center col-md-2 col-sm-2"></div>
            <div dg-archive-popup class="nav-bottom text-center col-md-2 col-sm-2 col-xs-2">
            </div>
            <div style="padding-top:10px;" class="nav-bottom text-center col-md-2 col-sm-2 col-xs-4">
                <a href="http://brooklynrail.org" target="cp.bksocial"> 
                    <img style="width:100%;" src="/bkrail-logo-tiny.png" />
                </a>            
            </div>
        </div>
    </nav>

    <!-- layout detection             http://stackoverflow.com/questions/18575582/how-to-detect-responsive-breakpoints-of-twitter-bootstrap-3-using-javascript -->
    <div class="device-xs visible-xs"></div>
    <div class="device-sm visible-sm"></div>
    <div class="device-md visible-md"></div>
    <div class="device-lg visible-lg"></div>


    <script type="text/javascript" src="/lib/bootstrap.custom.js?20171119"></script>
    <script type="text/javascript">
    
        var page = {}, tpls = [], archives = [];
        
        archives = <?=$archives?>; 
        page     = <?=$data?>;
        tpls     = <?=$tpls?>;

    </script>
    <script type="text/javascript" src="/lib/app.js?20171119"></script>
</body>
</html>