<body>

    <script type="text/javascript">
        var folders = <?=$folders?>;
    </script>

    <div class="container">

        <div style="margin-bottom:25px;" id="nav-top" class="row" data-spy="affix">
            <h1>
                <i class="fa fa-cog"></i> 
                Brooklyn Rail Curatorial Projects | File Folders
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

            <div ng-repeat="(name, folder) in folders track by $index" class="col-lg-3 col-md-4 col-sm-6">
                <div class="one-page">
                    <div class="page-info">
                        <h3>{{folder.title}}</h3>
                        <small>
                            folder name: /{{name}}
                        </small>
                        <p>
                            {{folder.description}}
                        </p>
                    </div>
                    <a class="form-control btn btn-info" role="button" href="/admin/folders/{{name}}" style="color:white">
                        Open Folder&nbsp;
                        <i class="fa fa-folder-open"></i>
                    </a>
                </div>
            </div>
             <div class="highlight form-group col-lg-3 col-md-4 col-sm-6">
                <div class="one-page">
                    <div class="page-info">
                        <h3>Add a New Folder</h3>
                        <input ng-model="new.title" 
                               class="form-control"
                               name="title" 
                               type="text" 
                               placeholder="Folder name" />
                        <textarea ng-model="new.description" 
                                  class="form-control"
                                  name="description" 
                                  placeholder="Folder description" 
                                  rows="3"></textarea>
                    </div>
                    <button ng-click="addFolder()"
                            type="button" 
                            class="form-control btn btn-success">
                        New Folder&nbsp;
                        <i class="fa fa-plus-circle"></i>       
                    </button>
                </div>            
            </div>  
        </div>
    </div>
    
<script src="/lib/folders.js"></script>
</body>