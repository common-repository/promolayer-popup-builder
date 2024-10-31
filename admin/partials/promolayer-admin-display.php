<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://promolayer.io
 * @since      1.0.0
 *
 * @package    Promolayer
 * @subpackage Promolayer/admin/partials
 */

$promolayer = Promolayer::getInstance();
$secret = $promolayer->get_option('secret');
$user_id = $promolayer->get_option('user_id');
$woocommerce_activated =  $promolayer->is_woocommerce_activated() ? 'yes' : 'no';

$query = http_build_query(array(
     'platform' => 'wordpress',
     'site_url' => site_url(),
     'secret' => $secret,
     'woocommerce_activated' => $woocommerce_activated
    )
);
$register_url = PROMOLAYER_URL . '/register_wp?'. $query;
$login_url = PROMOLAYER_URL . '/login_wp?'. $query;
?>
<div class="promolayer-wrapper">

    <div class="pl-card">
        <div class="pl-halfcol">
            <div class="pl-login-panel">
                <div class="pl-logo">
                    <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/promolayer-logo.svg'); ?>" alt="Promolayer Logo" />
                </div>
                <?php if(!$user_id){ ?>
                <div class="pl-headline">
                    <h1><?php esc_html_e('Create your free account', 'promolayer-popup-builder') ?></h1>
                    <h3 class="pl-subtitle"><?php esc_html_e('Make beautiful popups and more.', 'promolayer-popup-builder') ?></h3>
                    <h3 class="pl-subtitle-light"><?php esc_html_e('100% free, no credit card required.', 'promolayer-popup-builder') ?></h3>
                </div>
                <div class="pl-login-buttons">
                    <a class="pl-button pl-signup" data-connected="no" href="<?php echo esc_url($register_url) ?>" target="_blank">
                        <?php esc_html_e('Sign up', 'promolayer-popup-builder') ?> <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/arrow-right.svg'); ?>" alt="Arrow right icon" />
                    </a>
                    <h1><?php esc_html_e('Already have an account?', 'promolayer-popup-builder') ?></h1>
                    <a class="pl-button" data-connected="no" href="<?php echo esc_url($login_url) ?>" target="_blank">
                        <?php esc_html_e('Log in & connect', 'promolayer-popup-builder') ?> <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/arrow-right.svg'); ?>" alt="Arrow right icon" />
                    </a>
                </div>
                <?php } if($user_id){ ?>
                        <img class="big-checkmark" src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/circle-check.svg'); ?>" alt="Checkmark" />
                        <h2 class="m0p0"><?php esc_html_e('Your account is connected', 'promolayer-popup-builder') ?></h2>
                    <span class="small-text userid"><?php esc_html_e('Connected user id:', 'promolayer-popup-builder') ?><?php echo esc_html($user_id) ?></span>
                    <span class="small-text userid disconnect" id="disconnectPromolayer" style="text-style:underline;"><?php esc_html_e('Disconnect this account') ?></span>
                    <a class="pl-button" data-connected="yes" href="<?php echo esc_url(PROMOLAYER_URL . '/wordpress/signin?userid='.$user_id.'&token='. $secret) ?>" target="_blank">
                        <?php esc_html_e('Open Promolayer', 'promolayer-popup-builder') ?> <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/arrow-right.svg'); ?>" alt="Arrow right icon" />
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="pl-halfcol pl-promocol">
            <div class="pl-promocol-header">
                <div>
                    <p><?php echo wp_kses(__('Everything you need to boost your <br> revenue and build your email lists <br> in one place.', 'promolayer-popup-builder'), array( 'br' => array() )); ?></p>
                </div>
                <div>
                    <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/happy-device-user.jpg'); ?>" alt="A happy woman using a phone" />
                </div>
            </div>
            <div class="pl-promocol-info">
                <div><h3><?php esc_html_e('What can Promolayer do for you?.', 'promolayer-popup-builder') ?></h3></div>
                <div>
                    <div class="pl-feature-list">
                        <div><span><?php esc_html_e('Easy to use editor', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Beautiful templates', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('12 high converting strategies', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Multivariate testing', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Triggers and targeting rules', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Exit-intent', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Intergrates with mail services like Mailchimp and Klaviyo', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Autoresponders', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Gamified popups', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Banners and notifications', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('FOMO generating countdowns', 'promolayer-popup-builder') ?></span></div>
                        <div><span><?php esc_html_e('Social list building', 'promolayer-popup-builder') ?></span></div>
                    </div>
                </div>
                <div><h4><?php esc_html_e('+ lots more, give it a try!', 'promolayer-popup-builder') ?></h4></div>
            </div>
        </div>
    </div>
    <div class="pl-card pl-card-social">
    <div class="pl-social-proof-headline">
        <h2 class="m0p0"><?php esc_html_e('Smart growth hackers love Promolayer', 'promolayer-popup-builder') ?></h2>
    </div>
        <div class="pl-ratings">
            <div>
                <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-shopify.jpg'); ?>" alt="Shopify rating" />
            </div>
            <div>
                <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-wix.jpg'); ?>" alt="Wix rating" />
            </div>
            <div>
                <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-web.jpg'); ?>" alt="Web rating" />
            </div>
        </div>
        <div class="pl-reviews">
            <div class="pl-review">
                <div class="pl-user-icon"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/user-icon.png'); ?>" alt="User icon" /></div>
                <div class="pl-user-rating"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-stars.png'); ?>" alt="5 star rating" /></div>
                <div class="pl-user-name">
                    <?php esc_html_e('Ecko', 'promolayer-popup-builder') ?>
                </div>
                <div class="pl-user-review">
                    "
                    <?php esc_html_e('Amazing for beginners and advanced users', 'promolayer-popup-builder') ?>
                    "
                </div>
            </div>
            <div class="pl-review">
                <div class="pl-user-icon"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/user-icon.png'); ?>" alt="User icon" /></div>
                <div class="pl-user-rating"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-stars.png'); ?>" alt="5 star rating" /></div>
                <div class="pl-user-name">
                    <?php esc_html_e('Chezl2', 'promolayer-popup-builder') ?>
                </div>
                <div class="pl-user-review">
                    "
                    <?php esc_html_e('super simple à utiliser créations illimitées !', 'promolayer-popup-builder') ?>
                    "
                </div>
            </div>
            <div class="pl-review">
                <div class="pl-user-icon"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/user-icon.png'); ?>" alt="User icon" /></div>
                <div class="pl-user-rating"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-stars.png'); ?>" alt="5 star rating" /></div>
                <div class="pl-user-name">
                    <?php esc_html_e('Footware4u', 'promolayer-popup-builder') ?>
                </div>
                <div class="pl-user-review">
                    "
                    <?php esc_html_e('“I got my ROI on the same day as my install. Amazing.”', 'promolayer-popup-builder') ?>
                    "
                </div>
            </div>
            <div class="pl-review">
                <div class="pl-user-icon"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/user-icon.png'); ?>" alt="User icon" /></div>
                <div class="pl-user-rating"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-stars.png'); ?>" alt="5 star rating" /></div>
                <div class="pl-user-name">
                    Techtoids
                </div>
                <div class="pl-user-review">
                    "
                    <?php esc_html_e('Great app, easy to setup, works like a charm.”', 'promolayer-popup-builder') ?>
                    "
                </div>
            </div>
            <div class="pl-review">
                <div class="pl-user-icon"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/user-icon.png'); ?>" alt="User icon" /></div>
                <div class="pl-user-rating"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-stars.png'); ?>" alt="5 star rating" /></div>
                <div class="pl-user-name">
                    CardentRemover
                </div>
                <div class="pl-user-review">
                    "
                    <?php esc_html_e('I am in love with this app... excellent support & service', 'promolayer-popup-builder') ?>
                    "
                </div>
            </div>
            <div class="pl-review">
                <div class="pl-user-icon"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/user-icon.png'); ?>" alt="User icon" /></div>
                <div class="pl-user-rating"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../../assets/images/rating-stars.png'); ?>" alt="5 star rating" /></div>
                <div class="pl-user-name">
                    Fashinlove
                </div>
                <div class="pl-user-review">
                    "
                    <?php esc_html_e('Converts like crazy', 'promolayer-popup-builder') ?>
                    "
                </div>
            </div>
        </div>
    </div>

</div>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
