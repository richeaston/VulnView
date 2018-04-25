<?php include 'header.php';?>
		<div class="row">
			<?php
			$handle = fopen("feeds.txt", "r");
			if ($handle) {
				while (($line = fgets($handle)) !== false) {
				$feedline = preg_replace('/[\r\n]+/','', $line);
				$line = explode(",",$feedline);
				$path = "feeds/" . $line[0] . ".xml";
				
				$xml = file_get_contents($line[1]);
				file_put_contents($path, $xml);
				// process the line read.
				?>
				<div class="col-md-4">
					<div class="card vulncard divider-outside-bottom">
						<div class="card-block">
							<h5 class="card-title vulntitlesub">
								<?php echo $line[0] ;?> 
							</h5>
							<p class="card-text">
							<?php
								$rss = new DOMDocument();
								//$rss->load($line[1]);
								$rss->load($path);
								$feed = array();
								foreach ($rss->getElementsByTagName('item') as $node) {
									$item = array ( 
									'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
									'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
									'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
									'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
									);
									array_push($feed, $item);
								}
								$limit = 5;
								for($x=0;$x<$limit;$x++) {
									$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
									$link = $feed[$x]['link'];
									$description = $feed[$x]['desc'];
									$date = date('d-m-y', strtotime($feed[$x]['date']));
									$dc =  date('d-m-y', strtotime($feed[$x]['date'])) - date('d-m-y');
									#echo $dc;
									if( $dc >= -3 and $dc <= 0 ) {
										echo '<div class="newalert"><strong><a href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a></strong><br />';
										echo '<small><em>Posted on '.$date.'</em></small></div>';
									} else {
										echo '<div class="normalert"><strong><a href="'.$link.'" title="'.$title.'"  target="_blank">'.$title.'</a></strong><br />';
										echo '<small><em>Posted on '.$date.'</em></small></div>';
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