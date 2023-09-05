<?php

function rendomnumber($arr){
	shuffle($arr);
	return end($arr);
}
?>