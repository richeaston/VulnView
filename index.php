<?php include 'header.php'; ?>
<div class="row">
    <?php
    $handle = fopen("feeds.txt", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $feedline = preg_replace('/[\r\n]+/', '', $line);
            $line = explode(",", $feedline);
            $path = "feeds/" . $line[0] . ".xml";
            // Get the last modified time of the file
            $last_modified = @filemtime($path);

            // Convert the Unix timestamp to a human-readable format
            $last_modified_formatted = date('d-m-Y H:i:s', $last_modified);

            // process the line read.
            ?>
            <div class="col-md-4">
                <div class="card vulncard divider-outside-bottom">
                    <div class="card-block">
                        <h5 class="card-title vulntitlesub">
                            <?php echo $line[0]; ?><small> - Last updated: <?php echo $last_modified_formatted; ?></small>
                        </h5>
                        <p class="card-text">
                            <?php
                            $rss = new DOMDocument();
                            if (@$rss->load($path)) {
                                $feed = array();

                                foreach ($rss->getElementsByTagName('item') as $node) {
                                    $item = array(
                                        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                                        'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                                        'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                                        'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                                    );
                                    array_push($feed, $item);
                                }
                                $limit = min(5, count($feed));
                                for ($x = 0; $x < $limit; $x++) {
                                    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
                                    $link = $feed[$x]['link'];
                                    $description = $feed[$x]['desc'];
                                    date_default_timezone_set('Europe/London');
                                    $threedaysago = date_create('3 days ago');

                                    // Set the old article date
                                    $article_date = $feed[$x]['date'];

                                    // Get the current date
                                    $current_date = date('d-m-Y');

                                    // Calculate the difference between the two dates
                                    $diff = strtotime($current_date) - strtotime($article_date);

                                    // Convert the difference to days
                                    $days = floor($diff / (60 * 60 * 24));
                                    //echo $days;

                                    if ($days < 3) {
                                        echo '<div class="newalert"><strong><a href="' . $link . '" title="' . $title . '" target="_blank">' . $title . '</a></strong><br />';
                                        if ($days <= 0) {
                                            echo '<small><em>Posted on ' . date('d-m-Y', strtotime($feed[$x]['date'])) .  '</em></small></div>';
                                        } elseif ($days > 1) {
                                            echo '<small><em>Posted on ' . date('d-m-Y', strtotime($feed[$x]['date'])) .  ' - ' . $days . ' days ago.</em></small></div>';
                                        } else {
                                            echo '<small><em>Posted on ' . date('d-m-Y', strtotime($feed[$x]['date'])) .  ' - ' . $days . ' day ago.</em></small></div>';
                                        }
                                    } else {
                                        echo '<div class="normalert fade-in"><strong><a href="' . $link . '" title="' . $title . '"  target="_blank">' . $title . '</a></strong><br />';
                                        if ($days <= 0) {
                                            echo '<small><em>Posted on ' . date('d-m-Y', strtotime($feed[$x]['date'])) .  '</em></small></div>';
                                        } elseif ($days > 1) {
                                            echo '<small><em>Posted on ' . date('d-m-Y', strtotime($feed[$x]['date'])) .  ' - ' . $days . ' days ago.</em></small></div>';
                                        } else {
                                            echo '<small><em>Posted on ' . date('d-m-Y', strtotime($feed[$x]['date'])) .  ' - ' . $days . ' day ago.</em></small></div>';
                                        }
                                    }
                                }
                            } else {
                                echo "Error processing XML file: $path";
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <br />
            </div>

    <?php
        }

        fclose($handle);
    } else {
        // error opening the file.
        echo "Error opening feeds.txt";
    }
    ?>


</div>
</div>
</div>
</div>
<br /><br />

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>

</html>
