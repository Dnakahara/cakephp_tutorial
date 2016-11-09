<?php
App::uses('AppController','Controller');

class ZipcodesController extends AppController{
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('search');
	}
	
	public function search(){
		if(!$this->request->is('post')){
			throw new MethodNotAllowedException();
		}
		$this->autoRender = false;
		if($this->request->data['Zipcode']['zipcode']){
			$result = $this->Zipcode->find('all',array(
				'conditions'=>array(
					'zipcode'=>$this->request->data['Zipcode']['zipcode'],
				),
			));
		}
		return json_encode($result);
	}
}
