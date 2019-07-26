    </div><!-- End main -->
    <?php

    $footer_title                  = get_field('footer_title', 'option');
    $contact_form_7shortcode       = get_field('contact_form_7shortcode', 'option');
    $subscribe_text                = get_field('subscribe_text', 'option');
    $subscribe_mailchimp_shortcode = get_field('subscribe_mailchimp_shortcode', 'option');
    $footer_copyright_text         = get_field('footer_copyright_text', 'option');
    $social_facebook_link          = get_field('social_facebook_link', 'option');
    $social_twitter_link           = get_field('social_twitter_link', 'option');
    $social_linkendin_link         = get_field('social_linkendin_link', 'option');
    $contact_footer_title = get_field('contact_footer_title', $post_id);

    ?>
    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid no-padding">
            <div class="footer__bottom b-container-width">
                <div class="subscribe">
                    <div class="subscribe__text">
                        <p><?php echo $subscribe_text; ?></p>
                    </div>
                    <?php echo do_shortcode($subscribe_mailchimp_shortcode); ?>
                </div>
                <div class="copyright copyright__desktop">
                    <div class="copyright__text">
                        <div class="logo">
                            <a href="<?php echo home_url('/'); ?>">
                                <img src="/wp-content/themes/crosscut/assets/img/logo/footer_logo.svg" alt="">
                            </a>
                        </div>
                        <p><?php echo $footer_copyright_text; ?></p>
                    </div>
                    <div class="copyright__social">
                        <ul class="clearfix">
                            <?php if($social_facebook_link || $social_twitter_link || $social_linkendin_link) { ?>
                                <li>Visit us:</li>
                            <?php }
                            if($social_facebook_link) { ?>
                                <li class="copyright__icon copyright__icon_facebook">
                                    <a href="<?php echo $social_facebook_link; ?>"></a>
                                </li>
                            <?php }
                            if($social_twitter_link) { ?>
                                <li class="copyright__icon copyright__icon_twitter">
                                    <a href="<?php echo $social_twitter_link; ?>"></a>
                                </li>
                            <?php }
                            if($social_linkendin_link) { ?>
                                <li class="copyright__icon copyright__icon_linkedin">
                                    <a href="<?php echo $social_linkendin_link; ?>"></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="copyright copyright__mobile">
                    <div class="copyright__social">
                        <div class="logo">
                            <a href="<?php echo home_url('/'); ?>">
                                <img src="/wp-content/themes/crosscut/assets/img/logo/footer_logo.svg" alt="">
                            </a>
                        </div>
                        <ul class="clearfix">
                            <?php if($social_facebook_link) { ?>
                            <li class="copyright__icon copyright__icon_facebook">
                                <a href="<?php echo $social_facebook_link; ?>"></a>
                            </li>
                            <?php }
                            if($social_twitter_link) { ?>
                            <li class="copyright__icon copyright__icon_twitter">
                                <a href="<?php echo $social_twitter_link; ?>"></a>
                            </li>
                            <?php }
                            if($social_linkendin_link) { ?>
                            <li class="copyright__icon copyright__icon_linkedin">
                                <a href="<?php echo $social_linkendin_link; ?>"></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="copyright__text">
                        <p><?php echo $footer_copyright_text; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__triangle"></div>
    </footer><!--End footer-->

<?php wp_footer(); ?>
</body>
</html>