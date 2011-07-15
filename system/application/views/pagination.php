<div class="pagination">
<?php if ($cur_page != 1): ?>
    <div class="prev">
        <a href="<?=get_url_of_page($cur_folder, ($cur_page-1))?>">&laquo; <?=sprintf(lang('Previous %d'), PAGE_SIZE)?></a>
    </div>
<?php endif; ?>
<?php if (isset($cur_exportlink)): ?>
    <div class="export" style="<?=(($cur_page==1)? 'margin-left: 0':'')?>">
        <a href="<?=$cur_exportlink?>"><?=lang('Export')?> <img width="12" border="0" src="/images/1288762972_Arrow Down.png"/></a>
    </div>
<?php endif; ?>
<?php if ($more_exists): ?>
    <div class="next">
        <a href="<?=get_url_of_page($cur_folder, ($cur_page+1))?>"><?=sprintf(lang('Next %d'), PAGE_SIZE)?> &raquo;</a>
    </div>
<?php endif; ?>
</div>