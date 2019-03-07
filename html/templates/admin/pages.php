<body>

    <script type="text/javascript">
        var pages = <?=$pages?>;
    </script>

    <div class="container">

        <div style="margin-bottom:25px;" id="nav-top" class="row" data-spy="affix">
            <h1>
                <i class="fa fa-cog"></i> 
                Brooklyn Rail Curatorial Projects | Pages
            </h1>
            <div class="clearfix"></div>          
            
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href="/">Go to Site</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href="/admin">Shows</a>
            </div>
            <div class="nav-btn col-md-2 col-sm-2 col-xs-2">
                <a href="/admin/folders">File Folders</a>
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
        
        <div class="row">
        
            <div ng-repeat="page in pages track by $index" class="col-lg-3 col-md-4 col-sm-6">
                <div class="one-page">
                    <div class="page-info">
                        <h3>{{page.name}}</h3>
                        <small>
                            folder name: /{{page.permalink}}
                        </small>
                        <p>
                            {{page.description}}
                        </p>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="/{{page.permalink}}">
                            <button type="button" class="btn btn-info">
                                Visit Page&nbsp; <i class="fa fa-globe"></i>
                            </button>
                        </a>
                        <a href="/admin/page/{{page.permalink}}">
                            <button type="button" class="btn btn-primary">
                                Edit Page&nbsp; <i class="fa fa-pencil"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
             <div class="form-group col-lg-3 col-md-4 col-sm-6">
                <div class="one-page">
                    <div class="page-info">
                        <h3>Add a New Page</h3>
                        <input ng-model="new.name" 
                               class="form-control"
                               name="title" 
                               type="text" 
                               placeholder="Page name" />
                        <textarea ng-model="new.description" 
                                  class="form-control"
                                  name="description" 
                                  placeholder="Page description" 
                                  rows="3"></textarea>
                    </div>
                    <button ng-click="addPage()"
                            type="button" 
                            class="form-control btn btn-success">
                        New Page&nbsp;
                        <i class="fa fa-plus-circle"></i>    
                    </button>                
                </div>       
            </div>            
        </div>  
    
    </div>
    
    <script src="/lib/pages.js"></script>
</body>