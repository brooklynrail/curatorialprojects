<?php

namespace Curatorial;

/**
 * {
 *   "folder-name"     : { "title" : "Folder Name",     "description" : "blah blah blah"      },
 *   "folder-name-two" : { "title" : "Folder Name Two", "description" : "more blah blah blah" } 
 * }
 */
class Folders
{
    const HOMEPATH = "/home/14056/users/.home/domains/curatorialprojects.brooklynrail.org/";
    const TMP      = "tmp/";
    const CONTENT  = "html/content/"; 
    const DATAFILE = "data.json";     

    public $folders;
    
    private $errors;
    
    public function getFolders(){
        
        $folders = new \stdClass;
        $dirs    = array_filter(glob(self::contentDir() . '*'), 'is_dir');
        $data    = self::getFolderData();
        
        foreach($dirs as $dir){
            
            $dir = basename($dir);
            
            $folder = new \stdClass;
            $folder->name        = $dir;
            $folder->title       = @$data->$dir->title;
            $folder->description = @$data->$dir->description;
            $folders->$dir = $folder;
        }
        
        $this->folders = $folders;
        
        return $folders; 
           
    }

    public function getFolderData(){
        $json = file_get_contents(self::dataFile());
        if($json){
            if($json == '') $json = '{}';
            $data = json_decode($json);
        }else{
            $data = new \stdClass();
        }
        return $data; 
    }

    public function addFolder($title, $description){
        
        $name   = Helpers::slugify($title);
        
        if(!$name) return self::failure("You must give a name to the folder.");
        
        $folder = self::contentDir() . $name;
        
        // check for pre-existing
        if(file_exists($folder))
            return self::failure("Folder name already exists! Input {$title} was converted to {$name} which already exists.");
        else{
            $made_dir = mkdir($folder, 0755);
            if(!$made_dir) return self::failure("Folder could not be created because of a server error.");
            touch($folder . DATAFILE); // add data.json
        }
        
        $added_data = $this->addFolderData($name, $title, $description);
        if($added_data === false){
            if(self::contentDir() != $folder && strlen($folder) > strlen(self::contentDir())){
                //rmdir($folder);
            }
            return self::failure("Could not write data because of a server error.");
        }
        
        return self::success($this->getFolders());
    }
    
    public function addFolderData($name, $title, $description){
        
        $data    = self::getFolderData();
        
        $folder_data = new \stdClass();
        $folder_data->name        = $name;
        $folder_data->title       = $title;
        $folder_data->description = $description;        

        $data->$name = $folder_data;
     
        $data = json_encode($data);
        
        $put_contents = file_put_contents(self::dataFile(), $data, LOCK_EX);
    
        return $put_contents;
    }   

    private static function success($data){
        $result = new \stdClass;
        $result->success = true;
        $result->data    = $data;
        return $result;
    }

    private static function failure($message){
        $result = new \stdClass;
        $result->success = false;
        $result->message = $message;
        return $result;
    }
     
    /**
     * directory and file paths
     */
    private static function tmpDir(){
        return HOMEPATH . TMP;
    }
    
    private static function contentDir(){
        return HOMEPATH . CONTENT;
    }
    
    private static function dataFile(){
        return HOMEPATH . CONTENT . DATAFILE;
    }
    
}
