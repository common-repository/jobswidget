<?php

if ( ! defined( 'ABSPATH' ) ) { 
    exit; 
}  

// add plugin description
if (function_exists('load_plugin_textdomain')) {
    load_plugin_textdomain('jobs-widget', false, 'jobs-widget/languages');
}

$options = get_option('jobs_widget', array());
?>
<div class="wrap">

    <h2>Jobs Widget</h2>

    <h3><?php _e('Configuration', 'jobs-widget') ?></h3>

    <form action="" method="post">
        <?php wp_nonce_field('save') ?>
        <table class="form-table">
            <tr>
                <th><?php _e('Execute shortcodes', 'jobs-widget') ?></th>
                <td>
                    <input type="checkbox" name="options[shortcode]" value="1" <?php echo isset($options['shortcode']) ? 'checked' : ''; ?>>
                    <p class="description">
                        <?php _e('When checked short codes (like [gallery]) contained in included files will be executed as if they where inside the post or page body content. Probably usage of this feature is very rare.', 'jobs-widget') ?>
                    </p>
                </td>
            </tr>    
        </table>
        <p class="submit">
            <input class="button button-primary" type="submit" name="save" value="<?php _e('Save') ?>"/>
        </p>


        <h3>Where is it used?</h3>

        <?php if (isset($posts)) { ?>
            <?php if (empty($posts)) { ?>
                <p>No posts or pages with [jobs_widget] shortcode.</p>
            <?php } else { ?>
                <ul>
                    <?php foreach ($posts as $post) { ?>
                        <li><a href="<?php echo get_permalink($post->id) ?>" target="_blank"><?php echo esc_html($post->post_title) ?></a></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>

        <p class="submit">
            <input class="button button-primary" type="submit" name="find" value="<?php _e('Find') ?>"/>
        </p>
    </form>
</div>
