<?php require_once 'header.php'?>
<form action="/list/get" method="post" id="feedback-list">
    <?php print $csrf->getCsrfFiled();?>
    <input type="hidden" name="page" value="1">
        <?php if ($pages) { ?>
            <nav>
                <ul class="pagination">
                    <?php for ($s = 1; $s <= $pages; $s++) { ?>
                        <li><a class="page" href="#" data-page="<?php echo $s ?>"><?php echo $s ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } ?>
    <div class="hide alert alert-danger"></div>
    <div id="feedback-list-loader" class="hide progress"><div class="progress-bar progress-bar-striped active" style="width: 100%;"></div></div>
    <dl id="feedback-list-result">
    </dl>
</form>
<script src="/assests/js/listFeedback.js"></script>
<?php require_once 'footer.php'?>