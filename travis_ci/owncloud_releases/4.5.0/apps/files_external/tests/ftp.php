<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

$config=include('apps/files_external/tests/config.php');
if(!is_array($config) or !isset($config['ftp']) or !$config['ftp']['run']) {
	abstract class Test_Filestorage_FTP extends Test_FileStorage{}
	return;
}else{
	class Test_Filestorage_FTP extends Test_FileStorage {
		private $config;

		public function setUp() {
			$id=uniqid();
			$this->config=include('apps/files_external/tests/config.php');
			$this->config['ftp']['root'].='/'.$id;//make sure we have an new empty folder to work in
			$this->instance=new OC_Filestorage_FTP($this->config['ftp']);
		}

		public function tearDown() {
			OCP\Files::rmdirr($this->instance->constructUrl(''));
		}
	}
}
