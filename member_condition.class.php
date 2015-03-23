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
	public function member_condition()
	{
		if(!Context::isInstalled()) return;

	}

	/**
	 * Implement if additional tasks are necessary when installing
	 *
	 * @return Object
	 */
	public function moduleInstall()
	{
		$oModuleController = getController('module');

		$oModuleController->insertTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');
		$oModuleController->insertTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');

		$oModuleController->insertTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before');
		$oModuleController->insertTrigger('moduleHandler.proc', 'member_condition', 'controller', 'triggerAfterModule', 'after');
	}

	/**
	 * a method to check if successfully installed
	 *
	 * @return boolean
	 */
	public function checkUpdate()
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');

		if(!$oModuleModel->getTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before')) return TRUE;

		if(!$oModuleModel->getTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before')) return TRUE;

		if(!$oModuleModel->getTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before')) return TRUE;
		if(!$oModuleModel->getTrigger('moduleHandler.proc', 'member_condition', 'controller', 'triggerAfterModule', 'after')) return TRUE;

	}

	/**
	 * Execute update
	 *
	 * @return Object
	 */
	public function moduleUpdate()
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');

		if(!$oModuleModel->getTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before'))
			$oModuleController->insertTrigger('member.insertMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');

		if(!$oModuleModel->getTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before'))
			$oModuleController->insertTrigger('member.updateMember', 'member_condition', 'controller', 'triggerInsertMember', 'before');

		if(!$oModuleModel->getTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before'))
			$oModuleController->insertTrigger('moduleHandler.init', 'member_condition', 'controller', 'triggerInitUpdateEmail', 'before');

		if(!$oModuleModel->getTrigger('moduleHandler.proc', 'member_condition', 'controller', 'triggerAfterModule', 'after'))
			$oModuleController->insertTrigger('moduleHandler.proc', 'member_condition', 'controller', 'triggerAfterModule', 'after');

	}

	/**
	 * Re-generate the cache file
	 *
	 * @return void
	 */
	public function recompileCache()
	{
	}
}
/* End of file member_condition.class.php */
/* Location: ./modules/member_condition/member_condition.class.php */