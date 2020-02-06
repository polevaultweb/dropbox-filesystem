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
	 * @var string
	 */
	protected $authorizationToken;

	/**
	 * @var array
	 */
	protected static $client;

	/**
	 * @return Client
	 */
	protected function getClient() {
		$authorizationToken = $this->authorizationToken ? $this->authorizationToken : $this->config['authorizationToken'];

		if ( empty( self::$client ) ) {
			self::$client = new Client( $authorizationToken );
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
	public function doesDropboxFileExist( $file ) {
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
	public function seeDropboxFile( $key ) {
		$this->assertTrue( $this->doesFileExist( $key ) );
	}

	/**
	 * Delete a single file from the current bucket.
	 *
	 * @param string $file
	 *
	 * @return mixed
	 */
	public function deleteDropboxFile( $file ) {
		try {
			return $this->getClient()->delete( $file );
		} catch ( \Exception $e ) {
			\PHPUnit_Framework_Assert::fail( $e->getMessage() );
		}
	}

	/**
	 * @param string $authorizationToken
	 */
	public function setDropboxAuthorizationToken( $authorizationToken ) {
		$this->authorizationToken = $authorizationToken;
	}
}
