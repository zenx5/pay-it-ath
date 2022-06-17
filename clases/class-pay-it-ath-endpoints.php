<?php


class PayitAthEndpoints
{
    private static $endpoints = [
        "update_varath",
        "reset_varath",
        "get_report",
        "search"
    ];

    public static function init()
    {
        foreach (self::$endpoints as $endpoint) {
            add_action('wp_ajax_pay_it_ath_' . $endpoint, ['PayitAthEndpoints', $endpoint]);
        }
    }

    public static function get_endpoints()
    {
        return self::$endpoints;
    }

    public static function reset_varath()
    {
        update_option('varath_env', 'sandbox');
        update_option('varath_token', 'sandboxtoken01875617264');
        update_option('varath_token_priv', 'sandboxtoken01875617264');
        update_option('varath_timeout', 600);
        update_option('varath_theme', 'btn');
        update_option('varath_lang', 'en');
        echo "true";
        wp_die();
    }

    public static function update_varath()
    {
        try {
            if (isset($_POST['varath_env'])) {
                if ("sandbox" === $_POST['varath_env'] || "production" === $_POST['varath_env']) {
                    update_option('varath_env', $_POST['varath_env']);
                } else {
                    echo "false";
                    wp_die();
                }
            }
            if (isset($_POST['varath_token'])) {
                update_option('varath_token', $_POST['varath_token']);
            }
            if (isset($_POST['varath_token_priv'])) {
                update_option('varath_token_priv', $_POST['varath_token_priv']);
            }
            if (isset($_POST['varath_timeout'])) {
                update_option('varath_timeout', $_POST['varath_timeout']);
            }
            if (isset($_POST['varath_theme'])) {
                if ("btn" === $_POST['varath_theme'] || "btn-dark" === $_POST['varath_theme'] || "btn-light" === $_POST['varath_theme']) {
                    update_option('varath_theme', $_POST['varath_theme']);
                } else {
                    echo "false";
                    wp_die();
                }
            }
            if (isset($_POST['varath_lang'])) {
                if ("es" === $_POST['varath_lang'] || "en" === $_POST['varath_lang']) {
                    update_option('varath_lang', $_POST['varath_lang']);
                } else {
                    echo "false";
                    wp_die();
                }
            }
            echo "true";
        } catch (Exception $err) {
            echo "false";
        }
        wp_die();
    }

    public static function get_report()
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request(
                "get",
                "https://www.athmovil.com/transactions/v4/transactionReport",
                [
                    "headers" => ["Content-Type" => "application/json"],
                    "form_params" => [
                        "publicToken" => get_option('varath_token'), //"hdb932832klnasKJGDW90291",
                        "privateToken" => get_option('varath_token'), //"JHEFEWP2048FNDFLKJWB2",
                        "fromDate" => $_POST['ath_from'],
                        "toDate" => $_POST['ath_to']
                    ]
                ]
            )->getBody()->getContents();
            echo `<table>
                <tr>
                    <th>a</th>
                    <td>b</td>
                </tr>
            </table>`;
        } catch (GuzzleHttp\Exception\RequestException $e) {
            echo json_encode([
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
                "file" => $e->getFile(),
                "line" => $e->getLine(),
                "response" => $e->getResponse()->getBody()->getContents()
            ]);
        }
        wp_die();
    }

    public static function search()
    {
    }
}
