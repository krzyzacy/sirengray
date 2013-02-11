<!-- File: /app/View/Posts/index.ctp -->

<div id = "postview">

<h1>Game Lobby</h1>
<p><?php echo $this->Html->link('Create Game', array('action' => 'create')); ?></p>
<table>
    <tr>
        <th>Game Name</th>
        <th>Player1</th>
        <th>Player2</th>
        <th>Status</th>
    </tr>

<!-- Here's where we loop through our $games array, printing out post info -->

    <?php foreach ($games as $game): ?>
    <tr>
        <td>
			<?php echo $game['Game']['roomtitle']; ?>
		</td>
        <td>
            <?php echo $game['Game']['player1']; ?>
        </td>
		<td>
			<?php 
				if($game['Game']['player2']){
					echo $game['Game']['player2'];
				}
				else{
					echo $this->Html->link('Join', array('action' => 'Join', $game['Game']['id']));
				}
			?>
            
        </td>
        <td>
            <?php 
				if($game['Game']['winner']){
					echo "Winner is Player";
					echo $game['Game']['winner'];
				}
			?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</div>