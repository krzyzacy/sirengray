<div id="game_wrapper">

	<?php echo "<script> var game_id = ";
		  echo $game['Game']['id'] . ';';
		  if($_SERVER['REMOTE_ADDR'] == $game['Game']['player1']){ 
		  	echo "var player_index = 1;";
		  }
		  else {
		  	echo "var player_index = 2;";
		  }
		  echo "</script>";
	
	?>
	
	<div id="game_info">
        <div id="game_room">
            You are in room: <?php echo $game['Game']['roomtitle']; ?>
        </div>
        
		<div id="game_player1" class="game_player">
			Player1: <?php echo $game['Game']['player1']; ?>
		</div>
		
		<div id="game_player2" class="game_player">
			<?php 
				if ($game['Game']['player2']){
					echo "Player2:";
					echo $game['Game']['player2'];
				} 
				else{
					echo "Waiting for another player";
				}
			?>
		</div>
		
	</div>

	<div id="game_board">
	<h1>tic tac toe</h1>
    <div id="turn"> Turn 1 </div>
	<table>
		<tr>
			<td><div id="game_cell_0_0" class="game_cell"></div></td>
			<td><div id="game_cell_0_1" class="game_cell"></div> </td>
			<td><div id="game_cell_0_2" class="game_cell"></div> </td>
		</tr>
		<tr>
			<td><div id="game_cell_1_0" class="game_cell"></div></td>
			<td><div id="game_cell_1_1" class="game_cell"></div></td>
			<td><div id="game_cell_1_2" class="game_cell"></div></td>
		</tr>
		<tr>
			<td><div id="game_cell_2_0" class="game_cell"></div></td>
			<td><div id="game_cell_2_1" class="game_cell"></div></td>
			<td><div id="game_cell_2_2" class="game_cell"></div></td>
		</tr>
	</table>
	</div>
</div>
<style type="text/css">
	#game_wrapper{
		margin-bottom:200px;
	}
	
	#game_board{
		margin-top:50px;
		text-align:center;
		width:400px;
		margin-left:auto;
		margin-right:auto;
	}
	
	.game_cell{
		width:130px;
		height:130px;
	}
	
	tr{
		margin-right: -30px;
		margin-bottom: -10px;
	}
	
	td{
		margin-right: -1px;		
		margin-bottom: -1px;
		width: 130px;
		height: 130px;
		border: 1px solid red;
	}
	
	.game_player{
		margin-top:20px;
		margin-bottom:20px;
		margin-left:10px;
		margin-right:10px;
		float:left;
		width:200px;
		height:150px;
		border: 1px solid green;
		border-radius: 3px;	
	}
	
	#game_player2{
		float:right;	
	}
	
	#game_info{
		margin-top:10px;
		float:left;
		width:100%;
		margin-left:auto;
		margin-right:auto;
		border: 1px solid green;
		border-radius: 3px;		
	}
	
	#game_room{
		font-size:18px;
	}
</style>

<script type="text/javascript">
	var turn = 1;
	var last_move = -1;
	var opponent_index = player_index % 2 + 1;
	var occupied = [[0,0,0],[0,0,0],[0,0,0]];
	var ready = false;
	var check_player_timer;
	var update_timer;
	var ready = false;
	
	$().ready(function(){
		$("#game_player" + player_index).css('border','3px solid red');
		
		if(player_index == 1){
			check_player_timer = setInterval(function(){check_player2(game_id);}, 1000);	
		}
		else{
			ready = true;
			update_timer = setInterval(function(){check_update(game_id);}, 1000);
		}
	});

	$(".game_cell").hover(
	  function () {
		$(this).css('background-color','gray');
		$(this).css('opacity','0.2');
	  },
	  function () {
		$(this).css('background-color','white');
		$(this).css('opacity','1.0');
	  });
	  
	$(".game_cell").click(
		function() {
			if((turn % 2 == (player_index % 2)) && ready){
				$(this).append('<img src="/app/webroot/img/cat_' + player_index + '_1.png">');
				$(this).css('background-color','white');
				$(this).css('opacity','1.0');
				$(this).unbind('click');
				last_move = Number(this.id[10] * 3) + Number(this.id[12]);
				//alert(last_move);
				occupied[this.id[10]][this.id[12]] = player_index;
				if(!check_winning(this.id[10], this.id[12])){
					update_player_movement(turn, last_move, game_id);
					turn++;
					update_timer = setInterval(function(){check_update(game_id);}, 1000);				
				}
				else{
					$('#turn').html('Player ' + player_index + " Won");
					$(".game_cell").unbind('click');	
				}
			}
		});
		
	function update_player_movement(turn, lastmove, id){
		$.post('../update', {'turn':turn, 'lastmove':lastmove, 'id':id}, function(data){
			
		},'json');
	}
	
	function check_winning(row, col){
		// see if next two blocks are occupied with same player_index
		if((occupied[row][(col + 1) % 3] == player_index) && (occupied[row][(col + 2) % 3] == player_index))
			return true;
				
		if((occupied[(row + 1) % 3][col] == player_index) && (occupied[(row + 2) % 3][col] == player_index))
			return true;
				
		if((occupied[(row + 1) % 3][(col + 1) % 3] == player_index) && (occupied[(row + 2) % 3][(col + 2) % 3] == player_index) && (row == col))
			return true;
			
		return false;
	}	
	
	function check_player2(id){
		$.post('../checkplayer',{'id':id},function(data){
			console.log(data);
			if(data != '"0"'){
				$('#game_player2').html("Player2" + data);
				ready = true;
				clearInterval(check_player_timer);	
			}
		});
	}
	
	function check_update(id){
		$('#turn').html('Turn ' + turn + ' , Wait for your opponent');
		
		$.post('../checkupdate',{'id':id},function(data){
			console.log(data);
			if(Number(data[1]) + 1 != turn){
				clearInterval(update_timer);
				turn++;
				$('#turn').html('Turn ' + turn + ' , Your turn');
				
				var row = Math.floor(Number(data[3]) / 3);
				var col = Number(data[3]) % 3;
				console.log("data3: " + Number(data[3]));
				console.log("row: " + row + " && col: " + col);
				
				$('#game_cell_' + row + '_' + col).append('<img src="/app/webroot/img/cat_' + opponent_index + '_1.png">');
				$('#game_cell_' + row + '_' + col).css('background-color','white');
				$('#game_cell_' + row + '_' + col).css('opacity','1.0');
				$('#game_cell_' + row + '_' + col).unbind('click');
				occupied[row][col] = opponent_index;
				
			}
		});
	}
	  
</script>