

It's working!

<br />

<a href="index.php/posts/index">Blog Tutorial</a>

<br />
<a href="index.php/games/index">Game Center</a>



<div class="image_frame" id="black_1">
<?php echo $this->Html->image('cat_1_1.png');?>
</div>

<div class="image_frame" id="black_2">
<?php echo $this->Html->image('cat_1_2.png');?>
</div>

<script type="text/javascript">

	
	$(document).ready(function(){
		frame = 0;
		setInterval(toggle_img, 800);
	});
	
	function toggle_img(){
		frame = (frame + 1) % 2;
		
		if(frame == 0){
			$("#black_1").hide();
			$("#black_2").show();
		}
		else{
			$("#black_2").hide();
			$("#black_1").show();
		}
	}
	
	
</script>