        

<?=$pagination?>

        <ul class="phonelist" id="names-list">
            <?php foreach ($names as $name): ?>
            <li class="list">
                <div class="g-section g-tpl-75-25">
                    <div class="g-unit g-first" style="width:73%">
                        <div class="name">
                            <strong>
                                <!--a href="<?=site_url('name/'.$name['id'])?>"><?=$name['name']?></a-->
                                <?=$name['name']?>
                            </strong>
                        </div>
                        <p class="description">
                            <?=$name['meaning']?>
                        </p>
                    </div>
                    <!--div class="g-unit buy-from" style="width:25%">
                        <input type="submit" class="inline-compare-button" value="Shortlist" data-image-id="444005" data-phone-name="t-mobile-g2">
                    </div-->
                </div>
            </li>
            <?php endforeach; ?>


        </ul>

<?=$pagination?>
