<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Migrate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->input->is_cli_request()
		or exit("Execute via command line: php index.php migrate");

		$this->load->library('migration');
	}

	function run(){
		$this->input->is_cli_request() or exit("Execute via command line: php index.php migrate");

		$this->load->library('migration');
		if( $this->migration->latest() === FALSE)
		{
			show_error($this->migration->error_string());
		}

		else
		{
			echo 'The migration has concluded successfully.';
		}
	}
	public function rollback($version = NULL)
	{
		$this->load->library('migration');
		$migrations = $this->migration->find_migrations();
		$migration_keys = array();
		foreach($migrations as $key => $migration)
		{
			$migration_keys[] = $key;
		}
		if(isset($version) && array_key_exists($version,$migrations) && $this->migration->version($version))
		{
			echo 'The migration was reset to the version: '.$version;
			exit;
		}
		elseif(isset($version) && !array_key_exists($version,$migrations))
		{
			echo 'The migration with version number '.$version.' doesn\'t exist.';
		}
		else
		{
			$penultimate = (sizeof($migration_keys)==1) ? 0 : $migration_keys[sizeof($migration_keys) - 2];

			if($this->migration->version($penultimate))
			{
				echo 'The migration has been rolled back successfully.';
				exit;
			}
			else
			{
				echo 'Couldn\'t roll back the migration.';
				exit;
			}
		}
	}
	public function reset()
	{
		$this->load->library('migration');
		if($this->migration->current()!== FALSE)
		{
			echo 'The migration was reset to the version set in the config file.';
			return TRUE;
		}
		else
		{
			echo 'Couldn\'t reset migration.';
			show_error($this->migration->error_string());
			exit;
		}
	}

	public function generate($classname)
	{

		$this->load->config('migration');
		$template = file_get_contents(__DIR__ . '/Migrate/template.txt');
		$search = [
			'@@classname@@',
			'@@date@@',
		];
		$replace = [
			$classname,
			date('Y/m/d H:i:s'),
		];
		$output = str_replace($search, $replace, $template);
		$outputPath = $this->config->item('migration_path') . date('YmdHis') . '_' . $classname . '.php';
		$generated = file_put_contents($outputPath, $output, LOCK_EX);

		echo('Generated: ' . $outputPath . "\r\n");
	}
}