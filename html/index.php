<?php

use \Slim\Middleware\HttpBasicAuthentication\AuthenticatorInterface;

require '../start-up.php';
require '../admin-passwords.php';

class HashedAuthenticator implements AuthenticatorInterface {
    public $TEST = 123;
    public function __invoke(array $arguments) {
      die('wtf');
        return true;
    }
}

$appcfg = [
    'mode' => 'production',
    'templates.path' => './templates'
];

$app = new \Slim\Slim($appcfg);

$auth_options = [
    "path" => "/admin",
    "realm" => "Protected",
    "secure" => false,
    "users" => $users,
    "authenticator" => new HashedAuthenticator()
];

$app->add(new \Slim\Middleware\HttpBasicAuthentication($auth_options));

/**
 * /admin
 * admin pages
 */

// API group
$app->group('/admin', function () use ($app) {

    $app->map('/', function () use ($app) {

        $site  = new \Curatorial\Site;
        $pages = $site->getPages();

        $data = array(
            'page'  => 'pages',
            'pages' => json_encode($pages)
        );
        $app->render('admin/admin.php', $data);

    })->via('GET', 'POST');

    /** specific page */
    $app->get('/test-show', function () use ($app) {

        $site = new \Curatorial\Site;
        $page = new \Curatorial\Page("test-show", false);
        $tpls = \Curatorial\Templates::getTemplates();

        $data = array(
            'page'     => 'main',
            'archives' => json_encode($site->getArchives()),
            'data'     => json_encode($page),
            'tpls'     => json_encode($tpls)
        );
        $app->render('public/main.php', $data);

    });

    /** pages list */
    $app->map('/logout', function () use ($app) {

        header('Location: http://logout@curatorialprojects.brooklynrail.org/');

    })->via('GET', 'POST');


    /** page add (ajax) */
    $app->post('/page/add', function () use ($app) {

        $post = json_decode($app->request->getBody());

        $site   = new \Curatorial\Site;
        $result = $site->addPage($post->name, $post->description);

        echo json_encode($result);

    });

    /** page edit (gui) */
    $app->get('/page/get/:permalink', function ($permalink) use ($app) {

        $page      = new \Curatorial\Page($permalink);
        echo json_encode($page);

    });

    /** page edit (gui) */
    $app->get('/page/:permalink', function ($permalink) use ($app) {

        $site      = new \Curatorial\Site;
        $page      = new \Curatorial\Page($permalink);
        $templates = \Curatorial\Templates::getTemplates();

        $data = array(
            'page'      => 'page_edit',
            'templates' => json_encode($templates),
            'data'      => json_encode($page)
        );
        $app->render('admin/main.php', $data);

    });

    /** page section save (ajax) */
    $app->post('/section_save/:permalink/:index', function ($permalink, $index) use ($app) {

        $post = json_decode($app->request->getBody());

        $section = new \Curatorial\Section($permalink, $index);
        $section->merge($post);
        $section->save();

        echo json_encode($section);

    });

    /**
     * /admin/folders
     * list of file folders for different pages, with links through to folder page
     */

    /** folders interaction gui */
    $app->get('/folders', function () use ($app) {

        $folders = new \Curatorial\Folders;
        $folders = $folders->getFolders();

        $data = array(
            'page' => 'folders',
            'folders' => json_encode($folders)
        );
        $app->render('admin/admin.php', $data);
    });

    /** add a folder (ajax) */
    $app->post('/folders/add', function () use ($app) {

        $post = json_decode($app->request->getBody());

        $folders = new \Curatorial\Folders;
        $result = $folders->addFolder($post->title, $post->description);

        echo json_encode($result);
    });

    /** folders get (ajax) */
    $app->get('/folders/get', function(){
        $folders = new \Curatorial\Folders();
        $data = $folders->getFolders();
        echo json_encode($data);
    });

    /** remove folder (not working) */
    $app->post('/folders/remove', function () use ($app) {

        $folders = new \Curatorial\Folders;

    });

    /** folder interaction gui */
    $app->get('/folders/:name', function($name) use ($app) {

        $folder = new \Curatorial\Folder($name);

        $data = array(
             'page'   => 'folder',
             'folder' => json_encode($folder),
        );
        $app->render('admin/admin.php', $data);

    });

    /** folder get (ajax) */
    $app->get('/folder/get/:name', function($name){

        $folder = new \Curatorial\Folder($name);
        echo json_encode($folder);

    });

    /** upload single or group of files (ajax) */
    $app->map('/files/upload', function() use ($app){

        $folder = $app->request->params('folder');
        if(!$folder) throw new Exception('A folder name is required.');

        $config = new \Flow\Config();
        $config->setTempDir(rtrim(HOMEPATH . TMP, "/"));
        $request = new \Flow\Request();
        if (\Flow\Basic::save(HOMEPATH . CONTENT . $folder . '/' . $request->getFileName(), $config, $request)) {
            // file saved successfully and can be accessed at filepath described above
        } else {
            // This is not a final chunk or request is invalid, continue to upload.
        }

        if (1 == mt_rand(1, 100))
            \Flow\Uploader::pruneChunks(TMP);

    })->via('GET', 'POST');

    /** delete single file from folder (ajax) */
    $app->post('/folder/file_delete', function() use ($app){

        $post = json_decode($app->request->getBody());

        if(!$post->folder)   throw new Exception('A folder name is required.');
        if(!$post->filename) throw new Exception('A file name is required.');

        $folder = new \Curatorial\Folder($post->folder);
        $result = $folder->fileDelete($post->filename);

        return json_encode($result);

    });

    /** save file caption (ajax) */
    $app->post('/folder/file_caption_save', function() use ($app){

        $post = json_decode($app->request->getBody());

        if(!$post->folder)   throw new Exception('A folder name is required.');
        if(!$post->filename) throw new Exception('A file name is required.');

        $folder = new \Curatorial\Folder($post->folder);
        $result = $folder->saveCaption($post->filename, $post->caption);

        return json_encode($result);

    });

});

/**
 * /
 * public pages
 * public pages last because of fall-through
 */

/** home page */
$app->get('/', function () use ($app) {

    $site = new \Curatorial\Site;
    $page = new \Curatorial\Page;
    $tpls = \Curatorial\Templates::getTemplates();

    $data = array(
        'page'     => 'main',
        'archives' => json_encode($site->getArchives()),
        'data'     => json_encode($page),
        'tpls'     => json_encode($tpls)
    );
    $app->render('public/main.php', $data);

});

/** specific page */
$app->get('/:permalink', function ($permalink) use ($app) {

    $site = new \Curatorial\Site;
    $page = new \Curatorial\Page($permalink, true);
    $tpls = \Curatorial\Templates::getTemplates();

    $data = array(
        'page'     => 'main',
        'archives' => json_encode($site->getArchives()),
        'data'     => json_encode($page),
        'tpls'     => json_encode($tpls)
    );
    $app->render('public/main.php', $data);

});

/**
 * go
 */

$app->run();
