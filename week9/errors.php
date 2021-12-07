<?php // this will by the errors page

// logically, if we have more than 0 errors, we need to display a message
// if end user didn't fill in the email input, the message will display - Email is required!
// array_push($errors, 'Email is required!')
// don't forget, we cannot echo an array - for each loop

if(count($errors) > 0) :?>
<div class="error">
<?php foreach($errors as $error) : ?>
<p><?php echo $error; ?></p>
<?php endforeach; ?>
</div>
<?php endif; ?>