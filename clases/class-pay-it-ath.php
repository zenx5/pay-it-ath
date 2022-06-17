<?php


class PayitAth
{
    public static function active()
    {
        update_option('varath_env', 'sandbox');
        update_option('varath_token', 'sandboxtoken01875617264');
        update_option('varath_token_priv', 'sandboxtoken01875617264');
        update_option('varath_timeout', 600);
        update_option('varath_theme', 'btn');
        update_option('varath_lang', 'en');
    }

    public static function deactive()
    {
        delete_option('varath_env');
        delete_option('varath_token');
        delete_option('varath_token_priv');
        delete_option('varath_timeout');
        delete_option('varath_theme');
        delete_option('varath_lang');
    }

    public static function init()
    {
        add_action('admin_menu', ['PayitAth', 'menus']);
        add_action('wp_footer', ['PayitAth', 'ath_script']);
        PayitAthEndpoints::init();
    }

    public static function menus()
    {
        add_menu_page(
            'Pay it ATH',
            'Pay it ATH',
            'manage_options',
            'settings',
            ['PayitAth', 'settings'],
            '',
            6
        );

        add_submenu_page(
            'settings',
            'Search',
            'Search',
            'manage_options',
            'search',
            ['PayitAth', 'search']
        );

        add_submenu_page(
            'settings',
            'Report',
            'Report',
            'manage_options',
            'report',
            ['PayitAth', 'report']
        );
    }

    public static function settings()
    {
        include WP_PLUGIN_DIR . "/pay-it-ath/templates/settings.php";
    }

    public static function search()
    {
        include WP_PLUGIN_DIR . "/pay-it-ath/templates/search.php";
    }

    public static function report()
    {
        include WP_PLUGIN_DIR . "/pay-it-ath/templates/report.php";
    }

    public static function ath_script()
    {
        echo '<script src="https://www.athmovil.com/api/js/v3/athmovilV3.js"></script>';
    }

    public static function button($total, $tax, $subtotal, $meta1 = '', $meta2 = '', $items)
    {
?>
        <div id="ATHMovil_Checkout_Button"></div>
        <script type="text/javascript">
            ATHM_Checkout = {
                env: "<?= get_option('varath_env') ?>",
                publicToken: "<?= get_option('varath_token') ?>",
                timeout: <?= get_option('varath_timeout') ?>,
                theme: "<?= get_option('varath_theme') ?>",
                lang: "<?= get_option('varath_lang') ?>",

                total: <?= $total ?>,
                tax: <?= $tax ?>,
                subtotal: <?= $subtotal ?>,

                metadata1: "<?= $meta1 ?>",
                metadata2: "<?= $meta2 ?>",

                items: <?= json_encode($items) ?>
            }
        </script>

<?php
    }
}
