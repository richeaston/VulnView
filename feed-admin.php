<?php include 'header.php';?>
			<?php
                $file = "feeds.txt";
				function Write() {
                   $file = "feeds.txt";
                   $fp = fopen($file, "w");
                   $data = $_POST["tekst"];
                   fwrite($fp, $data);
                   fclose($fp);
               }
        ?>

        <?php
        if ($_POST["submit_check"]){
            Write();
        };
        ?>      
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        	<div class="row">
				<div class="col-md-5">
					<form role="form">
						<div class="form-group">
							<textarea class="form-control feedlist" id="feedarea" rows="20" name="tekst"><?php echo file_get_contents( $file); ?></textarea>
						</div> 
					
		<button class="btn btn-danger" type="submit" name="submit" value="Commit Changes"><i class='ion-alert'></i> Commit Changes</button>
        <input type="hidden" name="submit_check" value="1">
        </form>

                <?php
        if ($_POST["submit_check"]){
		?>
		<br/>
		<br/>
		<div class="alert alert-success" role="alert">
			<strong>Well done!</strong> You successfully updated the feeds</br>Please refresh the main page.
		</div>
		<?php
		};
        ?>      
				</div>
				<div class="col-md-5">
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>