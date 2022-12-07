<h3>ATH Movil Report</h3>

<div style="display: flex; flex-direction:row;">
    <table width="50%">
        <tr>
            <th>From Date</th>
            <td>
                <input type="date" id="ath_from_date" name="ath_from_date">
            </td>
        </tr>
        <tr>
            <th>To Date</th>
            <td>
                <input type="date" id="ath_to_date" name="ath_to_date">
            </td>
        </tr>
    </table>

    <table width="50%">
        <tr>
            <td>
                <button class="button button-primary" id="search-varath">Buscar</button>
            </td>
        </tr>
        <tr>
            <td>
                <button class="button" id="reset-varath">Restaurar</button>
            </td>
        </tr>
    </table>
</div>
<div id="result">

</div>
<script type="text/javascript">
    (function($) {
        $("#result").hide()
        $("#search-varath").click(function() {
            $.ajax({
                method: 'post',
                url: ajaxurl,
                data: {
                    action: "pay_it_ath_get_report",
                    ath_from: $("#ath_from_date").val(),
                    ath_to: $("#ath_to_date").val()
                },
                success: function(response) {
                    $('#result').html(response)
                }
            })
        })
        $("#reset-varath").click(function() {
            $("#result").hide()
        })

    })(jQuery);
</script>