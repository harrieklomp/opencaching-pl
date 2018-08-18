<?php
use Utils\Database\OcDb;

$rootpath = "../";
require_once('common.inc.php');

?>
<html>
    <head>
    </head>

    <body>
        <div id="idGCB"></div>

<script>GCTLoad( 'ChartBar', '', 1 );</script>

        <script>
            var gcb = new GCT('idGCB');
            gcb.addColumn('string', 'UserName');
        </script>

        <?php
        $sEND = "";
        $sDateCondition = "";
        $sTypeCondition = "";

        global $lang;

        $sUserIDLine = $_REQUEST["UserID"];
        $sDateFrom = $_REQUEST["DF"];
        $sDateTo = $_REQUEST["DT"];
        $sNameOfStat = $_REQUEST["stat"];

        $nDayInterval = 999;
        $sGranulate = "";
        $sPeriodName = "";

        if ($sDateFrom <> "" and $sDateTo <> "") {
            $dDateFrom = new DateTime($sDateFrom);
            $dDateTo = new DateTime($sDateTo);
            $interval = $dDateFrom->diff($dDateTo);
            $nDayInterval = $interval->format('%a');
        }

        if ($nDayInterval < 65) {
            $sGranulate = " (week( cl.date) + 1) period ";
            $sPeriodName = tr2('.week', $lang);
        } else if ($nDayInterval < 367) {
            $sGranulate = " month( cl.date) period ";
            $sPeriodName = tr2('.month', $lang);
        } else {
            $sGranulate = " year( cl.date) period ";
            $sPeriodName = tr2('.year', $lang);
        }


        if ($sDateFrom <> "")
            $sDateCondition .= "and date >='" . $sDateFrom . "'";

        if ($sDateTo <> "")
            $sDateCondition .= " and date < '" . $sDateTo . "' ";


        if ($sNameOfStat == "NumberOfFinds")
            $sTypeCondition = " and  cl.type=1 ";

        if ($sNameOfStat == "MaintenanceOfCaches")
            $sTypeCondition = " and  cl.type=6 ";


        $asUserID = explode(",", $sUserIDLine);


        if (!strlen($sUserIDLine))
            $sEND = tr2('SelectUsers', $lang);

        if (count($asUserID) > 30)
            $sEND = tr2('more30', $lang);

        if ($sEND <> "") {
            echo "<script>";
            echo "alert( '$sEND' );";
            //$asUserID = explode(",", "");
            echo "</script>";
        }



        if ($sEND <> "") {
            echo "<script>";
            echo "return;";
            echo "</script>";
        }




        $sCondition = "";
        foreach ($asUserID as $sID) {
            if (strlen($sCondition))
                $sCondition = $sCondition . " or ";

            $sCondition = $sCondition . "cl.user_id = '" . $sID . "'";
        }

        if (strlen($sCondition)) {
            $sCondition = " and ( " . $sCondition . " )";
        }

        $sCondition .= $sDateCondition;




/////////////////

        $dbc = OcDb::instance();

        $query = "SELECT distinct " . $sGranulate . "
        FROM
        cache_logs cl

        WHERE cl.deleted=0 "
                . $sTypeCondition
                . $sCondition .
                " order by period";



        $s = $dbc->multiVariableQuery($query);


        $aNrColumn = array();
        $i = 0;

        echo "<script>";

        while ($record = $dbc->dbResultFetch($s)) {

            $nPeriod = $record['period'];

            $aNrColumn[$nPeriod] = $i;

            $sPN = $nPeriod . $sPeriodName;
            echo "gcb.addColumn('number', '$sPN');";

            $i = $i + 1;
        }


////////////////////

        echo "</script>";

////////////////////////////

        foreach ($asUserID as $sID) {
            $sCondition = " and cl.user_id = '" . $sID . "'";
            $sCondition .= $sDateCondition;

            $dbc = OcDb::instance();

            $query = "SELECT u.username username, u.user_id user_id,
            " . $sGranulate . ",
            COUNT(*) count

            FROM
            cache_logs cl
            join caches c on c.cache_id = cl.cache_id
            join user u on cl.user_id = u.user_id

            WHERE cl.deleted=0 "
                    . $sTypeCondition
                    . $sCondition .
                    "GROUP BY period";

            $s = $dbc->multiVariableQuery($query);


            echo "<script>";

            $nStart = 1;
            while ($record = $dbc->dbResultFetch($s)) {
                $nPeriod = $record['period'];
                $nVal = $record['count'];

                if ($nStart == 1) {
                    $sUserName = $record['username'];
                    $sUserName = str_replace("'", "`", $sUserName);
                    $nUserId = $record['user_id'];

                    echo "
            gcb.addEmptyRow();
            gcb.addToLastRow( 0, '$sUserName' );
            ";

                    $nStart = 0;
                }


                $nrCol = $aNrColumn[$nPeriod];
                echo "gcb.addToLastRow( $nrCol+1 , $nVal );";
            }

            echo "</script>";

            unset($dbc);
        }
        ?>


        <script>
            gcb.drawChart(1);
        </script>
    </body>
</html>
