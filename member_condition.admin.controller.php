<?php
/* Copyright (C) Kim, MinSoo <misol.kr@gmail.com> */
/**
 * @file	member_condition.admin.controller.php
 * @author	MinSoo Kim (misol.kr@gmail.com)
 * @brief	admin controller class of the member_condition module
 */
class member_conditionAdminController extends member_condition
{
	/**
	 * Initialization
	 * @return void
	 */
	public function init()
	{
	}

	/**
	 * @brief 회원 가입 조건 모듈 설정
	 * @author MinSoo Kim (misol.kr@gmail.com)
	 * @param string $allow_email_list 이메일 주소의 목록이다. 각 항목은 쉼표(,)로 구분되어야 한다.
	 */
	public function procMember_conditionAdminConfig()
	{
		$oModuleController = getController('module');
		$config = new stdClass();

		$config->allow_email_list = trim(Context::get('allow_email_list'));
		$config->allow_admin = trim(Context::get('allow_admin'));
		if( !in_array($config->allow_admin , array('otl','utl'), TRUE))
		{
			$config->allow_admin = 'utl';
		}

		$oModuleController->insertModuleConfig('member_condition', $config);
		$this->setRedirectUrl(Context::get('error_return_url'));
	}
}
/* End of file member_condition.admin.controller.php */
/* Location: ./modules/member_condition/member_condition.admin.controller.php */