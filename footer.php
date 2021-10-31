<?php
if (et_theme_builder_overrides_layout(ET_THEME_BUILDER_HEADER_LAYOUT_POST_TYPE) || et_theme_builder_overrides_layout(ET_THEME_BUILDER_FOOTER_LAYOUT_POST_TYPE)) {
    // Skip rendering anything as this partial is being buffered anyway.
    // In addition, avoids get_sidebar() issues since that uses
    // locate_template() with require_once.
    return;
}

/**
 * Fires after the main content, before the footer is output.
 *
 * @since 3.10
 */
do_action('et_after_main_content');

if ('on' === et_get_option('divi_back_to_top', 'false')) : ?>

    <span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if (!is_page_template('page-template-blank.php')) : ?>

    <footer id="main-footer">
        <?php get_sidebar('footer'); ?>


        <?php
        if (has_nav_menu('footer-menu')) : ?>

            <div id="et-footer-nav">
                <div class="container">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'depth'          => '1',
                        'menu_class'     => 'bottom-nav',
                        'container'      => '',
                        'fallback_cb'    => '',
                    ));
                    ?>
                </div>
            </div>

        <?php endif; ?>

        <div id="footer-bottom">
            <div class="container clearfix">
                <!-- <?php
                        if (false !== et_get_option('show_footer_social_icons', true)) {
                            get_template_part('includes/social_icons', 'footer');
                        }

                        // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo et_core_fix_unclosed_html_tags(et_core_esc_previously(et_get_footer_credits()));
                        // phpcs:enable
                        ?> -->
            </div>
            <div class="footer-bottom-info">
                <div class="container">
                    <div class="footer-bottom-info__inner">
                        <p>
                            Вы можете оформить заказ по телефону: +38097-992-70-80
                        </p>
                        <a href="tel:0234232352" class="footer-bottom-info__tel-btn" disabled>
                            ЗАКАЗАТЬ ЗВОНОК

                            <span class="footer-bottom-info__tel-btn-icon">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.65399 12.3342C5.76521 12.3345 5.87511 12.3125 5.9756 12.2698C6.07609 12.2272 6.16462 12.1648 6.2347 12.0875L9.83063 8.0875C9.94014 7.96821 10 7.81858 10 7.66417C10 7.50975 9.94014 7.36012 9.83063 7.24083L6.10813 3.24083C5.98176 3.10469 5.80017 3.01907 5.6033 3.00282C5.40644 2.98657 5.21042 3.04101 5.05838 3.15417C4.90634 3.26733 4.81073 3.42993 4.79258 3.60622C4.77443 3.7825 4.83523 3.95802 4.9616 4.09417L8.28952 7.6675L5.07327 11.2408C4.98223 11.3387 4.9244 11.4579 4.90663 11.5842C4.88885 11.7106 4.91186 11.8389 4.97296 11.9539C5.03405 12.0689 5.13065 12.1658 5.25134 12.2332C5.37204 12.3006 5.51176 12.3357 5.65399 12.3342Z" fill="#011350" />
                                </svg>
                            </span>
                        </a>
                        <div class="footer-bottom-info__copy-wrap">
                            <span class="footer-bottom-info__copy">
                                &copy; 2021 All rights reserved
                            </span>
                            <ul class="footer-bottom-info__list">
                                <li>
                                    <a href="#">
                                        Условия соглашения
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Политика конфиденциальности
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>

<?php endif; // ! is_page_template( 'page-template-blank.php' ) 
?>

</div>

<?php wp_footer(); ?>

<script src='http://dima.site/wp-content/themes/AstiDivi/assets/main.min.js'></script>
</body>

</html>