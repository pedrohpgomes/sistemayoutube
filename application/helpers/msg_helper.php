<?php

function set_msg($msg,$tipo){
	if(isset($msg)){
		if($tipo =='erro'){
			msg_erro($msg);
		} else {
			if($tipo=='sucesso'){
				msg_sucesso($msg);
			} else {
				if($tipo== 'aviso'){
					msg_aviso($msg);
				}
			}
		}
	}
}

function msg_erro($msg){
	if(isset($msg)){
		echo "
			<div class='d-flex justify-content-center'>
	         	<div class='alert alert-danger alert-dismissible text-center'>
	                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	                <h3>".$msg."</h3>
	            </div>
	         </div>
		";
	}
}

function msg_sucesso($msg){
	if(isset($msg)){
		echo "
			<div class='d-flex justify-content-center'>
	         	<div class='alert alert-success alert-dismissible text-center'>
	                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	                <h3>".$msg."</h3>
	            </div>
	         </div>
		";
	}
}

function msg_aviso($msg){
	if(isset($msg)){
		echo "
			<div class='d-flex justify-content-center'>
	         	<div class='alert alert-warning alert-dismissible text-center'>
	                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	                <h3>".$msg."</h3>
	            </div>
	         </div>
		";
	}
}

