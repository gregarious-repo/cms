<?php namespace Pongo\Cms\Controllers;

use Pongo\Cms\Support\Repositories\UserRepositoryInterface as User;

use HTML, Pongo, Theme, Tool, Render;

class UserController extends BaseController {

	/**
	 * Class constructor
	 * 
	 * @param Role    $role
	 */
	public function __construct(User $user)
	{
		parent::__construct();

		$this->beforeFilter('pongo.auth');

		$this->user	= $user;
	}

	/**
	 * Show user password page
	 * 
	 * @param  int $user_id
	 * @return string     view page
	 */
	public function passwordUser($user_id = null)
	{
		if(is_null($user_id)) $user_id = USERID;

		$user = $this->user->getUser($user_id);

		$view = Render::view('sections.user.password');
		$view['section'] 		= 'password';
		$view['role_id']		= $user->role_id;
		$view['user_id'] 		= $user_id;
		$view['section_name'] 	= t('menu.users');		
		$view['name']			= $user->username;

		return $view;
	}

	/**
	 * Show user settings page
	 * 
	 * @param  int $user_id
	 * @return string     view page
	 */
	public function settingsUser($user_id = null)
	{
		if(is_null($user_id)) $user_id = USERID;

		$user = $this->user->getUser($user_id);

		$view = Render::view('sections.user.settings');
		$view['section'] 		 = 'settings';
		$view['role_id']		 = $user->role_id;
		$view['user_id'] 		 = $user_id;
		$view['section_name'] 	 = t('menu.users');		
		$view['name']			 = $user->username;
		$view['email']			 = $user->email;
		$view['langs']			 = Pongo::settings('languages');
		$view['lang_selected']	 = $user->lang;
		$view['editors']		 = Pongo::settings('editors');
		$view['editor_selected'] = $user->editor;

		return $view;
	}

}