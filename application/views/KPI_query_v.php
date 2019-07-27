<?php ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>

    </head>

    <body>
        <form method="post" action="<?php echo base_url(); ?>index.php/KPI_query_c/addImprovement">
            <!--<input type="textarea" name="query" >-->
            <textarea rows="4" cols="50" name="query"></textarea>
            <input type="submit">
        </form>
    </body>
</html>