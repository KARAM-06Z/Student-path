<?php 

class topics{
	public $topics = array();

	public function __construct($topics_ARR){
		$this->topics = $topics_ARR;
	}
}

class question{
	public $number;
	public $ID;
	public $question;
	public $answer_A;
	public $answer_B;
	public $answer_C;
	public $answer_D;
	public $correct;
	public $type;
	public $topic;
	
	public function __construct($number,$ID,$question,$answer_A,$answer_B,$answer_C,$answer_D,$correct,$type,$topic){
		$this->number=  $number;
		$this->ID=  $ID;
		$this->question=  $question;
		$this->answer_A=  $answer_A;
		$this->answer_B=  $answer_B;
		$this->answer_C=  $answer_C;
		$this->answer_D=  $answer_D;
		$this->correct=  $correct;
		$this->type=  $type;
		$this->topic=  $topic;
	}
}