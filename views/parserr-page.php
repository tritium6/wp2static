<?php
// phpcs:disable Generic.Files.LineLength.MaxExceeded
// phpcs:disable Generic.Files.LineLength.TooLong

$run_nonce = wp_create_nonce( 'wp2static-run-page' );
?>

<script type="text/javascript">
    var latest_log_row = 0;

    jQuery(document).ready(function($){
        var clear_data = {
            action: 'parserr_clear',
            security: '<?php echo $run_nonce; ?>',
        };

        var build_data = {
            action: 'parserr_build',
            security: '<?php echo $run_nonce; ?>',
        };

        var deploy_data = {
            action: 'parserr_deploy',
            security: '<?php echo $run_nonce; ?>',
        };

        var log_data = {
            dataType: 'text',
            action: 'wp2static_poll_log',
            startRow: latest_log_row,
            security: '<?php echo $run_nonce; ?>',
        };

        function responseErrorHandler( jqXHR, textStatus, errorThrown ) {
            $("#wp2static-spinner").removeClass("is-active");
            $("#parserr-clear" ).prop('disabled', false);   //todo re-enable all buttons

            console.log(ajaxurl)
            console.log(errorThrown);
            console.log(jqXHR.responseText);

            alert(`${jqXHR.status} error code returned from server.
Please check your server's error logs or try increasing your max_execution_time limit in PHP if this consistently fails after the same duration.
More information of the error may be logged in your browser's console.`);
        }

        function pollLogs() {
            $.post(ajaxurl, log_data, function(response) {
                $('#wp2static-run-log').val(response);
                $("#wp2static-poll-logs" ).prop('disabled', false);
            });
        }

        function sendAjaxCommand(data, selector){
            console.log("sending Ajax cmd to : " + ajaxurl + " cmd: " + JSON.stringify(data));
            $("#wp2static-spinner").addClass("is-active");
            $(selector ).prop('disabled', true);

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: data,
                timeout: 0,
                success: function(resp) {
                    $("#wp2static-spinner").removeClass("is-active");
                    $(selector ).prop('disabled', false);
                    pollLogs();
                    console.log("ajax success: " + resp);
                },
                error: responseErrorHandler
            });

        }


        $( "#parserr-clear" ).click( function () {
            console.log("clearing logs")
            sendAjaxCommand(clear_data, "#parserr-clear")
        } );

        $( "#parserr-build" ).click( function () {
            console.log("building")
            sendAjaxCommand(build_data, "#parserr-build")
        } );

        $( "#parserr-preview" ).click( function () {
            console.log("previewing")
            // window.location = "https://marketing.parserr.com/wp-content/uploads/wp2static-processed-site/index.html";
            window.open("https://marketing.parserr.com/wp-content/uploads/wp2static-processed-site/index.html", '_blank');
        } );

        $( "#parserr-deploy" ).click( function () {
            console.log("deploying")
            sendAjaxCommand(deploy_data, "#parserr-deploy")
        } );

        $( "#wp2static-poll-logs" ).click(function() {
            $("#wp2static-poll-logs" ).prop('disabled', true);
            pollLogs();
        });

        pollLogs();
    });
</script>

<div class="wrap">
    <br>

    <button class="button button-primary" id="parserr-clear">Clear data from previous builds</button>
    <button class="button button-primary" id="parserr-build">Build static site</button>
    <button class="button button-primary" id="parserr-preview">Preview built site</button>
    <button class="button button-primary" id="parserr-deploy">Deploy static site to test environment</button>

    <div id="wp2static-spinner" class="spinner" style="padding:2px;float:none;"></div>

    <br>
    <br>

    <button class="button" id="wp2static-poll-logs">Refresh logs</button>
    <br>
    <br>
    <label for="wp2static-run-log">Output</label>
    <textarea id="wp2static-run-log" rows=30 style="width:99%;">
    Logs will appear here on completion or click "Refresh logs" to check progress
    </textarea>
</div>
