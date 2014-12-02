<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>All Sites!</title>
        <style type="text/css">
            .tag_cloud { padding: 3px; text-decoration: none; }
            .tag_cloud:link  { color: #81d601; }
            .tag_cloud:visited { color: #019c05; }
            .tag_cloud:hover { color: #ffffff; background: #69da03; }
            .tag_cloud:active { color: #ffffff; background: #ACFC65; }
        </style>
        <link rel="stylesheet" type="text/css" href="view.css" media="all">
        <script type="text/javascript" src="view.js"></script>
    </head>
    <body>
        <?php
            function get_tag_data()
            {
                Require_once 'connect.php';
                include_once 'config.inc.php';
                // Set Query to SELECT 1 Columns from Table when Field 4 is set to true
                $result = mysql_query( "SELECT * FROM $DBTAB WHERE Enabled='1'" ) or die ( mysql_error() );
                // Build arrays
                while ( $row = mysql_fetch_array( $result ) ) {
                    $arr[$row['Name']] = $row['Count'];
                }
                ksort( $arr );
                return $arr;
            }
            function get_tag_cloud()
            {
                // Default font sizes
                $min_font_size = 14;
                $max_font_size       = 30;
                // Pull in name data
                $name = get_tag_data();
                // Get weights and spread tags
                $minimum_count = min( array_values( $name ) );
                $maximum_count        = max( array_values( $name ) );
                $spread               = $maximum_count - $minimum_count;

                if ( $spread == 0 ) {
                    $spread = 1;
                }
                $cloud_html                            = '';
                $cloud_tags                            = array(); // create an array to hold name code
                foreach ( $name as $name => $count ) {
                    $size                                                                  = $min_font_size + ( $count - $minimum_count ) * ( $max_font_size - $min_font_size ) / $spread;
                    $cloud_tags[]                                                          = '<a style="font-size: ' . floor( $size ) . 'px'
                    . '" class="tag_cloud" href="http://www.google.com/search?q=' . $name
                    . '" title="\'' . $name . '\' returned a count of ' . $count . '">'
                    . htmlspecialchars( stripslashes( $name ) ) . '</a>';
                }
                shuffle( $cloud_tags );
                $cloud_html         = join( "\n", $cloud_tags ) . "\n";
                return $cloud_html;
            }

        ?>
        <h3 style="color:white;">Sites included on out list!</h3>
        <div id="wrapper"
        <!-- BEGIN name Cloud -->
        <?php print get_tag_cloud(); ?>
        <!-- END name Cloud -->
        </div>
        <p style="text-align:centre; color:white;">Go back to the <a style="color:white;" href="<?php echo $HOST ?>index.php" title="Add a new site!" target="_self">home page?</a></p>
    </body>
</html>