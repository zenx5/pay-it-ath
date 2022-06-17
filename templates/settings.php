<h3>Ath Movil Settings</h3>

<div style="display:flex; flex-direction:row; ">
    <table width="40%">
        <tr>
            <th>Enviroment</th>
            <td>
                <select id="varath_env" name="varath_env" style="min-width:100%; width:100%;">
                    <option value="sandbox" <?= get_option('varath_env') == "sandbox" ? "checked" : "" ?>>Sandbox</option>
                    <option value="production" <?= get_option('varath_env') == "production" ? "checked" : "" ?>>Production</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Public Token</th>
            <td>
                <input type="text" id="varath_token" name="varath_token" value="<?= get_option('varath_token') ?>" style="min-width:100%; width:100%;">
            </td>
        </tr>
        <tr>
            <th>Private Token</th>
            <td>
                <input type="text" id="varath_token_priv" name="varath_token_priv" value="<?= get_option('varath_token_priv') ?>" style="min-width:100%; width:100%;">
            </td>
        </tr>
        <tr>
            <th>Timeout</th>
            <td>
                <input type="number" id="varath_timeout" name="varath_timeout" min="120" max="600" value="<?= get_option('varath_timeout') ?>" style="min-width:100%; width:100%;">
            </td>
        </tr>
        <tr>
            <th>Theme</th>
            <td>
                <select id="varath_theme" name="varath_theme" style="min-width:100%; width:100%;">
                    <option value="btn" <?= get_option('varath_theme') == "btn" ? "checked" : "" ?>>btn</option>
                    <option value="btn-dark" <?= get_option('varath_theme') == "btn-dark" ? "checked" : "" ?>>btn-dark</option>
                    <option value="btn-light" <?= get_option('varath_theme') == "btn-light" ? "checked" : "" ?>>btn-light</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Language</th>
            <td>
                <select id="varath_lang" name="varath_lang" style="min-width:100%; width:100%;">
                    <option value="es" <?= get_option('varath_lang') == "es" ? "selected" : "" ?>>Español</option>
                    <option value="en" <?= get_option('varath_lang') == "en" ? "selected" : "" ?>>English</option>
                </select>
            </td>
        </tr>

    </table>
    <div style="width: 60%;">
        <a href="https://bohiques.com" target="_blank"><img style="width: 300px;margin-left: auto;margin-right: auto;display: block;" src="<?= WP_PLUGIN_URL . "/pay-it-ath/templates/screenshot.png" ?>" /></a>
    </div>
</div>
<div style="margin: 20px;">
    <button class="button button-primary" id="save-varath">Guardar</button>
    <button class="button" id="reset-varath">Restaurar</button>
</div>


<script type="text/javascript">
    (function($) {
        let varath = {
            env: "<?= get_option('varath_env') ?>",
            token: "<?= get_option('varath_token') ?>",
            priv: "<?= get_option('varath_token_priv') ?>",
            timeout: <?= get_option('varath_timeout') ?>,
            theme: "<?= get_option('varath_theme') ?>",
            lang: "<?= get_option('varath_lang') ?>",
        }

        console.log(varath)

        const get_data = () => {
            let data = {
                length: 0
            };
            if (varath.env != $("#varath_env").val()) {
                data.varath_env = $("#varath_env").val();
                data.length += 1
            }
            if (varath.token != $("#varath_token").val()) {
                data.varath_token = $("#varath_token").val();
                data.length += 1
            }
            if (varath.priv != $("#varath_token_priv").val()) {
                data.varath_token = $("#varath_token_priv").val();
                data.length += 1
            }
            if (varath.timeout != $("#varath_timeout").val()) {
                data.varath_timeout = $("#varath_timeout").val();
                data.length += 1
            }
            if (varath.theme != $("#varath_theme").val()) {
                data.varath_theme = $("#varath_theme").val();
                data.length += 1
            }
            if (varath.lang != $("#varath_lang").val()) {
                data.varath_lang = $("#varath_lang").val();
                data.length += 1
            }
            return data;
        }

        $("#save-varath").click(function() {
            let data = get_data()
            if (data.length != 0) {
                $.ajax({
                    method: 'post',
                    url: ajaxurl,
                    data: {
                        action: 'pay_it_ath_update_varath',
                        ...data
                    },
                    success: function(response) {
                        console.log(response)
                    }
                })
            }
        })

        $("#reset-varath").click(function() {
            $.ajax({
                method: 'post',
                url: ajaxurl,
                data: {
                    action: 'pay_it_ath_reset_varath'
                },
                success: function(response) {
                    if (JSON.parse(response)) {
                        $("#varath_env").val('sandbox')
                        $("#varath_token").val('sandboxtoken01875617264')
                        $("#varath_token_priv").val('sandboxtoken01875617264')
                        $("#varath_timeout").val(600)
                        $("#varath_theme").val('btn')
                        $("#varath_lang").val('en')
                    }
                }
            })
        })
    })(jQuery)
</script>