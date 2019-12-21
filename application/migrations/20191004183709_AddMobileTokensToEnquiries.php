<?php
/**
 * Migration: AddMobileTokensToEnquiries
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2019/10/04 18:37:09
 */
class Migration_AddMobileTokensToEnquiries extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_column('enquiry', [
			'mobile_token' => [
				'type' => 'VARCHAR',
				'constraint' => 6,
				'null' => TRUE,
			],
			'mobile_token_expire' => [
				'type' => 'DATETIME',
				'null' => TRUE,
			],
		]);
	}

	public function down()
	{
		$this->dbforge->drop_column('enquiry', 'mobile_token');
		$this->dbforge->drop_column('enquiry', 'mobile_token_expire');
	}

}
