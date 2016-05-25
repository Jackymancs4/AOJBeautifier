<?php

include 'class/beautifier-class.php';

if (isset($_POST['json'])) {
    $code = strip_tags($_POST['json']);
    $j = indent(stripslashes($code));
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AOJBeautifier</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="js/index.js"></script>
</head>
<body>

    <div id="wrapper">

        <h1>AOJBeautifier</h1>

        <form id="form1" name="form1" method="post" action="">
            <label>&nbsp;Ugly thing:
                <br />
                <textarea id="rawjson" name="json" cols="100" rows="5"></textarea>
            </label>
            <br />
            <!--label>&nbsp;URL: <input id="urljson" name="urljson" type="text" size="81" /></label><br /-->
            <br />
            <div id="buttons">
                <input type="submit" name="submit" value="Indent" />
                <?php if (isset($j)): ?>
                <input type="button" onclick="javascript:selectText('indented')" value="Copy" />
                <?php endif; ?>
            </div>
        </form>
        <?php if (isset($j)): ?>
        <pre id="indented"><?php echo $j; ?></pre>
        <?php endif; ?>
    </div>

</body>

</html>
