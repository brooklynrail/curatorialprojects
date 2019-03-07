<?php

namespace Curatorial;

/**

{ 
    "name" : "folder-name", 
    "title" : "Folder Name", 
    "description" : 
    "blah blah blah", 
    "files" : [
       { 
            "abspath"  : "/home/curatorialprojects.brooklynrail.org/content/folder/filename.jpg",
            "webpath"  : "/content/folder/filename.jpg",
            "basename" : "filename.jpg",
            "caption"  : "caption is this."
        }, 
        { 
            "abspath"  : "/home/curatorialprojects.brooklynrail.org/content/folder/filename.jpg",
            "webpath"  : "/content/folder/filename.jpg",
            "basename" : "filename.jpg"
        },         
    ] 
}
 */
class Folder
{

    public $name;
    public $title;
    public $description;
    public $files = array();
    public $data  = array();
    
    private $errors;
    
    public function __construct($name){
        
        if(!file_exists($this->dataFile()))
            touch($this->dataFile());
        
        $folder = new \stdClass;
        
        $folders = new Folders;
        $folder_data = $folders->getFolderData();
        
        if(!isset($folder_data->$name)) 
            self::failure("Folder does not exist. You tried to select {$name}.");
        else $folder = $folder_data->$name;
        
        $this->name        = $name;
        $this->title       = $folder->title;
        $this->description = $folder->description;
        $this->files       = $this->getFiles();
        $this->data        = $this->getFilesData();
    }
    
    public function getFiles(){
        
        $files = [];
        $globs = glob($this->thisDir() . '*');
        
        foreach($globs as $k => $glob){
            
            if($glob == $this->dataFile()) continue;
            
            $file = new \stdClass;
            $file->abspath  = $glob;
            $file->name     = basename($glob);
            $file->webpath  = WEBCONTENT . $this->name . '/' . basename($glob);
            $file->caption  = $this->getCaption(basename($glob));
            $file->size     = filesize($glob);
            $file->added    = date("m/d/Y H:i:s", filemtime($glob));
            $imagesize = getimagesize($glob);
            $file->imagesize = $imagesize[0] . "px x " . $imagesize[1] . "px";            
            
            $files[] = $file;
        }
        
        $this->saveFilesData($files);

        return $files;
    }

    public function getFilesData(){
        $json = file_get_contents($this->dataFile());
        if($json === false){
            $data = array();
        }else{
            if(trim($json) == '') $json = '[]';
            $data = json_decode($json);
        }
        return $data; 
    }
    
    public function saveFilesData($data){
    
        $this->data = $data;    
        $data = json_encode($data);
        $put_contents = file_put_contents(self::dataFile(), $data, LOCK_EX);
        return $put_contents;
    }    
    
    public function fileDelete($filename){
        
        $abspath = $this->thisDir() . $filename;
        
        if(!$filename) $this->failure("No filename given.");
        if(!file_exists($abspath))
            $this->failure("File does not exist.");
        if($abspath == $this->thisDir())
            $this->failure("Do not delete the whole directory.");
        if($abspath == $this->contentDir())
            $this->failure("Do not delete the content directory.");
        
        // delete file
        $did_delete = unlink($abspath);
        if(!$did_delete) $this->failure("File did not delete.");
        
        // remove from folder data
        $data = $this->getFilesData();
        foreach($data as $k => $file){
            if($file->name == $filename)
                unset($folder_data[$k]);
        }
        $this->data = $data;
        $data = json_encode($data);
        $put_contents = file_put_contents($this->dataFile(), $data, LOCK_EX);
        
        $this->success($this->getFiles());
    }    

    /**
     * captions
     */

    public function getCaption($filename){
        return '';
    }
    
    public function saveCaption($filename, $caption){
        $data = $this->getFilesData();
        foreach($data as $k => $file){
            if($file->name == $filename)
                $data[$k]->caption = $caption;
        }
        $did_save = $this->saveFilesData($data);
        if($did_save) $this->success($this->getFiles());
        else          $this->failure("Could not save caption to file.");
    }    

    /**
     * success/failure
     */

    private static function success($data){
        $result = new \stdClass;
        $result->success = true;
        $result->data    = $data;
        die(json_encode($result));
    }

    private static function failure($message){
        $result = new \stdClass;
        $result->success = false;
        $result->message = $message;
        die(json_encode($result));
    }
     
    /**
     * directory and file paths
     */
    private function tmpDir(){
        return HOMEPATH . TMP;
    }
    
    private function contentDir(){
        return HOMEPATH . CONTENT;
    }
    
    private function thisDir(){
        return HOMEPATH . CONTENT . $this->name . '/';
    }    
    
    private function dataFile(){
        return HOMEPATH . CONTENT . $this->name . '/' . DATAFILE;
    }
    
}
