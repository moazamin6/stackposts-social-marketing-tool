<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
	/**
	 * --------------------------------------------------------------------------
	 * Templates
	 * --------------------------------------------------------------------------
	 *
	 * Pagination links are rendered out using views to configure their
	 * appearance. This array contains aliases and the view names to
	 * use when rendering the links.
	 *
	 * Within each view, the Pager object will be available as $pager,
	 * and the desired group as $pagerGroup;
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'default_full'   => 'CodeIgniter\Pager\Views\default_full',
		'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
		'default_head'   => 'CodeIgniter\Pager\Views\default_head',
	];

	/**
	 * --------------------------------------------------------------------------
	 * Items Per Page
	 * --------------------------------------------------------------------------
	 *
	 * The default number of results shown in a single page.
	 *
	 * @var integer
	 */
	public $perPage = 20;

	public function __construct(){
		if (file_exists(ROOTPATH.'inc/themes/backend')) {
		    $modulesPath = ROOTPATH.'inc/themes/backend/';
		    $modules = scandir($modulesPath);

		    foreach ($modules as $module) {
		        if ($module === '.' || $module === '..') continue;
		        if (is_dir($modulesPath) . '/' . $module) {
		            $constantPath = $modulesPath . $module . '/Config/Pager.php';
		            if (file_exists($constantPath)) {
		                include_once $constantPath;
		            } else {
		                continue;
		            }
		        }
		    }
		}

		if (file_exists(ROOTPATH.'inc/themes/frontend')) {
		    $modulesPath = ROOTPATH.'inc/themes/frontend/';
		    $modules = scandir($modulesPath);

		    foreach ($modules as $module) {
		        if ($module === '.' || $module === '..') continue;
		        if (is_dir($modulesPath) . '/' . $module) {
		            $constantPath = $modulesPath . $module . '/Config/Pager.php';
		            if (file_exists($constantPath)) {
		                include_once $constantPath;
		            } else {
		                continue;
		            }
		        }
		    }
		}
	}
}


