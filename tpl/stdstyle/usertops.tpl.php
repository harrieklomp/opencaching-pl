<?php

?>

<div class="content2-pagetitle">
    <img src="tpl/stdstyle/images/blue/recommendation.png" class="icon32" alt="Rekomendowane" title="Rekomendowane" align="middle" /> <b>{{Given_Recommendations}} <a href="viewprofile.php?userid={userid}">{username}</a></b></div>

<div class="searchdiv">
    <table class="table">
        <colgroup>
            <col width="500px"/>
            <col width="1px" />
            <col width="140px"/>
        </colgroup>
        <tr>
            <td class="content-title-noshade">Geocache</td>
            <td class="content-title-noshade">&nbsp;</td>
            <td class="content-title-noshade">{{created_by}}</td>

        </tr>
        {top5}
    </table>
</div>
