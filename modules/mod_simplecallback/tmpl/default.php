<?php
// No direct access
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'media/mod_simplecallback/css/simplecallback.css');
$document->addScript(JUri::base() . 'media/mod_simplecallback/js/simplecallback.js');
JHTML::_('behavior.formvalidation');
$overlayed = $params->get('simplecallback_overlay');
$captcha_enabled = $params->get('simplecallback_captcha', 0);
$phone_mask = $params->get('simplecallback_phone_field_mask');
$header_tag = $params->get('header_tag', 'h3');
$header_class = $params->get('header_class', '');
$show_title = $module->showtitle;
?>

<form
    id="simplecallback-<?php echo $module->id; ?>"
    action="<?php echo JURI::root(); ?>index.php?option=com_ajax&module=simplecallback&format=json"
    class="form-inline simplecallback<?php echo $moduleclass_sfx ?> <?php if ($overlayed == 1) { echo "simplecallback-overlayed"; } ?>"
    method="post"
    <?php if (!empty($phone_mask) && $phone_mask != '') { echo "data-simplecallback-phone-mask='$phone_mask'"; } ?>
    data-simplecallback-form <?php if ($overlayed == 1) { echo "data-simplecallback-form-overlayed style='display: none;'"; } ?>
    >

    <?php if ($overlayed == 1) :?>
        <div class="simplecallback-close" data-simplecallback-close>&times;</div>
        <?php if ($module->showtitle) {
            echo "<$header_tag class='$header_class'>$module->title</$header_tag>";
        } ?>
    <?php endif; ?>

    <div class="control-group">
        <label>
            <?php echo $params->get('simplecallback_name_field_label'); ?>
            <input type="text" name="simplecallback_name" required class="input-block-level" autocomplete="off" />
        </label>
    </div>
    <div class="control-group">
        <label>
            <?php echo $params->get('simplecallback_phone_field_label'); ?>
            <input type="text" name="simplecallback_phone" required class="input-block-level" autocomplete="off" />
        </label>
    </div>
    <?php if ($captcha_enabled == 1) : ?>
        <div class="control-group">
            <img src="<?php echo JUri::base() . 'modules/mod_simplecallback/captcha.php?id=' . $module->id; ?>" width="150" height="40" alt="captcha" class="simplecallback-captcha">
            <input type="text" name="simplecallback_captcha" required class="input-block-level" autocomplete="off" />
        </div>
    <?php endif; ?>
    <div class="control-group">
        <?php echo JHtml::_( 'form.token' ); ?>
        <input type="hidden" name="module_id" value="<?php echo $module->id; ?>" />
        <button type="submit" class="btn"><?php echo $params->get('simplecallback_submit_field_label'); ?></button>
    </div>
</form>