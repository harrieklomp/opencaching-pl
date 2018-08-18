<?php

use Utils\Database\OcDb;
use Utils\Generators\Uuid;
/**
 *
 */
class powerTrailController {

    private $debug = true;
    private $action;
    private $user;
    private $userPTs;
    private $ptAPI;
    private $allSeries;

    private $powerTrailDbRow;
    private $ptOwners;
    private $areOwnSeries = false;

    function __construct($user)
    {
        if(isset($_REQUEST['ptAction'])) {
            $this->action = $_REQUEST['ptAction'];
        } else {
            $this->action = 'showAllSeries';
        }


        $this->ptAPI = new powerTrailBase;
        $this->user = $user;
    }

    public function run()
    {
        switch ($this->action) {
            case 'mySeries':
                $this->mySeries();
                break;
            case 'selectCaches':
                $this->getUserPTs();
                return $this->getUserCachesToChose();
                break;
            case 'createNewPowerTrail':
                $this->createNewPowerTrail();
                break;
            case 'showAllSeries':
                $this->getAllPowerTrails();
                break;
            case 'showSerie':
                //$this->getPowerTrailCaches();
                break;
            default:
                $this->getAllPowerTrails();
                break;
        }
    }

    private function mySeries(){
        // print $_SESSION['user_id'];
        $q = 'SELECT * FROM `PowerTrail` WHERE id IN (SELECT `PowerTrailId` FROM `PowerTrail_owners`
                WHERE `userId` = :1 ) ORDER BY cacheCount DESC';
        $db = OcDb::instance();
        $s = $db->multiVariableQuery($q, $_SESSION['user_id']);
        $this->allSeries = $db->dbResultFetchAll($s);
        $this->action = 'showMySeries';
        $this->areOwnSeries = true;

    }

    private function getAllPowerTrails() {
        // sort by
        if(isset($_REQUEST['sortBy'])) {
            switch ($_REQUEST['sortBy']) {
                case 'type':
                    $sortBy = 'type';
                    break;
                case 'name':
                    $sortBy = 'name';
                    break;
                case 'dateCreated':
                    $sortBy = 'dateCreated';
                    break;
                case 'cacheCount':
                    $sortBy = 'cacheCount';
                    break;
                case 'points':
                    $sortBy = 'points';
                    break;
                case 'conquestedCount':
                    $sortBy = 'conquestedCount';
                    break;
                default:
                    $sortBy = 'cacheCount';
                    break;
            }
        } else {
            $sortBy = 'cacheCount';
        }

        // filters here
        if(isset($_REQUEST['filter'])) {
            $filterValue = (int) $_REQUEST['filter'];
            switch ($_REQUEST['filter']) {
                case '0':
                    $filter = ' ';
                    break;
                default:
                    $filter = " AND type = $filterValue ";
                    break;
            }
        } else {
            $filter = ' ';
        }

        // order (as var for future use)
        if(isset($_REQUEST['sortDir'])){
            switch ($_REQUEST['sortDir']) {
                case 'asc':
                    $sortOder = 'ASC';
                    break;
                case 'desc':
                    $sortOder = 'DESC';
                    break;
                default:
                    $sortOder = 'DESC';
                    break;
            }
        } else {
            $sortOder = 'DESC';
        }
        if(isset($_REQUEST['historicLimitBool']) && $_REQUEST['historicLimitBool']==="no") {
            $cacheCountLimit = powerTrailBase::historicMinimumCacheCount();
        } else {
            $cacheCountLimit = powerTrailBase::minimumCacheCount();
        }
        $userid = $this->user['userid'];
        if(isset($_REQUEST['myPowerTrailsBool']) && isset($userid) && $_REQUEST['myPowerTrailsBool']==="yes") {
            $myTrailsCondition = "and `id` NOT IN (SELECT `PowerTrailId` FROM `PowerTrail_owners`
            WHERE `userId` = $userid)";
        } else {
            $myTrailsCondition = "";
        }
        if(isset($_REQUEST['gainedPowerTrailsBool']) && isset($userid) && $_REQUEST['gainedPowerTrailsBool']==="yes") {
            $gainedTrailsCondition = "and `id` NOT IN (SELECT `PowerTrailId` FROM `PowerTrail_comments`
            WHERE `userId` = $userid and `commentType` = 2)";
        } else {
            $gainedTrailsCondition = "";
        }
        $q = 'SELECT * FROM `PowerTrail` WHERE `status` = 1 '.$myTrailsCondition.' '.$gainedTrailsCondition.'
        and cacheCount >= :1 '.$filter.' ORDER BY '.$sortBy.' '.$sortOder.' ';
        $db = OcDb::instance();
        $s = $db->multiVariableQuery($q, $cacheCountLimit);
        $this->allSeries = $db->dbResultFetchAll($s);
    }

    public function getPtOwners()
    {
        return $this->ptOwners;
    }

    public function getPowerTrailDbRow()
    {
        return $this->powerTrailDbRow;
    }

    public function getPowerTrailOwn() {
        return $this->areOwnSeries;
    }

    public function getAllCachesOfPt()
    {
        return $this->allCachesOfSelectedPt;
    }

    public function getUserPowerTrails()
    {
        return $this->userPTs;
    }

    public function getActionPerformed()
    {
        return $this->action;
    }

    public function getpowerTrails()
    {
        return $this->allSeries;
    }

    public function getDisplayedPowerTrailsCount() {
        return count($this->allSeries);
    }

    private function createNewPowerTrail()
    {
        if(!isset($_SESSION['user_id'])){ /* user is not logged in */
            return false;
        }
        $this->action = 'createNewSerie';
        if(isset($_POST['powerTrailName']) && $_POST['powerTrailName'] != '' && $_POST['type'] != 0 && $_POST['status'] != 0 && $_SESSION['powerTrail']['userFounds'] >= powerTrailBase::userMinimumCacheFoundToSetNewPowerTrail())
        {
            $query = "INSERT INTO `PowerTrail`
                       (`name`, `type`, `status`, `dateCreated`, `cacheCount`, `description`, `perccentRequired`, uuid)
                       VALUES (:1,:2,:3,NOW(),0,:4,:5, ".Uuid::getSqlForUpperCaseUuid().")";
            $db = OcDb::instance();
            if ($_POST['dPercent'] < \lib\Controllers\PowerTrailController::MINIMUM_PERCENT_REQUIRED) {
                $_POST['dPercent'] = \lib\Controllers\PowerTrailController::MINIMUM_PERCENT_REQUIRED;
            }
            $db->multiVariableQuery($query, strip_tags($_POST['powerTrailName']),(int) $_POST['type'], (int) $_POST['status'], htmlspecialchars($_POST['description']), (int) $_POST['dPercent']);
            $newProjectId = $db->lastInsertId();
            // exit;
            $query = "INSERT INTO `PowerTrail_owners`(`PowerTrailId`, `userId`, `privileages`) VALUES (:1,:2,:3)";
            $db->multiVariableQuery($query, $newProjectId, $this->user['userid'], 1);
            $logQuery = 'INSERT INTO `PowerTrail_actionsLog`(`PowerTrailId`, `userId`, `actionDateTime`, `actionType`, `description`) VALUES (:1,:2,NOW(),1,:3)';
            $db->multiVariableQuery($logQuery, $newProjectId,$this->user['userid'] ,$this->ptAPI->logActionTypes[1]['type']);
            header("location: powerTrail.php?ptAction=showSerie&ptrail=$newProjectId");
            return true;
        }
        else
        {
            return false;
        }

    }

    private function getUserCachesToChose()
    {
        $query = "SELECT cache_id, wp_oc, PowerTrailId, name FROM `caches` LEFT JOIN powerTrail_caches ON powerTrail_caches.cacheId = caches.cache_id WHERE caches.status NOT IN (3,6) AND `user_id` = :1";
        $db = OcDb::instance();
        $s = $db->multiVariableQuery($query, $this->user['userid']);
        $userCaches = $db->dbResultFetchAll($s);

        return $userCaches;
    }

    private function getUserPTs()
    {
        $query = "SELECT * FROM `PowerTrail`, PowerTrail_owners  WHERE  PowerTrail_owners.userId = :1 AND PowerTrail_owners.PowerTrailId = PowerTrail.id";
        $db = OcDb::instance();
        $s = $db->multiVariableQuery($query, $this->user['userid']);
        $userPTs = $db->dbResultFetchAll($s);

        $this->userPTs = $userPTs;
    }



    public function debug($var, $name=null, $line=null)
    {
        //if($this->debug === false) return;
        print '<font color=green><b>#'.$line."</b> $name, </font>(".__FILE__.") <pre>";
        print_r($var);
        print '</pre>';
    }
}
