<?php

trait CurrencyTrait{

	public function getCurrencyFormat($amount){
		return number_format($amount,2);
	}
}