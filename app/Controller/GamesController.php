<?php

class GamesController extends AppController {
    public $helpers = array('Html', 'Form');
	var $components = array('Session','RequestHandler');
	var $name       = 'Games';

    public function index() {
        $this->set('games', $this->Game->find('all', array(
							'order' => array('Game.id' => 'desc')
						)));
    }
	
	public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid game'));
        }

        $game = $this->Game->findById($id);
        if (!$game) {
            throw new NotFoundException(__('Invalid game'));
        }
        $this->set('game', $game);
    }
	
	public function play($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid game'));
        }

        $game = $this->Game->findById($id);
        if (!$game) {
            throw new NotFoundException(__('Invalid game'));
        }
        $this->set('game', $game);
    }
	
	public function play1($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid game'));
        }

        $game = $this->Game->findById($id);
        if (!$game) {
            throw new NotFoundException(__('Invalid game'));
        }
        $this->set('game', $game);
    }
	
	public function create(){
        if ($this->request->is('post')) {
            $this->Game->create();
			
			$this->request->data['Game']['player1'] = $_SERVER['REMOTE_ADDR'];
			$this->request->data['Game']['player2'] = 0;
			
			$this->request->data['Game']['turn'] = 0;
			$this->request->data['Game']['lastmove'] = -1;
			
			$this->request->data['Game']['winner'] = 0;
	
            if ($this->Game->save($this->request->data)) {
                $this->Session->setFlash('Your game has been saved.');
				$game = $this->Game->find('first', array(
							'order' => array('Game.id' => 'desc')
						));
				$id = $game['Game']['id'];
                $this->redirect(array('action' => 'play', $id));
            } else {
				print_r($this->Game);
                $this->Session->setFlash($this->Game->data);
            }
        }
    }
	
	public function update(){
		CakeLog::write('debug', 'Received');
		
		$this->layout = 'plain';
				
		if (empty($this->params)){
			CakeLog::write('debug', 'Param Empty');
			return; 
		}
		
		$id       = $_POST['id'];
		$turn 	  = $_POST['turn'];
		$lastmove = $_POST['lastmove'];	
		
		CakeLog::write('debug', 'game id => ' . $id . ", turn => " . $turn);
		
		$game = $this->Game->findById($id);
		
		$game['Game']['turn'] = $turn;
		$game['Game']['lastmove'] = $lastmove;
		
		if($this->Game->save($game)){
			CakeLog::write('debug', 'Save success');	
		}
		else{
			CakeLog::write('debug', 'Save failed');	
		}
		
	}
	
	public function join($id = null){
		
        $game = $this->Game->findById($id);
		
		$game['Game']['player2'] = $_SERVER['REMOTE_ADDR'];
		
		$this->Game->save($game);
		
		$this->redirect(array('action' => 'play1', $id));
	}
	
	public function checkplayer(){
		$this->layout = 'plain';
		
		$id = $_POST['id'];	
		$game = $this->Game->findById($id);
		
		$this->set('game',$game);
	}
	
	public function checkupdate(){
		$this->layout = 'plain';
		
		$id = $_POST['id'];	
		$game = $this->Game->findById($id);
		
		$this->set('game',$game);
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
	
		if ($this->game->delete($id)) {
			$this->Session->setFlash('The game with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
}