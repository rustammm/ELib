<?php
    require_once('../../../stuff/config.php');
	permission('admin', false);
	echo "
	<script language='JavaScript' src='http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js'></script>
	<script src='$http_adress/stuff/style/scriptcam.js'></script>
	<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>

	<!--  -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>

	<!-- Latest compiled and minified JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
	";
?>

<div id = "webcamdiv">
	<script>

        function success_n(message) {
            $.notify(message, "success");
        }

        function error_n(message) {
            $.notify(message, "error");
        }

        function get_page(urli, func) {
            var request = $.ajax({
                type: "GET",
                url: urli
            });
            request.done(func);
            request.fail(function( jqXHR, textStatus, errorThrown ) {
                error_n("<?php echo _("Ошибка соединения"); ?>");
                console.log(errorThrown);
            });
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1);
                if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
            }
            return "";
        }

        function read_msg (msg) {
            if (msg == "-2") {
                error_n("<?php echo _("У вас нет доступа!"); ?>");
				return;
            }
            if (msg == "-1") {
                error_n("<?php echo _("Такой книги или ученика не существут!"); ?>");
				return;
            }
            if (msg == "0") {
                error_n("<?php echo _("Ошибка сервера. Повторите попытку"); ?>");
				return;
            }
			if (msg == "1") {
				success_n("<?php echo _("Добавлено"); ?>");
			}
			console.log(msg);
        }

		function do_sth() {
            var sid = getCookie("PHPSESSID");
            var type = "";
            var url = "", url2 = "";
			var text = $.scriptcam.getBarCode();
			$('#decoded').text(text);
			if (text == "") return;
			var values = text.split("@");
            if (values.length == 3) {
                url2 = "type=book&s1=" + values[1] + "&s2=" + values[2];
            } else {
                url2 = "type=student&id=" + values[1];
            }
            url = "addToQueue.php?sid=" + sid + "&library=" + values[0] + "&" + url2;
			console.log(url);
            get_page(url, read_msg);
		
		}

		$("#webcamdiv").ready(function() {
			$("#webcam").scriptcam({
				onError:onError,
				cornerRadius:0,
				onWebcamReady:onWebcamReady
			});
			setInterval(do_sth, 1000);
		});

		function onError(errorId,errorMsg) {
			$.notify(message, "error");
		}			
		function changeCamera() {
			$.scriptcam.changeCamera($('#cameraNames').val());
		}
		function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
			$.each(cameraNames, function(index, text) {
				$('#cameraNames').append( $('<option></option>').val(index).html(text) )
			}); 
			$('#cameraNames').val(camera);
		}
	</script> 
	<div style="width:330px;float:left;">
		<div id="webcam">
		</div>
		<div style="margin:5px;">
			<img src="webcamlogo.png" style="vertical-align:text-top"/>
			<select id="cameraNames" size="1" onChange="changeCamera()" style="width:245px;font-size:10px;height:25px;">
			</select>
		</div>
	</div>
	<div style="width:135px;float:left;">
		<p><button class="btn btn-small" id="btn1" onclick="$('#decoded').text($.scriptcam.getBarCode());">Decode image</button></p>
	</div>
	<div style="width:200px;float:left;">
		<p id="decoded"></p>
	</div>
</div>

<?php
	require_once('../../../stuff/footer.php');
?>
