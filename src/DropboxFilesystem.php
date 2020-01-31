<?php
namespace Codeception\Module;

use Spatie\Dropbox\Client;

/**
 * Class DropboxFilesystem
 *
 * @package Codeception\Module
 */
class DropboxFilesystem extends Filesystem {

	/**
	 * @var array
	 */
	protected $requiredFields = array( 'authorizationToken' );

	/**
	 * @var array
	 */
	protected static $client;

	/**
	 * @return Client
	 */
	protected function getClient() {
		if ( empty( self::$client ) ) {
			self::$client = new Client( $this->config['authorizationToken'] );
		}

		return self::$client;
	}

	/**
	 * Checks if a file exists
	 *
	 * @param string $file
	 *
	 * @return bool
	 */
	public function doesFileExist( $file ) {
		try {
			return (bool) $this->getClient()->getMetadata( $file );
		} catch ( \Exception $e ) {
			\PHPUnit_Framework_Assert::fail( $e->getMessage() );
		}
	}

	/**
	 * Asserts if a file exists
	 *
	 * @throws \PHPUnit_Framework_AssertionFailedError
	 *
	 * @param string $key
	 */
	public function seeFile( $key ) {
		$this->assertTrue( $this->doesFileExist( $key ) );
	}

	/**
	 * Delete a single file from the current bucket.
	 *
	 * @param string $file
	 *
	 * @return mixed
	 */
	public function deleteFile( $file ) {
		try {
			return $this->getClient()->delete( $file );
		} catch ( \Exception $e ) {
			\PHPUnit_Framework_Assert::fail( $e->getMessage() );
		}
	}
}