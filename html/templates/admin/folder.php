<body flow-prevent-drop
      flow-drag-enter="style={border: '5px solid green'}"
      flow-drag-leave="style={}"
      ng-style="style">
    <script type="text/javascript">
        var folder = <?=$folder?>;
    </script>       
    <div class="container">
        
        <h1>
            <i class="fa fa-folder"></i>
            /{{folder.name}}
        </h1>
        
        <hr class="soften" />

        <h3>{{folder.title}} <small>{{folder.description}}</small></h3>
        <!--
        <div class="row"> 
        
            <div class="col-md-10 col-sm-10">
                <input type="text" class="form-control" placeholder="Text input" ng-model="folder.description">
            </div>
            
            <div class="col-md-2 col-sm-2">
                <a class="btn btn-small btn-success" ng-click="saveFolderData()">Save Description</a>
            </div>
        </div>
        -->    
            
        <hr class="soften" />

        <!-- New Uploads -->
        <h2>New Uploads</h2>

        <p>
            <span class="btn btn-small btn-info" flow-btn>
                <i class="icon icon-file"></i>
                Select File(s)
            </span>
            <span class="btn btn-small btn-info" 
                  flow-btn flow-directory
                  ng-show="$flow.supportDirectory">
                <i class="icon icon-folder-open"></i>
                Select Folder
            </span>    
            <a class="btn btn-small btn-success" ng-click="$flow.resume()">Upload</a>
            <span class="label label-info">Size: {{$flow.getSize()}}</span>
            <span class="label label-info">Is Uploading: {{$flow.isUploading()}}</span>
            <a class="btn btn-small btn-warning" ng-click="$flow.cancel()">Clear Uploads</a>
        </p>
        <table class="table table-hover table-bordered table-striped" flow-transfers>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Size</th>
                <th>Image</th>
                <th>Progress</th>
                <th>Uploading</th>
                <th>Completed</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="tfile in transfers track by $index">
                <td>{{$index+1}}</td>
                <td>{{tfile.name}}</td>
                <td>{{tfile.size}}</td>
                <td><img flow-img="$flow.files[$index]" width="100" height="100" /></td>
                <td>{{tfile.progress()}}</td>
                <td>{{tfile.isUploading()}}</td>
                <td>{{tfile.isComplete()}}</td>
            </tr>
            </tbody>
        </table>

        <hr class="soften"/>

        <div class="alert" 
             flow-drop 
             flow-drag-enter="class='alert-success'" 
             flow-drag-leave="class=''"
             ng-class="class">Or drag And drop a file here</div>

        <hr class="soften" />

        <!-- Current Files -->
        <h2>Current Files</h2>
        <!--
        <p>
            <a class="btn btn-small btn-success" 
               ng-click="savePositioning()">Save Positioning</a>
               Note: Images with position no position will NOT appear on the grid page at all.
        </p>
        -->        
        <form id="main-images-form">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <!--<th style="width:40%">Caption</th>-->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="file in folder.files track by $index" ng-model="folder.files">
                        <td>{{$index+1}}</td>
                        <td>
                            <b>{{file.name}}</b><br />
                            <small>
                                added: <i>{{file.added}}</i><br />
                                filesize: {{(file.size / 1024) | number : 2}} kb<br />
                                imagesize (w x h): {{file.imagesize}}
                            </small>
                        </td>
                        <td>
                            <img src="{{file.webpath}}" style="max-height:150px; max-width:150px;" />
                        </td>
                        <!--
                        <td>
                            <a class="btn btn-small btn-success pull-right" 
                               ng-click="fileCaptionSave(file.name, $index)">Save</a>
                            <div text-angular 
                                 style="height:100px;"
                                 ng-model="file.caption"
                                 ta-toolbar="[['bold','italics','underline']]"
                                 ta-text-editor-class="border-around" 
                                 ta-html-editor-class="border-around"></div>
                            <div class="clearfix"></div>
                        </td>
                        -->
                        <td>
                            <a class="btn btn-mini btn-danger pull-right" 
                               ng-click="fileDelete(file.name)">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </form>

        <hr />

    </div>
    <script src="/lib/folder.js"></script>
</body>