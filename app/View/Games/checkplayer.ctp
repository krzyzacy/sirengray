<?php
	$data = $game['Game']['player2'];

	if (!empty($data)) {
		$result = json_encode($data);
	} else {
		// add crash safe object here
		$result = "";
	}
	header('Content-type: text/plain');
	echo json_encode($data);

?>