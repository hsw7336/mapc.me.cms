<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 회원가입
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 파일 첨부

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

	{ // BLOCK:echo_view:20130923:화면출력

		$publish_message = '모듈'; 
		$section_file    = $PATH_ADMIN['admin']['root'] . 'view/basic/module.view.php';
		include_once(PROC_PATH . 'publish.proc.php');

	}

} // View : Tail

// end of file
