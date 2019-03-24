<article class="u-play-of">
	<style>
	.idno-play .u-photo {
		margin-right: 2em;
		margin-bottom: 2em;
        max-width: 175px;
        float: left;
    }
    .play-duration {
        font-style: italic;
    }
	</style>
        
    <?php
        if ($attachments = $vars['object']->getAttachments()) {
            foreach ($attachments as $attachment) {
                $mainsrc = $attachment['url'];
                if (!empty($vars['object']->thumbnail_large)) {
                    $src = $vars['object']->thumbnail_large;
                } else if (!empty($vars['object']->thumbnail)) { // Backwards compatibility
                    $src = $vars['object']->thumbnail;
                } else {
                    $src = $mainsrc;
                }

                // Patch to correct certain broken URLs caused by https://github.com/idno/known/issues/526
                $src = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $src);
                $mainsrc = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $mainsrc);

                ?>
                 <a href="<?= $this->makeDisplayURL($mainsrc) ?>"><img src="<?= $this->makeDisplayURL($src) ?>" class="u-photo pull-left"/></a>
            <?php
            }
        }
    ?>
    
<h2>
        <span><i class="fas fa-gamepad"></i></span>
        Played
        <a href="<?= $vars['object']->getGameURL() ?>" class="p-name"><?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a>
    </h2>
    
    <span class="e-content">
        <?= $this->__(['value' => $vars['object']->body, 'object' => $vars['object']])->draw('forms/output/richtext'); ?>
        
        <?php if ($vars['object']->getDuration() > 0) { ?>
        <p class="play-duration">Played for <?= $vars['object']->getDuration() ?> minutes.</p>
        <?php } ?>
    </span>

    <div class="hidden">
        <p class="h-card vcard p-author">
            <a href="<?= $vars['object']->getOwner()->getURL(); ?>" class="icon-container">
                <img class="u-logo logo u-photo photo" src="<?= $vars['object']->getOwner()->getIcon(); ?>"/>
            </a>
            <a class="p-name fn u-url url" href="<?= $vars['object']->getOwner()->getURL(); ?>"><?= $vars['object']->getOwner()->getName(); ?></a>
            <a class="u-url" href="<?= $vars['object']->getOwner()->getURL(); ?>">
            <!-- This is here to force the hand of your MF2 parser --></a>
        </p>
    </div>
</article>
