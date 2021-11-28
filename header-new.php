<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <?php
	elegant_description();
	elegant_keywords();
	elegant_canonical();

	/**
	 * Fires in the head, before {@see wp_head()} is called. This action can be used to
	 * insert elements into the beginning of the head before any styles or scripts.
	 *
	 * @since 1.0
	 */
	do_action( 'et_head_meta' );

	$template_directory_uri = get_template_directory_uri();
	
?>

    <link rel="pingback"
        href="<?php bloginfo('pingback_url'); ?>" />

    <script type="text/javascript">
    document.documentElement.className = 'js';
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
	wp_body_open();

	$product_tour_enabled = et_builder_is_product_tour_enabled();
	$page_container_style = $product_tour_enabled ? ' style="padding-top: 0px;"' : ''; ?>
    <div id="page-container"
        class="header-block"
        <?php echo et_core_intentionally_unescaped( $page_container_style, 'fixed_string' ); ?>>
        <?php
	if ( $product_tour_enabled || is_page_template( 'page-template-blank.php' ) ) {
		return;
	}

	$et_secondary_nav_items = et_divi_get_top_nav_items();

	$et_phone_number = $et_secondary_nav_items->phone_number;

	$et_email = $et_secondary_nav_items->email;

	$et_contact_info_defined = $et_secondary_nav_items->contact_info_defined;

	$show_header_social_icons = $et_secondary_nav_items->show_header_social_icons;

	$et_secondary_nav = $et_secondary_nav_items->secondary_nav;

	$et_top_info_defined = $et_secondary_nav_items->top_info_defined;

	$et_slide_header = 'slide' === et_get_option( 'header_style', 'left' ) || 'fullscreen' === et_get_option( 'header_style', 'left' ) ? true : false;
