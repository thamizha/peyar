

        <ul class="phonelist" id="">

            <li class="list">
                <div class="g-section g-tpl-75-25">
                    <div class="g-unit g-first" style="width:73%">
                        <div class="name">
                            <strong>
                                <a href="<?=site_url('name/'.$name['id'])?>"><?=$name['name']?></a>
                            </strong>
                              (<?=lang($cur_gender)?>)
                        </div>
                        <? if (!empty($name['meaning'])): ?>
                        <p class="description">
                            <?=lang('meaning')?>: <?=$name['meaning']?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <!--div class="g-unit buy-from" style="width:25%">
                        <input type="submit" class="inline-compare-button" value="Shortlist" data-image-id="444005" data-phone-name="t-mobile-g2">
                    </div-->
                </div>
            </li>

            <li>
                <br/><br/>
                <a href="<?=get_dir_url($cur_gender, $cur_prefix)?>">
                    &laquo; <?=sprintf(lang("Browse $cur_gender names starting with %s"), $cur_prefix)?>
                </a>
            </li>


        </ul>

   