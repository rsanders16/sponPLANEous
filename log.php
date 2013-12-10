<!DOCTYPE html>
<html>
<head>
    <title>SqlFormatter Examples</title>
    <style>
        body {
            font-family: arial; font-size: 15px;
        }

        table, td, th {
            border: 1px solid #aaa; width: 100%;
        }

        table {
            border-width: 1px 1px 0 0;
            border-spacing: 0;
        }

        td, th {
            border-width: 0 0 1px 1px;
            padding: 5px 10px;
            vertical-align: top;
        }

        pre {
            padding: 0;
            margin: 0;
        }
    </style>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<div>
<div>

</body>

	<script>
	$('div').load('log_controller.php');
	setTimeout(function doSomething() {
		$('div').load('log_controller.php');
		setTimeout(doSomething, 500);
	}, 500);
	</script>
</html>
	