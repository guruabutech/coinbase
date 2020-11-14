

	

			<?php
				if(isset($_SESSION['message'])){
					?>
					<div class="alert alert-info text-center">
						<?php echo $_SESSION['message']; ?>
					</div>
					<?php

					unset($_SESSION['message']);
				}
			?>
			<form method="POST" action="phpmailer/send.php" enctype="multipart/form-data">
				<div class="control-group">
              <label class="control-label">Email:*</label>
              <div class="controls">
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="control-group">
              <label class="control-label">Subject:*</label>
              <div class="controls">
              <input type="text" class="form-control" name="subject" required>
              </div>
              <div class="control-group">
              <label class="control-label">Message:*</label>
              <div class="controls">
              <textarea class="form-control" name="message" rows="5" required></textarea>
              </div>
              <div class="control-group">
              <label class="control-label">Add Attachment:</label>
              <div class="controls">
              <input type="file" name="attachment" class="form-control">
              </div>
              <div class="control-group">
              <label class="control-label"></label>
              <div class="controls">
              
				<button type="submit" name="send" class="btn btn-primary">Send</button>
              </div>
				
				

				
			</form>
	

