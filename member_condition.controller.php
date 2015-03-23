<?php
/* Copyright (C) Kim, MinSoo <misol.kr@gmail.com> */
/**
 * @class  member_conditionController
 * @author MinSoo Kim (misol.kr@gmail.com)
 * @brief controller class of the member_condition module
 */
class member_conditionController extends member_condition
{
	/**
	 * @brief Initialization
	 */
	public function init()
	{
	}

	/**
	 * @brief member_condition module trigger in Member module
	 */
	public function triggerInsertMember(&$obj)
	{
		// 설정 가져오기
		$oMember_conditionModel = getModel('member_condition');
		$member_condition_config = $oMember_conditionModel->getMember_conditionConfig();

		if($member_condition_config->allow_email_list)
		{
			$email_provider = '';
			list($email_id, $email_provider) = explode('@', $obj->email_address);
			if(!$email_provider) return;

			$allow_email_list_array = explode(',',$member_condition_config->allow_email_list);
			$blocked = TRUE;
			foreach($allow_email_list_array as $key => $val)
			{
				if(!$val) continue;
				if($val === $email_provider)
				{
					$blocked = FALSE;
				}
			}
			if($blocked === TRUE)
			{
				$description_text = sprintf(Context::getLang('member_condition_allow_email_list_blocked'),$member_condition_config->allow_email_list);
				return $this->stop($description_text);
			}
		}
		return new Object();
	}

	/**
	 * @brief member_condition module trigger in Member module
	 */
	public function triggerInitUpdateEmail($obj)
	{
		if($obj->act === 'procMemberModifyEmailAddress')
		{
			// 설정 가져오기
			$oMember_conditionModel = getModel('member_condition');
			$member_condition_config = $oMember_conditionModel->getMember_conditionConfig();

			if(!Context::get('is_logged')) return $this->stop('msg_not_logged');

			$member_info = Context::get('logged_info');
			$newEmail = Context::get('email_address');

			if($member_condition_config->allow_email_list)
			{
				$email_provider = '';
				list($email_id, $email_provider) = explode('@', $newEmail);
				if(!$email_provider) return;

				$allow_email_list_array = explode(',',$member_condition_config->allow_email_list);
				$blocked = TRUE;
				foreach($allow_email_list_array as $key => $val)
				{
					if(!$val) continue;
					if($val === $email_provider)
					{
						$blocked = FALSE;
					}
				}
				if($blocked === TRUE)
				{
					$description_text = sprintf(Context::getLang('member_condition_allow_email_list_blocked'),$member_condition_config->allow_email_list);

					htmlHeader();
					echo $description_text;
					htmlFooter();
					Context::close();
					exit;
				}
			}
			return;

		}
	}

	public function triggerAfterModule($oModule)
	{
		if(Context::get('act') === 'procMemberCheckValue' && Context::get('value'))
		{
			$name = Context::get('name'); 
			$value = Context::get('value'); 

			if($name === 'email_address')
			{
				// 설정 가져오기
				$oMember_conditionModel = getModel('member_condition');
				$member_condition_config = $oMember_conditionModel->getMember_conditionConfig();

				if($member_condition_config->allow_email_list)
				{
					$email_provider = '';
					list($email_id, $email_provider) = explode('@', $value);
					if(!$email_provider) return;

					$allow_email_list_array = explode(',',$member_condition_config->allow_email_list);
					$blocked = TRUE;
					foreach($allow_email_list_array as $key => $val)
					{
						if(!$val) continue;
						if($val === $email_provider)
						{
							$blocked = FALSE;
						}
					}
					if($blocked === TRUE)
					{
						$description_text = sprintf(Context::getLang('member_condition_allow_email_list_blocked'),$member_condition_config->allow_email_list);
						$oModule->setError(0); 
						$oModule->setMessage($description_text);
						return $oModule;
					}
				}
				return;
			}
		}
	}
}
/* End of file member_condition.controller.php */
/* Location: ./modules/member_condition/member_condition.controller.php */