<?php
namespace Controllers\Admin;

use Controllers\BaseController;
use lib\Objects\CacheSet\CacheSet;
use lib\Objects\ChunkModels\ListOfCaches\Column_CacheSetNameAndIcon;
use lib\Objects\ChunkModels\ListOfCaches\ListOfCachesModel;
use lib\Objects\ChunkModels\ListOfCaches\Column_SimpleText;

class CacheSetAdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        // this controller is only for Admins
        if(!$this->isUserLogged()){
            $this->redirectToLoginPage();
            exit;
        }

        /* !!!temporary disabled for tests:

        if(!$this->loggedUser->isAdmin()){
            $this->view->redirect('/');
            exit;
        }
        */

    }

    public function index()
    {

    }

    /**
     * Display list of cacheSets(geopaths) which should be archived because
     * the number of active caches is lower than number requested for completion.
     */
    public function cacheSetsToArchive()
    {
        $this->view->setTemplate('admin/cacheSet/cacheSetsToArchive');
        $this->view->loadJQuery();

        $csToArchive = CacheSet::getCacheSetsToArchive();

        if( empty($csToArchive)){
            $this->view->setVar('noCsToArchive', true);
            $this->view->buildView();
            exit;
        }

        // prepare model for list of watched caches
        $listModel = new ListOfCachesModel();
        $listModel->addColumn(
            new Column_CacheSetNameAndIcon( 'geoscieżka',
                function($row){
                    return [
                        'id' => $row['id'],
                        'type' => $row['type'],
                        'name' => $row['name']
                    ];
                }));
        $listModel->addColumn(
            new Column_SimpleText( 'current', function($row){
                return round($row['currentRatio']).'%';
            }));

        $listModel->addColumn(
            new Column_SimpleText( 'expected', function($row){
                return round($row['ratioRequired']).'%';
            }));

        $listModel->addDataRows($csToArchive);
        $this->view->setVar('listOfCssToArchiveModel', $listModel);


        $this->view->buildView();

    }
}

