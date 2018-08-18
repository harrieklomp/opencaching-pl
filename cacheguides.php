<?php

use Utils\Database\XDb;
use Utils\Uri\SimpleRouter;

if (!isset($rootpath))
    $rootpath = '';
require_once('./lib/common.inc.php');
//Preprocessing
if ($error == false) {
    //user logged in?
    if ($usr == false) {
        $target = urlencode(tpl_get_current_page());
        tpl_redirect('login.php?target=' . $target);
    } else {

        $tplname = 'cacheguides';

        $uLat = XDb::xSimpleQueryValue("SELECT `user`.`latitude`  FROM `user` WHERE `user_id`='" . XDb::xEscape($usr['userid']) . "'", 0);
        $uLon = XDb::xSimpleQueryValue("SELECT `user`.`longitude`  FROM `user` WHERE `user_id`='" . XDb::xEscape($usr['userid']) . "'", 0);

        if (($uLat == NULL || $uLat == 0) && ($uLon == NULL || $uLon == 0)) {
            tpl_set_var('mapzoom', 6);
            tpl_set_var('mapcenterLat', $main_page_map_center_lat);
            tpl_set_var('mapcenterLon', $main_page_map_center_lon);
        } else {
            tpl_set_var('mapzoom', 11);
            tpl_set_var('mapcenterLat', $uLat);
            tpl_set_var('mapcenterLon', $uLon);
        }

        $rscp = XDb::xSql(
            "SELECT `user`.`latitude` `latitude`,`user`.`longitude` `longitude`,`user`.`username` `username`,
                    `user`.`user_id` `userid` FROM `user`
             WHERE `user`.`guru`!=0
                AND (
                    user.user_id IN (
                        SELECT cache_logs.user_id FROM cache_logs
                        WHERE `cache_logs`.`type`=1 AND `cache_logs`.`date_created`>DATE_ADD(NOW(), INTERVAL -90 DAY)
                    )
                    OR user.user_id IN (
                        SELECT caches.user_id FROM caches
                        WHERE `caches`.`status` IN (1, 2, 3)
                            AND `caches`.`date_created`>DATE_ADD(NOW(), INTERVAL -90 DAY)
                    )
                )
                AND `user`.`is_active_flag` != 0
                AND `user`.`longitude` IS NOT NULL
                AND `user`.`latitude` IS NOT NULL GROUP BY user.username");

        $point = "";
        $nrows = 0;
        while($record = XDb::xFetchArray($rscp)) {
            $username = $record['username'];
            $y = $record['longitude'];
            $x = $record['latitude'];

            $nrec = XDb::xSql("SELECT COUNT('cache_id') as ncaches, SUM(topratings) as nrecom
                               FROM caches WHERE `caches`.`type` <> 6
                                    AND caches.status NOT IN (4, 5, 6)
                                    AND `caches`.`user_id`= ? ", $record['userid']);
            $nr = XDb::xFetchArray($nrec);
            if ($nr['nrecom'] != NULL && $nr['nrecom'] >= 20) {
                $point.="addMarker(" . $x . "," . $y . "," . $record['userid'] . ",'" . $username . "'," . $nr['nrecom'] . ",'" . SimpleRouter::getLink('UserProfile','mailTo', $record['userid']) . "');\n";
                $nrows++;
            }
        }

        tpl_set_var('nguides', $nrows);
        tpl_set_var('points', $point);

        XDb::xFreeResults($rscp);

        $view->loadGMapApi();
    }
}

tpl_set_var('serverURL', $absolute_server_URI);
tpl_BuildTemplate();
