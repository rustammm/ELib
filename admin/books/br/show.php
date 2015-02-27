<?php require_once( '../../../stuff/config.php'); permission( 'admin', false); echo "
	<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>

	<!--  -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css'>

	<!-- Latest compiled and minified JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
	"; ?>



<script>
	var DataTable;

	function success_n(message) {
		$.notify(message, "success");
	}

	function error_n(message) {
		$.notify(message, "error");
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

	function add_book(data) {
		DataTable.row.add(data).draw();
	}

	function set_student(data) {
		stu = document.getElementById("student_frame");
		stu.src = "../../../public/student_data_only.php?id=" + data;
	}

	function pass_f(data, type) {
		pass = document.getElementById("password");
		if (type === 1) {
			if (pass.value.length < 6) {
				pass.value += data;
			}
		}
		if (type === 2) {
			pass.value = "";
		}
		if (type === 3) {
			return pass.value;
		}
	}

	function get_page(urli, datai, func) {
		var request = $.ajax({
			type: "POST",
			url: urli,
			data: datai,
			dataType: "json"
		});
		request.done(func);
		request.fail(function(jqXHR, textStatus, errorThrown) {
			error_n("<?php echo _("Ошибка соединения"); ?>");
			console.log(errorThrown);
		});
	}

	var ssid = getCookie("PHPSESSID");
	var student = -2;
	var last = 0;

	//                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                


	function upd(res) {
		console.log(res);
		if (res['error']["status"] === 1) {
			error_n(res['error']['message']);
		}
		last = res['last_id'];
		if (res["student"]["num"] >= 1) {
			if (student != (res["student"]["item"])) {
				student = res['student']["item"];
				set_student(student);
			}
		}
		for (i = 0; i < res['book']['num']; i++) {
			add_book((res['book']["item"][i]));
		}
		setTimeout(update_items_now, 200);
	}
	
	function update_items_now() {
		get_page("show_ajax.php", {
			sid: ssid,
			type: "i",
			last_id: last
		}, upd);		
	}
	
	function check(res) {
		console.log(res);
		if (res["error"]["status"] == 1) {
			error_n(res["error"]["message"]);
		} else {
			success_n(res["message"]);
		}
	}

	// Keyboard activity
	$("HTML").keyup(function(e) {
		var kk = e.keyCode;
		console.log(kk);
		if (kk >= 48 && kk <= 57) {
			pass_f(kk - 48, 1);
		}
		if (kk >= 96 && kk <= 105) {
			pass_f(kk - 96, 1);
		}
		if (kk == 110 || kk == 46) {
			e.preventDefault();
			pass_f(kk, 2);
		}
		if (kk == 11 || kk == 13) {
			e.preventDefault();
			if (student == -2) {
				get_page("show_ajax.php", {
					sid: ssid,
					type: "tolib",
					last_id: last
				}, check);
				last = 0;
			} else {
				var pass = pass_f(0, 3);
				get_page("show_ajax.php", {
					sid: ssid,
					type: "tostu",
					student_id: student,
					password: pass,
					last_id: last
				}, check);
				student = -2;
				set_student(student);
				
				last = 0;
			}
			DataTable.clear();
			DataTable.draw();
			pass_f("", 2);
		}
	});
	get_page("show_ajax.php", {
			sid: ssid,
			type: "i",
			last_id: last
			}, upd);
</script>


<div style="width:50%; position: absolute; left: 0px; top: 0%; height: 100%" id="books">
	<table class="dataTable display cell-border sortable2" style="width: 100%" align="center">
		<thead>
			<tr>
				<td>
					<h2><?php echo _("Название"); ?></h2>
				</td>
				<td>
					<h2><?php echo _("Класс"); ?> <h2>
            </td>
            <td>
                <h2><?php echo _("Серийный номер 1"); ?> <h2>
            </td>
            <td>
                <h2><?php echo _("Серийный номер 2"); ?> <h2>
            </td>
        </tr>
        </thead>
        <tfoot></tfoot>
    </table>
</div>

<div style="width:50%; position: fixed; left: 50%; top: 0%; height: 30%" id="student">
    <iframe name="student_frame" frameBorder="0" width="100%" height="100%" id="student_frame">
        <?php echo _("У вас старый браузер"); ?>
    </iframe>
</div>

<div style="width:50%; position: fixed; left: 50%; top: 30%; height: 10%">
    <center>
        <div class="span3">

            <input id="password" type="password" name="password" data-transform='input-control' maxlength="6" required>

        </div>
    </center>
</div>

<div style="width:50%; position: fixed; left: 50%; top: 60%; height: 30%" id="tips">
    12
</div>

<script>
    DataTable = $(".sortable2").DataTable({
        "bPaginate": false,
        "bFilter": false
    });
    set_student(student);
</script>

<?php
require_once('../../../stuff/footer.php');
?>