?>



        <?php if ( $et_slide_header || is_customize_preview() ) : ?>
        <?php ob_start(); ?>
        <div class="et_slide_in_menu_container">
            <?php if ( 'fullscreen' === et_get_option( 'header_style', 'left' ) || is_customize_preview() ) { ?>
            <span class="mobile_menu_bar et_toggle_fullscreen_menu"></span>
            <?php } ?>

            <?php
				if ( $et_contact_info_defined || true === $show_header_social_icons || false !== et_get_option( 'show_search_icon', true ) || class_exists( 'woocommerce' ) || is_customize_preview() ) { ?>
            <div class="et_slide_menu_top">

                <?php if ( 'fullscreen' === et_get_option( 'header_style', 'left' ) ) { ?>
                <div class="et_pb_top_menu_inner">
                    <?php } ?>
                    <?php }

				if ( true === $show_header_social_icons ) {
					get_template_part( 'includes/social_icons', 'header' );
				}

				et_show_cart_total();
			?>
                    <?php if ( false !== et_get_option( 'show_search_icon', true ) || is_customize_preview() ) : ?>
                    <?php if ( 'fullscreen' !== et_get_option( 'header_style', 'left' ) ) { ?>
                    <div class="clear"></div>
                    <?php } ?>
                    <form role="search"
                        method="get"
                        class="et-search-form"
                        action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php
						printf( '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
							esc_attr__( 'Search &hellip;', 'Divi' ),
							get_search_query(),
							esc_attr__( 'Search for:', 'Divi' )
						);

						/**
						 * Fires inside the search form element, just before its closing tag.
						 *
						 * @since ??
						 */
						do_action( 'et_search_form_fields' );
					?>
                        <button type="submit"
                            id="searchsubmit_header"></button>
                    </form>
                    <?php endif; // true === et_get_option( 'show_search_icon', false ) ?>

                    <?php if ( $et_contact_info_defined ) : ?>

                    <div id="et-info">
                        <?php if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) : ?>
                        <span
                            id="et-info-phone"><?php echo et_core_esc_previously( et_sanitize_html_input_text( $et_phone_number ) ); ?></span>
                        <?php endif; ?>

                        <?php if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) : ?>
                        <a href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>"><span
                                id="et-info-email"><?php echo esc_html( $et_email ); ?></span></a>
                        <?php endif; ?>
                    </div>

                    <?php endif; // true === $et_contact_info_defined ?>
                    <?php if ( $et_contact_info_defined || true === $show_header_social_icons || false !== et_get_option( 'show_search_icon', true ) || class_exists( 'woocommerce' ) || is_customize_preview() ) { ?>
                    <?php if ( 'fullscreen' === et_get_option( 'header_style', 'left' ) ) { ?>
                </div>
                <?php } ?>

            </div>
            <?php } ?>

            <div class="et_pb_fullscreen_nav_container">
                <?php
					$slide_nav = '';
					$slide_menu_class = 'et_mobile_menu';

					$slide_nav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'echo' => false, 'items_wrap' => '%3$s' ) );
					$slide_nav .= wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => '', 'fallback_cb' => '', 'echo' => false, 'items_wrap' => '%3$s' ) );
				?>

                <ul id="mobile_menu_slide"
                    class="<?php echo esc_attr( $slide_menu_class ); ?>">

                    <?php
					if ( '' === $slide_nav ) :
				?>
                    <?php if ( 'on' === et_get_option( 'divi_home_link' ) ) { ?>
                    <li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a
                            href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'Divi' ); ?></a>
                    </li>
                    <?php }; ?>

                    <?php show_page_menu( $slide_menu_class, false, false ); ?>
                    <?php show_categories_menu( $slide_menu_class, false ); ?>
                    <?php
					else :
						echo et_core_esc_wp( $slide_nav ) ;
					endif;
				?>

                </ul>
            </div>
        </div>
        <?php
		$slide_header = ob_get_clean();

		/**
		 * Filters the HTML output for the slide header.
		 *
		 * @since 3.10
		 *
		 * @param string $top_header
		 */
		echo et_core_intentionally_unescaped( apply_filters( 'et_html_slide_header', $slide_header ), 'html' );
	?>
        <?php endif; // true ==== $et_slide_header ?>

        <?php ob_start(); ?>
        <header id="main-header"
            data-height-onload="<?php echo esc_attr( et_get_option( 'menu_height', '66' ) ); ?>">

            <?php
				$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && ! empty( $user_logo )
					? $user_logo
					: $template_directory_uri . '/images/logo.png';

				// Get logo image size based on attachment URL.
				$logo_size   = et_get_attachment_size_by_url( $logo );
				$logo_width  = ( ! empty( $logo_size ) && is_numeric( $logo_size[0] ) )
						? $logo_size[0]
						: '93'; // 93 is the width of the default logo.
				$logo_height = ( ! empty( $logo_size ) && is_numeric( $logo_size[1] ) )
						? $logo_size[1]
						: '43'; // 43 is the height of the default logo.

				ob_start();
			?>
            <div class="logo_container">
                <span class="logo_helper"></span>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_attr( $logo ); ?>"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                </a>
            </div>
            <?php
				$logo_container = ob_get_clean();

				/**
				 * Filters the HTML output for the logo container.
				 *
				 * @since 3.10
				 *
				 * @param string $logo_container
				 */
				echo et_core_intentionally_unescaped( apply_filters( 'et_html_logo_container', $logo_container ), 'html' );
			?>

            <?php if ( $et_top_info_defined && ! $et_slide_header || is_customize_preview() ) : ?>
            <?php ob_start(); ?>

            <?php
		$top_header = ob_get_clean();

		/**
		 * Filters the HTML output for the top header.
		 *
		 * @since 3.10
		 *
		 * @param string $top_header
		 */
		echo et_core_intentionally_unescaped( apply_filters( 'et_html_top_header', $top_header ), 'html' );
	?>
            <?php endif; // true ==== $et_top_info_defined ?>
            <div class="may-container">

                <div id="et-top-navigation"
                    data-height="<?php echo esc_attr( et_get_option( 'menu_height', '66' ) ); ?>"
                    data-fixed-height="<?php echo esc_attr( et_get_option( 'minimized_menu_height', '40' ) ); ?>">
                    <div class="header-block__top">
                        <div class="header-block__top-inner">
                            <?php if ( $et_contact_info_defined ) : ?>

                            <div class="header-block__info">
                                <?php if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) : ?>
                                <a class="header-block__tel"
                                    href="<?php echo esc_attr( 'tel:' . $et_phone_number ); ?>">
                                    <span class="header-block__tel-icon">
                                        <svg width="16"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.6 14.667A10.28 10.28 0 0 1 1.333 4.4 3.067 3.067 0 0 1 4.4 1.333c.172-.001.344.015.513.047.164.024.325.064.48.12a.667.667 0 0 1 .434.5l.913 4a.667.667 0 0 1-.173.613c-.087.094-.094.1-.913.527A6.607 6.607 0 0 0 8.9 10.4c.434-.827.44-.833.534-.92a.667.667 0 0 1 .613-.173l4 .913a.667.667 0 0 1 .48.433 2.89 2.89 0 0 1 .167.994 3.067 3.067 0 0 1-3.094 3.02Z"
                                                fill="#011350" />
                                        </svg>
                                    </span>
                                    <span class="header-block__info-desc">
                                        <?php echo esc_html( $et_phone_number ); ?></span></a>
                                <?php endif; ?>

                                <?php if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) : ?>
                                <a class="header-block__email"
                                    href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>">
                                    <span class="header-block__email-icon">
                                        <svg width="16"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.667 5.739v5.428a2.166 2.166 0 0 1-2.044 2.163l-.123.003h-9a2.166 2.166 0 0 1-2.163-2.044l-.004-.122V5.739l6.435 3.37a.5.5 0 0 0 .464 0l6.435-3.37ZM3.5 2.667h9a2.166 2.166 0 0 1 2.156 1.949L8 8.103 1.344 4.616A2.167 2.167 0 0 1 3.376 2.67l.124-.003h9-9Z"
                                                fill="#011350" />
                                        </svg>
                                    </span>
                                    <span
                                        class="header-block__info-desc"><?php echo esc_html( $et_email ); ?></span></a>
                                <?php endif; ?>

                                <?php
				if ( true === $show_header_social_icons ) {
					get_template_part( 'includes/social_icons', 'header' );
				} ?>
                            </div>

                            <?php endif; // true === $et_contact_info_defined ?>

                            <div id="et-secondary-menu">
                                <?php
					if ( ! $et_contact_info_defined && true === $show_header_social_icons ) {
						get_template_part( 'includes/social_icons', 'header' );
					} else if ( $et_contact_info_defined && true === $show_header_social_icons ) {
						ob_start();

						get_template_part( 'includes/social_icons', 'header' );

						$duplicate_social_icons = ob_get_contents();

						ob_end_clean();

						printf(
							'<div class="et_duplicate_social_icons">
								%1$s
							</div>',
							et_core_esc_previously( $duplicate_social_icons )
						);
					}

					if ( '' !== $et_secondary_nav ) {
						echo et_core_esc_wp( $et_secondary_nav );
					}



				?>
                                <div class="header-block__top-left-item">
                                    <div class="header-block__top-link top-link--search"
                                        id="et_top_search">
                                        <span class="header-block__top-link-icon">
                                            <svg width="20"
                                                height="20"
                                                viewBox="0 0 20 20"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="m13.604 12.416 4.483 4.483a.841.841 0 0 1-1.189 1.188l-4.483-4.483a6.667 6.667 0 1 1 1.188-1.188h.001Zm-5.27.917a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z"
                                                    fill="#011350" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="header-block__top-left-item">
                                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
                                        class="header-block__top-link top-lin--user">
                                        <span class="header-block__top-link-icon">
                                            <svg width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M20.75 19.265a9.674 9.674 0 0 0-5.755-4.457 5.714 5.714 0 1 0-5.174 0 9.673 9.673 0 0 0-5.755 4.457.49.49 0 0 0 .848.49 8.655 8.655 0 0 1 14.989 0 .49.49 0 1 0 .847-.49ZM7.674 9.716a4.734 4.734 0 1 1 9.468 0 4.734 4.734 0 0 1-9.468 0Z"
                                                    fill="#011350" />
                                            </svg>
                                        </span>
                                        <span class="header-block__top-link-desc">
                                            <?php
                                            if (is_user_logged_in()) {
                                                _e('Личный кабинет','asti-divi' );
                                            } else {
                                                _e('Войти / Регистрация','asti-divi');
                                            }
                                            ?>
                                        </span>
                                    </a>
                                    </div>

                                <?php if (is_user_logged_in()):
                                   $account_endpoint = get_permalink( get_option('woocommerce_myaccount_page_id') );
                                   $order_path = get_option('woocommerce_myaccount_orders_endpoint');
                                   $account_order_url = $account_endpoint . '/' . $order_path;
                                    ?>
                                    <div class="header-block__top-left-item">
                                    <a href="<?php echo $account_order_url; ?>"
                                        class="header-block__top-link top-link--like">
                                        <span class="header-block__top-link-icon">
                                            <svg width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.889 20a.557.557 0 0 1-.34-.116c-3.088-2.395-5.217-4.457-6.706-6.492-1.9-2.6-2.333-5-1.289-7.134.745-1.524 2.884-2.772 5.384-2.046a5.484 5.484 0 0 1 2.95 2.09 5.484 5.484 0 0 1 2.951-2.09c2.495-.715 4.64.522 5.385 2.046 1.044 2.134.61 4.535-1.29 7.134-1.489 2.035-3.617 4.097-6.706 6.492a.556.556 0 0 1-.34.116ZM7.516 5.116A3.284 3.284 0 0 0 4.554 6.74c-.86 1.763-.472 3.725 1.19 5.993a31.71 31.71 0 0 0 6.145 6.009 31.712 31.712 0 0 0 6.145-6.004c1.667-2.273 2.05-4.235 1.19-5.992-.556-1.109-2.223-1.99-4.079-1.47A4.448 4.448 0 0 0 12.4 7.606a.555.555 0 0 1-1.028 0 4.395 4.395 0 0 0-2.745-2.328 4.07 4.07 0 0 0-1.111-.16Z"
                                                    fill="#011350" />
                                            </svg>
                                        </span>
                                        <span class="header-block__top-link-desc"><?php _e('Избранное', 'asti-divi' ) ?></span>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <div class="header-block__top-left-item">
                                    <a class="header-block__top-link top-link--cart-count"
                                        href="<?php echo wc_get_cart_url(); ?>">
                                        <?php if ( get_cart_total() > 0 ): ?>
                                        <span class="header-block__total-cart-count"><?php echo get_cart_total(); ?></span>
                                        <?php endif; ?>
                                        <span class="header-block__top-link-icon">
                                            <svg width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21.54 7.854a.545.545 0 0 0-.467-.245H8.64l-.953-3.212a2.478 2.478 0 0 0-.347-.744 1.356 1.356 0 0 0-.467-.435 2.054 2.054 0 0 0-.43-.173A1.518 1.518 0 0 0 6.075 3H3.568A.562.562 0 0 0 3 3.58c0 .097.024.191.073.282.05.09.12.16.21.209a.6.6 0 0 0 .285.072h2.508c.049 0 .095.006.138.018.042.012.1.064.173.155.074.09.135.226.184.408l3.24 11.794a.657.657 0 0 0 .312.363.529.529 0 0 0 .238.055h7.91a.578.578 0 0 0 .339-.11.538.538 0 0 0 .21-.272l2.802-8.165a.578.578 0 0 0-.083-.535Zm-3.672 7.92h-7.05L8.952 8.77h11.28l-2.363 7.004Zm-1.153 2.323c-.403 0-.748.142-1.035.426-.287.285-.43.626-.43 1.025 0 .4.143.741.43 1.026.287.284.632.426 1.035.426.402 0 .747-.142 1.034-.426.287-.285.43-.626.43-1.026 0-.399-.143-.74-.43-1.025a1.417 1.417 0 0 0-1.034-.426Zm-5.274 0c-.268 0-.516.066-.741.2a1.469 1.469 0 0 0-.531.526c-.129.217-.193.46-.193.725 0 .4.144.741.43 1.026.287.284.632.426 1.035.426.403 0 .748-.142 1.035-.426.287-.285.43-.626.43-1.026 0-.096-.01-.193-.027-.29a1.28 1.28 0 0 0-.22-.517 1.578 1.578 0 0 0-.65-.535 1.318 1.318 0 0 0-.275-.082 1.595 1.595 0 0 0-.293-.027Z"
                                                    fill="#011350" />
                                            </svg>
                                        </span>
                                        <span class="header-block__top-link-desc"><?php _e('Cart', 'woocommerce') ?></span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php if ( ! $et_slide_header || is_customize_preview() ) : ?>
                    <nav id="top-menu-nav">
                        <?php
							$menuClass = 'nav';
							if ( 'on' === et_get_option( 'divi_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
							$primaryNav = '';

							$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => 'top-menu', 'echo' => false ) );
							if ( empty( $primaryNav ) ) :
						?>
                        <ul id="top-menu"
                            class="<?php echo esc_attr( $menuClass ); ?>">
                            <?php if ( 'on' === et_get_option( 'divi_home_link' ) ) { ?>
                            <li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a
                                    href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'Divi' ); ?></a>
                            </li>
                            <?php }; ?>

                            <?php show_page_menu( $menuClass, false, false ); ?>
                            <?php show_categories_menu( $menuClass, false ); ?>
                        </ul>
                        <?php
							else :
								echo et_core_esc_wp( $primaryNav );
							endif;
						?>
                    </nav>
                    <?php endif; ?>

                    <?php
					if ( ! $et_top_info_defined && ( ! $et_slide_header || is_customize_preview() ) ) {
						et_show_cart_total( array(
							'no_text' => true,
						) );
					}
					?>

                    <?php if ( $et_slide_header || is_customize_preview() ) : ?>
                    <span
                        class="mobile_menu_bar et_pb_header_toggle et_toggle_<?php echo esc_attr( et_get_option( 'header_style', 'left' ) ); ?>_menu"></span>
                    <?php endif; ?>

                    <?php if ( ( false !== et_get_option( 'show_search_icon', true ) && ! $et_slide_header ) || is_customize_preview() ) : ?>

                    <?php endif; // true === et_get_option( 'show_search_icon', false ) ?>

                    <?php

					/**
					 * Fires at the end of the 'et-top-navigation' element, just before its closing tag.
					 *
					 * @since 1.0
					 */
					do_action( 'et_header_top' );

					?>
                </div>
            </div>
            <div class="container et_search_form_container">
                <form role="search"
                    method="get"
                    class="et-search-form"
                    action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
						printf( '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
							esc_attr__( 'Search &hellip;', 'Divi' ),
							get_search_query(),
							esc_attr__( 'Search for:', 'Divi' )
						);

						/**
						 * Fires inside the search form element, just before its closing tag.
						 *
						 * @since ??
						 */
						do_action( 'et_search_form_fields' );
					?>
                </form>
                <span class="et_close_search_field">

                </span>
            </div>
        </header>
        <?php
		$main_header = ob_get_clean();

		/**
		 * Filters the HTML output for the main header.
		 *
		 * @since 3.10
		 *
		 * @param string $main_header
		 */
		echo et_core_intentionally_unescaped( apply_filters( 'et_html_main_header', $main_header ), 'html' );
	?>
        <div id="et-main-area">
    <?php
		/**
		 * Fires after the header, before the main content is output.
		 *
		 * @since 3.10
		 */

		do_action( 'et_before_main_content' );