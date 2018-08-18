<?php
exit; //this file shouldn't be used anywhere!

/**
 * This is old menu configuration
 * This is here only as reference fro nods admins.
 *
 * This file will be removed soon
 */

$menu = array(
    array( //not-logged menu - called from main.tpl
        'title' => tr('mnu_mainPage'),
        'menustring' => tr('mnu_mainPage'),
        'siteid' => array('start', 'articles/impressum'),
        'visible' => true,
        'filename' => 'index.php',
        'submenu' => array(
            array( //called from main.tpl
                'title' => tr('mnu_registration'),
                'menustring' => tr('mnu_registration'),
                'visible' => true,
                'filename' => 'register.php',
                'siteid' => 'register',
                'submenu' => array(
                    array(
                        'title' => tr('account_activation'),
                        'menustring' => tr('account_activation'),
                        'visible' => false,
                        'filename' => 'activation.php',
                        'siteid' => 'activation'
                    ),
                    array(
                        'title' => tr('account_activation'),
                        'menustring' => tr('account_activation'),
                        'visible' => false,
                        'filename' => 'activation.php',
                        'siteid' => 'activation_confirm'
                    )
                )
            ),
            array(
                'title' => tr('mnu_news'),
                'menustring' => tr('mnu_news'),
                'visible' => true,
                'filename' => 'news.php',
                'siteid' => 'news/newsList'
            ),
            array(
                'title' => tr('mnu_newCaches'),
                'menustring' => tr('mnu_newCaches'),
                'visible' => true,
                'filename' => 'newcaches.php',
                'siteid' => 'newcaches',
                'submenu' => array(
                    array(
                        'title' => tr($SiteOutsideCountryString),
                        'menustring' => tr($SiteOutsideCountryString),
                        'visible' => true,
                        'onlylogged' => true,
                        'filename' => 'newcachesrest.php',
                        'siteid' => 'newcachesrest'
                    )
                )
            ),
            array(
                'title' => tr('mnu_newLogs'),
                'menustring' => tr('mnu_newLogs'),
                'visible' => true,
                'filename' => 'newlogs.php',
                'siteid' => 'newlogs'
            ),
            array(
                'title' => tr('mnu_incommingEvents'),
                'menustring' => tr('mnu_incommingEvents'),
                'visible' => true,
                'filename' => 'newevents.php',
                'siteid' => 'newevents'
            ),
            array(
                'title' => tr('mnu_cacheMap'),
                'menustring' => tr('mnu_cacheMap'),
                'siteid' => 'cachemap3',
                'visible' => true,
                'onlylogged' => true,
                'filename' => 'cachemap3.php',
                'submenu' => array(
                    array(
                        'title' => tr('mnu_oldCacheMap'),
                        'menustring' => tr('mnu_oldCacheMap'),
                        'siteid' => 'cachemap2',
                        'visible' => $config['map2SwithedOn'],
                        'onlylogged' => true,
                        'filename' => 'cachemap2.php'
                    ),
                    array(
                        'title' => tr('mnu_FloppMap'),
                        'menustring' => tr('mnu_FloppMap'),
                        'siteid' => 'flopmap2',
                        'visible' => $config['FloppSwithedOn'],
                        'onlylogged' => true,
                        'filename' => 'http://www.flopp-caching.de',
                        'newwindow' => true
                    ),
                    array(
                        'title' => tr('logmap_04'),
                        'menustring' => tr('logmap_04'),
                        'siteid' => 'logmap',
                        'visible' => true,
                        'onlylogged' => true,
                        'filename' => 'logmap.php'
                    )
                )
            ),
            array(
                'title' => tr('mnu_searchCache'),
                'menustring' => tr('mnu_searchCache'),
                'siteid' => 'search',
                'onlylogged' => true,
                'visible' => true,
                'filename' => 'search.php'
            ),
            array(
                'title' => tr('mnu_recoCaches'),
                'menustring' => tr('mnu_recoCaches'),
                'visible' => true,
                'onlylogged' => true,
                'filename' => 'cacheratings.php',
                'siteid' => 'cacheratings'
            ),
            array(
                'title' => tr('mnu_statistics'),
                'menustring' => tr('mnu_statistics'),
                'visible' => true,
                'onlylogged' => true,
                'filename' => 'articles.php?page=stat',
                'siteid' => array(
                    'articles/stat',
                    'articles/s1',
                    'articles/s1b',
                    'articles/s2',
                    'articles/s3',
                    'articles/s4',
                    'articles/s5',
                    'articles/s6',
                    'articles/s7',
                    'articles/s8',
                    'articles/s9',
                    'articles/s11a',
                    'articles/s12',
                    'articles/s102'
                )
            ),
            array(
                'title' => tr('mnu_rules'),
                'menustring' => tr('mnu_rules'),
                'visible' => isset($wikiLinks['rules']) ? true : false,
                'filename' => @$wikiLinks['rules'],
                'newwindow' => true,
                'siteid' => 'articles/regulamin'
            ),
            array(
                'title' => tr('mnu_links'),
                'menustring' => tr('mnu_links'),
                'siteid' => 'links',
                'navicolor' => '#FFFFC5',
                'visible' => false,
                'filename' => 'articles.php?page=links'
            ),
            array(
                'title' => tr('mnu_geoPaths'),
                'menustring' => tr('mnu_geoPaths'),
                'siteid' => 'powerTrail',
                'visible' => $powerTrailModuleSwitchOn,
                'filename' => 'powerTrail.php',
                'submenu' => array(
                    array(
                        'title' => tr('cs_wikiLink'),
                        'menustring' => tr('cs_wikiLink'),
                        'siteid' => 'geoSciezkiFAQ',
                        'visible' => $powerTrailModuleSwitchOn,
                        'filename' => $powerTrailFaqLink, //kojoty: currently $links[wiki][geopath]
                    ),),
            )
        )
    ),
    array(
        'title' => tr('mnu_abcOfGCaching'),
        'menustring' => tr('mnu_abcOfGCaching'),
        'siteid' => 'articles/info',
        'visible' => isset($wikiLinks['main']) ? true : false,
        'filename' => @$wikiLinks['main'],
        'newwindow' => true
    ),
    array(
        'title' => tr('forum'),
        'menustring' => tr('mnu_forum'),
        'siteid' => 'forum',
        'visible' => isset($forum_url) ? true : false,
        'filename' => $forum_url,
        'newwindow' => true
    ),
    array(
        'title' => 'Blog',
        'menustring' => 'Blog',
        'siteid' => 'blog',
        'visible' => isset($blogsite_url) ? true : false,
        'filename' => $blogsite_url,
        'newwindow' => true
    ),
    array(
        'title' => 'IRC',
        'menustring' => 'IRC',
        'siteid' => 'irc',
        'visible' => false,
        'filename' => isset($usr['username']) ? 'http://webchat.freenode.net/?nick=' . $usr['username'] . '&amp;channels=opencaching.pl&amp;prompt=1' : '',
        'newwindow' => true
    ),
    array(
        'title' => tr('mnu_geokrets'),
        'menustring' => tr('mnu_geokrets'),
        'siteid' => 'GeoKrety',
        'visible' => isset($config['geokrety_url']) ? true : false,
        'filename' => $config['geokrety_url'],
        'newwindow' => 'true'
    ),
    array(
        'title' => 'GeoCoin',
        'menustring' => 'GeoCoin',
        'siteid' => 'GeoCoin',
        'visible' => false,
        'filename' => 'http://opengeocoin.org/pl/',
        'newwindow' => 'true'
    ),
    array(
        'title' => 'Download',
        'menustring' => 'Download',
        'siteid' => 'Download',
        'visible' => isset($wikiLinks['downloads']) ? true : false,
        'filename' => @$wikiLinks['downloads'],
        'newwindow' => 'true'
    ),
    array(
        'title' => tr('mnu_links'),
        'visible' => true,
        'filename' => 'articles.php?page=links',
        'menustring' => tr('mnu_links'),
        'siteid' => 'articles/links'
    ),
    array(
        'title' => tr('mnu_contact'),
        'visible' => true,
        'filename' => 'articles.php?page=contact',
        'menustring' => tr('mnu_contact'),
        'siteid' => 'articles/contact'
    ),
    array(
        'title' => tr('mnu_guides'),
        'menustring' => tr('mnu_guides'),
        'visible' => true,
        'filename' => 'cacheguides.php',
        'siteid' => 'cacheguides'
    ),
    array(
        'title' => 'shop',
        'menustring' => 'shop',
        'siteid' => 'shop',
        'visible' => $config['showShopButton'],
        'filename' => $config['showShopButtonUrl'],
        'newwindow' => 'true'
    ),
    array( //called from main.tpl
        'title' => tr('mnu_clipboard'),
        'menustring' => tr('mnu_clipboard'),
        'siteid' => 'mylist',
        'visible' => false,
        'filename' => 'mylist.php'
    ),
    array(
        'title' => tr('login'),
        'visible' => false,
        'filename' => 'login.php',
        'menustring' => tr('login'),
        'navicolor' => '#E8DDE4',
        'siteid' => 'login'
    ),
    array(
        'title' => tr('add_picture'),
        'visible' => false,
        'filename' => 'newpic.php',
        'menustring' => tr('add_picture'),
        'siteid' => 'newpic'
    ),
    array(
        'title' => tr('edit_picture'),
        'visible' => false,
        'filename' => 'editpic.php',
        'menustring' => tr('edit_picture'),
        'siteid' => 'editpic'
    ),
    array(
        'title' => tr('new_password'),
        'visible' => false,
        'filename' => 'newpw.php',
        'menustring' => tr('new_password'),
        'siteid' => 'newpw'
    ),
    array(
        'title' => tr('page_error'),
        'menustring' => tr('page_error'),
        'visible' => false,
        'filename' => 'index.php',
        'siteid' => 'error'
    ),
    array(
        'title' => tr('mnu_contact'),
        'visible' => false,
        'filename' => 'articles.php?page=contact',
        'menustring' => tr('mnu_contact'),
        'siteid' => 'articles/contact'
    ),
    array(
        'title' => tr('personal_data'),
        'visible' => false,
        'filename' => 'articles.php?page=dsb',
        'menustring' => tr('personal_data'),
        'siteid' => 'articles/dsb'
    ),
    array(
        'title' => tr('message'),
        'visible' => false,
        'filename' => 'index.php',
        'menustring' => tr('message'),
        'siteid' => 'message'
    ),
    array(
        'title' => tr('register_confirm'),
        'visible' => false,
        'filename' => 'register.php',
        'menustring' => tr('register_confirm'),
        'siteid' => 'register_confirm'
    ),
    array(
        'title' => tr('mnu_cacheMap'),
        'visible' => false,
        'filename' => 'cachemap.php',
        'menustring' => tr('mnu_cacheMap'),
        'siteid' => 'mapa1'
    ),
    array(
        'title' => tr('mnu_mainPage'),
        'visible' => false,
        'filename' => 'index.php',
        'menustring' => tr('mnu_mainPage'),
        'siteid' => 'sitemap'
    ),
    array(
        'title' => tr('add_newmp3'),
        'visible' => false,
        'filename' => 'newmp3.php',
        'menustring' => tr('add_newmp3'),
        'siteid' => 'newmp3'
    ),
    // OC management
    array(
        'title' => tr('administration'),
        'menustring' => tr('administration'),
        'siteid' => 'viewreports',
        'visible' => false,
        'filename' => '',
        'submenu' => array(
            array(
                'title' => tr('mnu_reports'),
                'menustring' => tr('mnu_reports'),
                'siteid' => ['admin/reports_list', 'admin/report_show', 'admin/reports_watch'],
                'visible' => true,
                'filename' => 'admin_reports.php'
            ),
            array(
                'title' => tr('mnu_pendings'),
                'menustring' => tr('mnu_pendings'),
                'siteid' => 'viewpendings',
                'visible' => true,
                'filename' => 'viewpendings.php'
            ),
            array(
                'title' => tr('mnu_octeamStats'),
                'menustring' => tr('mnu_octeamStats'),
                'siteid' => 'articles/bog',
                'visible' => true,
                'filename' => 'articles.php?page=cog'
            ),
            array(
                'title' => tr('mnu_notFoundCaches'),
                'menustring' => tr('mnu_notFoundCaches'),
                'siteid' => 'admin_cachenotfound',
                'visible' => true,
                'filename' => 'admin_cachenotfound.php'
            ),
            array(
                'title' => tr('mnu_searchUser'),
                'menustring' => tr('mnu_searchUser'),
                'siteid' => 'admin_searchuser',
                'visible' => true,
                'filename' => 'admin_searchuser.php'
            ),
            array(
                'title' => tr('mnu_ocTeamNews'),
                'menustring' => tr('mnu_ocTeamNews'),
                'siteid' => array('news/newsAdmin', 'news/newsAdminEdit'),
                'visible' => true,
                'filename' => 'admin_news.php'
            ),
            array(
                'title' => tr('mnu_geoPathAdmin'),
                'menustring' => tr('mnu_geoPathAdmin'),
                'siteid' => 'powerTrailCOG',
                'visible' => $powerTrailModuleSwitchOn,
                'filename' => 'powerTrailCOG.php'
            )
        )
    ),


    // My profile (my home) my_neighborhood
    array( //called from main.tpl
        'title' => tr('user_menu'),
        'menustring' => tr('user_menu'),
        'siteid' => 'myhome',
        'visible' => false,
        'filename' => isset($usr['userid']) ? 'viewprofile.php?userid=' . $usr['userid'] : '',
        'navicolor' => '#D5D9FF',
        'submenu' => array(
            array(
                'title' => tr('mnu_newCache'),
                'menustring' => tr('mnu_newCache'),
                'visible' => true,
                'filename' => 'newcache.php',
                'siteid' => array('newcache_info', 'newcache_forbidden', 'newcache_beginner', 'newcache')
            ),
            array(
                'title' => tr('mnu_myCaches'),
                'menustring' => tr('mnu_myCaches'),
                'visible' => true,
                'filename' => 'mycaches.php',
                'siteid' => 'mycaches'
            ),
            array(
                'title' => tr('mnu_myNeighborhood'),
                'menustring' => tr('mnu_myNeighborhood'),
                'visible' => true,
                'filename' => 'myneighborhood.php',
                'siteid' =>  'myneighborhood'
            ),
            array(
                'title' => tr('mnu_myRoutes'),
                'menustring' => tr('mnu_myRoutes'),
                'visible' => true,
                'filename' => 'myroutes.php',
                'siteid' => 'mnu_myRoutes'
            ),
            array(
                'title' => tr('mnu_myCacheNotes'),
                'menustring' => tr('mnu_myCacheNotes'),
                'visible' => true,
                'filename' => 'mycache_notes.php',
                'siteid' => 'mycache_notes'
            ),
            array(
                'title' => tr('mnu_myStats'),
                'menustring' => tr('mnu_myStats'),
                'visible' => true,
                'filename' => isset($usr['userid']) ? 'viewprofile.php?userid=' . $usr['userid'] : '',
                'siteid' => array('myhome', 'viewprofile', 'ustat', 'my_logs')
            ),
            array(
                'title' => tr('mnu_massLogsSave'),
                'menustring' => tr('mnu_massLogsSave'),
                'visible' => true,
                'filename' => 'log_cache_multi_send.php',
                'siteid' => array('log_cache_multi_send', 'log_cache_multi')   //JG 2013-10-25 było 'autolog'
            ),
            array(
                'title' => tr('mnu_newLogs'),
                'menustring' => tr('mnu_newLogs'),
                'visible' => false,
                'filename' => 'myn_newlogs.php',
                'siteid' => 'myn_newlogs'
            ),
            array(
                'title' => tr('new_caches_myn'),
                'menustring' => tr('new_caches_myn'),
                'visible' => false,
                'filename' => 'myn_newcaches.php',
                'siteid' => 'myn_newcaches'
            ),
            array(
                'title' => tr('top_recommended'),
                'menustring' => tr('top_recommended'),
                'visible' => false,
                'filename' => 'myn_newcaches.php',
                'siteid' => 'myn_topcaches'
            ),
            array(
                'title' => tr('ftf_awaiting'),
                'menustring' => tr('ftf_awaiting'),
                'visible' => false,
                'filename' => 'myn_ftf.php',
                'siteid' => 'myn_ftf'
            ),
            array(
                'title' => tr('mnu_myAccount'),
                'menustring' => tr('mnu_myAccount'),
                'visible' => true,
                'filename' => 'myprofile.php',
                'siteid' => 'myprofile',
                'submenu' => array(
                    array(
                        'title' => tr('change_data'),
                        'menustring' => tr('change_data'),
                        'visible' => false,
                        'filename' => 'myprofile.php?action=change',
                        'siteid' => 'myprofile_change',
                    ),
                    array(
                        'title' => tr('change_email'),
                        'menustring' => tr('change_email'),
                        'visible' => false,
                        'filename' => 'newemail.php',
                        'siteid' => 'newemail',
                    ),
                    array(
                        'title' => tr('change_password'),
                        'menustring' => tr('change_password'),
                        'visible' => false,
                        'filename' => 'newpw.php',
                        'siteid' => 'newpw',
                    ),
                    array(
                        'title' => tr('choose_statpic'),
                        'menustring' => tr('choose_statpic'),
                        'visible' => false,
                        'filename' => 'change_statpic.php',
                        'siteid' => 'change_statpic')
                )
            ),
            array(
                'title' => tr('settings_notifications'),
                'menustring' => tr('settings_notifications'),
                'visible' => true,
                'filename' => 'mywatches.php?action=emailSettings',
                'siteid' => 'userWatchedCaches/emailSettings'
            ),
            array(
                'title' => tr('mnu_clipboard'),
                'menustring' => tr('mnu_clipboard'),
                'siteid' => 'mylist',
                'visible' => false,
                'filename' => 'mylist.php'
            ),
            array(
                'title' => tr('mnu_savedQueries'),
                'menustring' => tr('mnu_savedQueries'),
                'visible' => true,
                'filename' => 'query.php',
                'siteid' => 'viewqueries'
            ),
            array(
                'title' => tr('mnu_watchedCaches'),
                'menustring' => tr('mnu_watchedCaches'),
                'visible' => true,
                'filename' => 'mywatches.php',
                'siteid' => 'userWatchedCaches/userWatchedCaches',
                'submenu' => array(
                    array(
                        'title' => tr('map_watched_caches'),
                        'menustring' => tr('map_watched_caches'),
                        'visible' => true,
                        'filename' => 'mywatches.php?action=map',
                        'siteid' => 'userWatchedCaches/mapOfWatched',
                    ),
                ),
            ),
            array(
                'title' => tr('mnu_ignoredCaches'),
                'menustring' => tr('mnu_ignoredCaches'),
                'visible' => true,
                'filename' => 'myignores.php',
                'siteid' => 'myignores'
            ),
            array(
                'title' => tr('mnu_myRecommends'),
                'menustring' => tr('mnu_myRecommends'),
                'visible' => true,
                'filename' => 'mytop5.php',
                'siteid' => 'mytop5'
            ),
            array(
                'title' => tr('mnu_cacheAdoption'),
                'menustring' => tr('mnu_cacheAdoption'),
                'visible' => true,
                'filename' => 'chowner.php',
                'siteid' => 'chowner'
            ),
            array(
                'title' => tr('mnu_searchUser'),
                'menustring' => tr('mnu_searchUser'),
                'siteid' => 'searchuser',
                'visible' => true,
                'filename' => 'searchuser.php'
            ),
            array(
                'title' => tr('mnu_openchecker'),
                'menustring' => tr('mnu_openchecker'),
                'visible' => $config['module']['openchecker']['enabled'],
                'filename' => 'openchecker.php',
                'siteid' => 'openchecker'
            ),
            array(
                'title' => tr('mnu_okapiExtApps'),
                'menustring' => tr('mnu_okapiExtApps'),
                'siteid' => 'mnu_okapiExtApps',
                'visible' => true,
                'filename' => 'okapi/apps/?langpref=' . $GLOBALS['lang']
            ),
            array(
                'title' => 'QR Code',
                'menustring' => 'QR Code',
                'siteid' => 'qrcode',
                'visible' => true,
                'filename' => 'qrcode.php'
            )
        )
    ),
    // Caches
    array(
        'title' => tr('caches'),
        'menustring' => tr('caches'),
        'siteid' => 'search',
        'visible' => false,
        'filename' => 'search.php',
        'navicolor' => '#BDE3E7',
        'submenu' => array(
            array(
                'title' => tr('reports_user_title'),
                'menustring' => tr('reports_user_title'),
                'siteid' => ['report/report_add', 'report/report_info', 'report/report_show'],
                'visible' => false,
                'filename' => 'report.php'
            ),
            array(
                'title' => tr('search'),
                'menustring' => tr('search'),
                'visible' => true,
                'filename' => 'search.php',
                'siteid' => 'search',
                'submenu' => array(
                    array(
                        'title' => tr('view_cache'),
                        'menustring' => tr('view_cache'),
                        'visible' => false,
                        'filename' => 'viewcache.php',
                        'siteid' => 'viewcache',
                        'submenu' => array(
                            array(
                                'title' => tr('new_log_entry'),
                                'menustring' => tr('new_log_entry'),
                                'visible' => false,
                                'filename' => 'log.php',
                                'siteid' => 'log_cache'
                            ),
                            array(
                                'title' => tr('edit_log'),
                                'menustring' => tr('edit_log'),
                                'visible' => false,
                                'filename' => 'editlog.php',
                                'siteid' => 'editlog'
                            ),
                            array(
                                'title' => tr('remove_log'),
                                'menustring' => tr('remove_log'),
                                'visible' => false,
                                'filename' => 'removelog.php',
                                'siteid' => 'removelog_logowner'
                            ),
                            array(
                                'title' => tr('remove_log'),
                                'menustring' => tr('remove_log'),
                                'visible' => false,
                                'filename' => 'removelog.php',
                                'siteid' => 'removelog_cacheowner'
                            ),
                            array(
                                'title' => tr('edit_cache'),
                                'menustring' => tr('edit_cache'),
                                'visible' => false,
                                'filename' => 'editcache.php',
                                'siteid' => 'editcache'
                            ),
                            array(
                                'title' => tr('new_desc'),
                                'menustring' => tr('new_desc'),
                                'visible' => false,
                                'filename' => 'newdesc.php',
                                'siteid' => 'newdesc'
                            ),
                            array(
                                'title' => tr('edit_desc'),
                                'menustring' => tr('edit_desc'),
                                'visible' => false,
                                'filename' => 'editdesc.php',
                                'siteid' => 'editdesc'
                            ),
                            array(
                                'title' => tr('remove_desc'),
                                'menustring' => tr('remove_desc'),
                                'visible' => false,
                                'filename' => 'removedesc.php',
                                'siteid' => 'removedesc'
                            )
                        )
                    ),
                    array(
                        'title' => tr('search_loc'),
                        'menustring' => tr('search_loc'),
                        'visible' => false,
                        'filename' => 'search.php',
                        'siteid' => 'selectlocid',
                    ),
                    array(
                        'title' => tr('search_results'),
                        'menustring' => tr('search'),
                        'visible' => false,
                        'filename' => 'search.php',
                        'siteid' => 'search.result.caches',
                    ),
                    array(
                        'title' => tr('show_log'),
                        'menustring' => tr('show_log'),
                        'visible' => false,
                        'filename' => 'viewlogs.php',
                        'siteid' => 'viewlogs',
                    ),
                    array(
                        'title' => tr('store_queries'),
                        'menustring' => tr('store_queries'),
                        'visible' => false,
                        'filename' => 'query.php?action=save',
                        'siteid' => 'savequery'
                    )
                )
            ),
            array(
                'title' => tr('mnu_newCache'),
                'menustring' => tr('mnu_newCache'),
                'visible' => true,
                'filename' => 'newcache.php',
                'siteid' => 'newcache',
                'submenu' => array(
                    array(
                        'title' => tr('cache_descriptions'),
                        'menustring' => tr('cache_descriptions'),
                        'visible' => true,
                        'filename' => tr('filename_describe_cache'),
                        'siteid' => 'articles/cacheinfo'
                    ),
                    array(
                        'title' => tr('allowed_html_tags'),
                        'menustring' => tr('allowed_html_tags'),
                        'visible' => true,
                        'filename' => 'articles.php?page=htmltags',
                        'siteid' => 'articles/htmltags'
                    )
                )
            ),
            array(
                'title' => tr('special_caches'),
                'menustring' => tr('special_caches'),
                'visible' => false,
                'filename' => 'articles.php?page=specialcaches',
                'siteid' => 'articles/specialcaches'
            ),
            array(
                'title' => tr('user_ident'),
                'menustring' => tr('user_ident'),
                'filename' => 'viewprofile.php',
                'siteid' => 'viewprofile',
                'visible' => false
            ),
            array(
                'title' => tr('recommendations'),
                'menustring' => tr('recommendations'),
                'filename' => 'usertops.php',
                'siteid' => 'usertops',
                'visible' => false
            )
        )
    ),
    $cache_menu,
    $stat_menu,
    array(
        'title' => '',
        'menustring' => '',
        'filename' => '',
        'siteid' => array('garminzip', 'garminggz', 'garminzip-ggz'),
        'visible' => false
    )
);