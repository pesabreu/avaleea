

<!-- v_standard_message.php -->


	<div class="alert <?php echo $type_message; ?>">
	    <?php echo $message; ?>
	</div>

	<p>    
        <?php        
            foreach($links as $link) {
                echo $link . "  &nbsp; &nbsp;";
            }        
        ?>    
	</p>