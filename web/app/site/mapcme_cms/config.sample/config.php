<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * 일반설정
 */

{ // BLOCK:normar_config:20121202:기본 환경설정

	/**
	 * 기본 설정
	 */
	date_default_timezone_set('Asia/Seoul');	// 기본시간대
	error_reporting(0);	// 에러출력

	$CONFIG = array();

	$CONFIG['encode']	= 'utf-8';	// 기본 인코딩, default encoding
	$CONFIG['utc']		= date('P'); // UTC 시차 (+09:00 형태)
	$CONFIG['email']	= '';       // 관리자 이메일
	$CONFIG['layout']	= 'basic';	// 기본 레이아웃
	$CONFIG['lang']	= 'kor';

	$CONFIG['root_url']	= '/wygoing/mapc.me.cms/web/app/';	// 웹에서 접근할 때의 ROOT 주소

} // BLOCK

{ // BLOCK:args:20141219:사용자의 넘김값(argument)에 의해 바뀔 수 있는 값

	$temp['args'] = explode("/", str_replace($CONFIG['root_url'], '', ltrim($_SERVER['PATH_INFO'])));	// argument들이 arg1/arg2/arg3 처럼 값이 넘어옴

	$temp['modl'] = $temp['args'][0];
	$temp['page'] = $temp['args'][1];

	$count_args = (count($temp['args']));

	// mod_rewrite로 /foo1/var1/foo2/var2/foo3/var3 과 같은 형태로 넘어온 값을 $ARGS['foo1'] = 'var1'; 형태로 변경
	for($i=2; $i < $count_args; $i += 2) {

		$ARGS[$temp['args'][$i]] = $temp['args'][$i+1];

	}

    $CONFIG['admin']    = !empty($temp['admn']) ? $temp['admn'] : '';    // default admin module
    $CONFIG['module']   = !empty($temp['modl']) ? $temp['modl'] : 'home';    // default module
    $CONFIG['module']   = !empty($temp['admn']) ? $temp['admn'] : $CONFIG['module'];    // default admin값이 있을 경우 $CONFIG['module']은 admin값을 따름
    $CONFIG['page']     = !empty($temp['page']) ? $temp['page'] : 'dashboard';    // default page
    $CONFIG['locale']     = !empty($temp['locale']) ? $temp['locale'] : 'ko_KR';  // 기본언어
    $CONFIG['show']     = !empty($temp['show']) ? $temp['show'] : 'html'; // 기본화면출력 : html, html_emb(embed형식), html_cont(head,body태그 빼고 내용만 출력), xml, docbook, json
	unset($temp);

} // BLOCK

{ // BLOCK:meta:20141219:메타데이터

	/**
	 * 메타데이터 설정
	 */

	// 사이트 제목 지정
	$CONFIG['meta']['title'] = _('사이트 제목');
	// 저작권자 지정
	$CONFIG['meta']['copyright'] = _('[YOURSITEDOMAIN].com');
	// 키워드 지정
	$CONFIG['meta']['keywords'] = _('MAPC', '사이트 키워드1, 사이트 키워드2');
	// 사이트 주제(문장)
	$CONFIG['meta']['subject'] = _('사이트 주제1');
	// 사이트 설명
	$CONFIG['meta']['description'] = _('사이트 설명');
	// 권한자
	$CONFIG['meta']['author'] = _('권한자');
	// 작성자
	$CONFIG['meta']['writer'] = _('글쓴이');
	// 웹로봇 설정
	$CONFIG['meta']['robots'] = 'all';
	// 기본 언어
	$CONFIG['meta']['content-language'] = 'ko';

} // BLOCK


/**
 *
 * 보안관련 설정
 * 
 */
 
{ // BLOCK:secret_config:20130104:템플릿으로 출력되기 직전 삭제할 환경설정

	$CONFIG_SECRET['pass_key']	= 'a5Fk597a'; // 새로운 사이트에서는 반드시 새로운 값으로 변경하세요!!! // #TODO 처음 설치할 때 변경할 수 있도록!!!!!!!!!!!!!
    $CONFIG_SECRET['session']['use_trans_sid'] = 0; // PHPSESSID를 자동으로 넘기지 않음
    $CONFIG_SECRET['session']['cache_expire'] = 120; // 세션 캐쉬 보관시간 (분)
    $CONFIG_SECRET['session']['gc_maxlifetime'] = 10800; // session data의 garbage collection 존재 기간을 지정 (초)
    $CONFIG_SECRET['session']['gc_probability'] = 1; // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
    $CONFIG_SECRET['session']['gc_divisor'] = 100; 	// session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.
    $CONFIG_SECRET['session']['cookie_domain'] = '';
	$CONFIG_SECRET['session']['save_session_path'] = TEMP_PATH . 'sess/';

} // BLOCK


/**
 * URL & PATH
 *
 * 시스템상의 접근경로 설정
 * 시스템 운영에 꼭 필요한 디렉토리는 상수로 설정
 * 그밖의 부수적인 디렉토리는 변수로 설정...
 * PATH : for System
 * URL  : for web access
 */

{ // BLOCK:path_config:20121202:.....

	$PATH = array();
	$PATH['core']['skin']	= SITE_PATH . 'view/';
	$PATH['core']['log']	= TEMP_PATH . 'log/';	// 로그 저장용 (시스템 사용에 관한 기록들)

	$URL = array();
	// ROOT (상대주소를 사용할 경우에는 빈칸 또는 ./, 절대 주소를 사용할때는 웹상의URL을 적는다)
// #TODO 아래와 같은 형태로 서버환경이 바뀌거나 프로그램 디렉토리를 옮기더라도 config에서 $URL['core']['root'] 를 수정할 필요없게끔... (rewrite 모듈을 사용하면 아래처럼 사용하는게 안먹힘)
//	$URL['core']['root'] = eregi_replace("\/[^/]*\.php$", "/", $_SERVER['PHP_SELF']);
	$URL['core']['root'] = $CONFIG['root_url'];

	// 기본페이지 (기본페이지?변수1=값1&변수2=값2 와 같은 형태로 호출됨)
	$URL['core']['main'] = $URL['core']['root'];
	$URL['core']['site'] = $URL['core']['root'] . 'site/' . SITE_CODE . '/';
	$URL['core']['skin'] = $URL['core']['site'] . 'view/';

} // BLOCK


/**
 * Declare Debug mode
 *
 * Change debug mode, if connect in localhost.
 */
{ // BLOCK:declare_is_debug:20121228

	if($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1' || $is_debug == true) {

		$is_debug = true;
		error_reporting(E_ALL ^ E_NOTICE);

	} else {

		$is_debug = false;
		error_reporting(0);

	}

} // BLOCK

// end of file
