<?php include 'header.php';?>
		<div class="row">
			<?php
			$handle = fopen("feeds.txt", "r");
			if ($handle) {
				while (($line = fgets($handle)) !== false) {
				$feedline = preg_replace('/[\r\n]+/','', $line);
				$line = explode(",",$feedline);
				//$path = "feeds/" . $line[0] . ".xml";
				
				//$xml = file_get_contents($line[1]);
				//file_put_contents($path, $xml);
				// process the line read.
				?>
				<div class="col-md-3">
					<div class="card vulncard divider-outside-bottom">
						<div class="card-block">
							<h5 class="card-title vulntitlesub">
								<?php echo $line[0] ;?> 
							</h5>
							<p class="card-text">
							<?php
								$rss = new DOMDocument();
								$rss->load($line[1]);
								//$rss->load($path);
								$feed = array();
								foreach ($rss->getElementsByTagName('item') as $node) {
									$titleNode = $node->getElementsByTagName('title')->item(0);
									$descNode = $node->getElementsByTagName('description')->item(0);
									$linkNode = $node->getElementsByTagName('link')->item(0);
									$dateNode = $node->getElementsByTagName('pubDate')->item(0);
								
									$item = array(
										'title' => $titleNode ? $titleNode->nodeValue : '',
										'desc' => $descNode ? $descNode->nodeValue : '',
										'link' => $linkNode ? $linkNode->nodeValue : '',
										'date' => $dateNode ? $dateNode->nodeValue : '',
									);
								
									array_push($feed, $item);
								}
								$limit = 5;
								for($x=0;$x<$limit;$x++) {
									$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
									$link = $feed[$x]['link'];
									$description = $feed[$x]['desc'];
									$dateString = $feed[$x]['date'];
									$date = new DateTime($dateString);
									$today = new DateTime();

									// Calculate the difference
									$dc = $today->diff($date);
									//echo "Difference: " . $dc->days . " days";
									// Format the date
									$fDate = $date->format('d-m-Y'); // Change the format as needed
									$ftoday = $today->format('d-m-Y'); // Change the format as needed

									if( $dc->days >= -4 and $dc->days <= 0 ) {
										echo '<div class="newalert"><strong><a href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a></strong><br />';
										echo '<small><em>Posted on '.$date->format('d-m-Y').'</em></small></div>';
									} else {
										echo '<div class="normalert"><strong><a href="'.$link.'" title="'.$title.'"  target="_blank">'.$title.'</a></strong><br />';
										echo '<small><em>Posted on '.$date->format('d-m-Y').'</em></small></div>';
									}
								}
							?>
							</p>
						</div>
					</div>
					<br/>
				</div>
				
				<?php
				}

				fclose($handle);
				} else {
					// error opening the file.
				} 
				?>
				
				
			</div>
		</div>
	</div>
	
				
				
				
			</div>
		</div>
	</div>
</div>
<br/><br/>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>