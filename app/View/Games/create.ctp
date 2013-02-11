<div id = "postview">

<h1>Create New Game</h1>
<?php
	echo $this->Form->create('Game');
	echo $this->Form->input('roomtitle');
	echo $this->Form->end('Create Game');
?>

</div>