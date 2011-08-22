<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?
            if (!isset($title))
                $title = lang('Peyar');
            else
                $title = $title. ' | ' .lang('Peyar');
        ?>
        <title><?=$title?></title>
        <link rel="stylesheet" href="/inlay.css">
        <link rel="stylesheet" href="/style.css">
        <meta name="description" content="Browse Tamil baby names by boy and girl. Browse by starting name, numerology, meaning. Shortlist child names and choose the best one.">
        <meta name="google-site-verification" content="R3T0d7Cxe39NHgWROvhJcko-_-tiAmnt3fye0pt7yzw" />
    </head>
    <body>
        <div class="browse">
            <div class="header border">
                <h1>
                    <a href="<?=site_url('')?>">
                        <?=lang('Peyar - Tamil Baby Names')?>
                    </a>
                </h1>

                <form action="<?=site_url('search/names/'.@$cur_gender).'/'?>" method="get">
                    <input id="search" maxlength="255" name="q" type="text" value="<?=@$_REQUEST['q']?>">
                    <input type="submit" value="<?=lang('Search')?>">
                </form>

                <div class="g-section phonelist-browser-links gender">
                    <div class="sortby">
                        <h2>
                            <a href="<?=get_url_of_page($cur_folder, 1, GENDER_BOY)?>"  class="<?=(GENDER_BOY==@$cur_gender)? 'active':''?>"><?=lang('boy')?></a> |
                            <a href="<?=get_url_of_page($cur_folder, 1, GENDER_GIRL)?>" class="<?=(GENDER_GIRL==@$cur_gender)? 'active':''?>"><?=lang('girl')?></a>
                        </h2>
                    </div>
                </div>

                <a style="font-size: 95%;" href="/star/<?=$cur_gender?>"><?=lang('Choose by star')?></a>
                <div class="clear"></div>

            </div>
            <div class="page">


                <div class="content">

                    <div class="g-section g-tpl-200">
                        <div class="g-unit g-first">
<?php if (isset($custom_sidebar)): ?>
<p style="font-size: 90%">
<?=$custom_sidebar?>
</p>
<?php else: ?>
                            <div id="navbar-container">
                                <form class="navbar phonelist-browser-links" autocomplete="off">
                                    <div class="section-title"><h4><?=lang('Starting with')?></h4></div>
                                    
<?php


    global $thunai_letters, $mei_letters, $uiyir_letters;
    global $thunai_letters_utf, $mei_letters_utf, $uiyir_letters_utf;

    $start = @$cur_prefix;
    $sep = stripos($start, '-');
    $startMei = "";
    if ($sep==false)
    {
        $startMei = $start;
        $startThunai = $start;
    }
    else
    {
        $startMei = substr($start, 0, $sep);
        $startThunai = substr($start, $sep+1, strlen($start));
    }

    if (!in_array($startMei, $mei_letters) && !in_array($startMei, $uiyir_letters)) {
        $startMei = $uiyir_letters[0];
    }
    if (!in_array($startThunai, $thunai_letters)) {
        $startThunai = "";
    }

    //uiyirezhuthil thodangupavai
    //&#2953;&#2991;&#3007;&#2992;&#3014;&#2996;&#3009;&#2980;&#3021;&#2980;&#3007;&#2994;&#3021; &#2980;&#3018;&#2975;&#2969;&#3021;&#2965;&#3009;&#2986;&#2997;&#3016;

    //print menu for Uiyir letters
    $html = array();
    $html []= '<ul>';

    foreach($uiyir_letters as $u)
    {
        $html[] = sprintf('<li class="%s"><a href="%s">&#%s;</a></li>',
                                (from_code($u)==@$cur_prefix)? 'active':'',
                                get_dir_url_code(@$cur_gender, $u), $u);
    }
    $html []= '</ul>';

    //print menu for mei letters
    foreach($mei_letters as $m)
    {
        $html []= '<ul>';
        //k + a
        $html[] = sprintf('<li class="%s"><a href="%s">&#%s;</a></li>',
                                (from_code($m)==@$cur_prefix)? 'active':'',
                                get_dir_url_code(@$cur_gender, $m), $m);
        //other combinations
        foreach($thunai_letters as $u)
        {
            $html[] = sprintf('<li class="%s"><a href="%s">&#%s;&#%s;</a></li>',
                                (from_code($m, $u)==@$cur_prefix)? 'active':'',
                                get_dir_url_code(@$cur_gender, $m, $u), $m, $u);
        }
        $html []= '</ul>';
    }

    echo implode('', $html);
?>
                                </form>

                            </div>
                            <div class="navbar-disclaimer">
                                <?=lang('More filter options, customizations are coming soon!')?>
                            </div>
<?php endif; ?>
                        </div>
                        <div class="g-unit phonelist-border-left">
                            <div class="g-section g-tpl-200-alt">
                                <div class="g-unit g-first">
                                    <!--div class="sticky">
                                        <div class="sidebar-compare navbar" id="sidebar-compare">
                                            <div class="section-title"><h4><?=lang('Shortlisted')?></h4></div>
                                            <ul>
                                                <li><a href="#">Karthik</a></li>
                                                <li><a href="#">Kandan</a></li>
                                                <li><a href="#">Siva</a></li>
                                                <li><a href="#">Mani</a></li>
                                                <li><a href="#">Madhan</a></li>
                                            </ul>

                                            <input type="submit" class="inline-compare-button" value="Clear" data-image-id="444005" data-phone-name="t-mobile-g2">
                                        </div>

                                    </div-->

                                    <div class="sticky">
                                        <div class="sidebar-compare navbar" id="sidebar-compare">
                                            <div class="section-title"><h4><?=lang('Links')?></h4></div>
                                            <ul>
                                                <li><a href="http://blog.ravidreams.net/2009/02/tamil-baby-names-website/"><?=lang('About Us')?></a></li>
                                                <li><a href="http://blog.ravidreams.net/2007/03/tamil-baby-names/"><?=lang('Influence of other languages in tamil names')?></a></li>
                                                <li><?=lang('Sources: ')?><a href="http://web.archive.org/web/20080109115919/www.nithiththurai.com/name/index1.html">தமிழ்ப்பெயர்க் கையேடு</a>, <a href="http://Tamilnation.org">Tamilnation.org</a></li>
                                            </ul>
                                        </div>
                                        <br/><br/>
                                    </div>

                                    <div class="navbar-disclaimer" style="text-align: right; padding: 10px 0;">
                                        
                                        <?=lang('Made by Karthik, Ravisanker')?>
                                        <br/><br/>
					<a href="http://www.thamizha.com/"><img width="24" src="/images/dispatch_logo.png"><?=lang('Its a Thamizha project')?></a>
                                        <br/><br/>
                                        <a href="https://github.com/thamizha/peyar"><?=lang('Code is released under GPL3 license')?></a>

                                    </div>
                                    
                                </div>
                                

                        <div class="g-unit">
                            <div class="phonelist-container" id="phonelist-container">


                                