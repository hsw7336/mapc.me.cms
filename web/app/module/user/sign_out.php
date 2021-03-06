<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 샘플페이지
 *
 * 아래의 형태에서 각 페이지 성격에 맞게 수정하시면 됩니다.
 */

require(INIT_PATH . 'init.db.php');
{ // Model : Head

	{ // BLOCK:module_include:20120912:필요한 파일 첨부

		// 로그아웃하기전에 출력이 필요할 경우 출력... 현재는 sign_out_act를 바로 호출
		session_destroy();

	} // BLOCK

} // Model : Tail

// ======================================================================

{ // View : Head

    $url     = $URL['core']['main'];
	$message = _('로그아웃 되었습니다.');
	$display_type = 'move';
    include PROC_PATH . 'publish_simple.proc.php';

} // View : Tail

// end of file
