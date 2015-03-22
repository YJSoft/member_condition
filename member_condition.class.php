<?php
/* Copyright (C) Kim, MinSoo <misol.kr@gmail.com> */
/**
 * @class  member_condition
 * @author MinSoo Kim (misol.kr@gmail.com)
 * high class of the member_condition module
 */
class member_condition extends ModuleObject
{
	/**
	 * constructor
	 *
	 * @return void
	 */
	function member()
	{
		if(!Context::isInstalled()) return;

	}

	/**
	 * Implement if additional tasks are necessary when installing
	 *
	 * @return Object
	 */
	function moduleInstall()
	{
		$oModuleController = getController('module');

		$oModuleController->insertTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');
		$oModuleController->insertTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');

		$oModuleController->insertTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before');
	}

	/**
	 * a method to check if successfully installed
	 *
	 * @return boolean
	 */
	function checkUpdate()
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');

		if(!$oModuleModel->getTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before')) return TRUE;

		if(!$oModuleModel->getTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before')) return TRUE;

		if(!$oModuleModel->getTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before')) return TRUE;
	}

	/**
	 * Execute update
	 *
	 * @return Object
	 */
	function moduleUpdate()
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');

		if(!$oModuleModel->getTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before'))
			$oModuleController->insertTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');

		if(!$oModuleModel->getTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before'))
			$oModuleController->insertTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');

		if(!$oModuleModel->getTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before'))
			$oModuleController->insertTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before');
	}

	/**
	 * Re-generate the cache file
	 *
	 * @return void
	 */
	function recompileCache()
	{
	}
}
/* End of file member_condition.class.php */
/* Location: ./modules/member_condition/member_condition.class.php */