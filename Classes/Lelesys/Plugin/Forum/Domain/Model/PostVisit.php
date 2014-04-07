<?php

namespace Lelesys\Plugin\Forum\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Post Vist Model
 *
 * @Flow\Entity
 */
class PostVisit {

	/**
	 * The IP address
	 *
	 * @var string
	 */
	protected $ipAddress;

	/**
	 * The session identifier
	 *
	 * @var string
	 */
	protected $sessionIdentifier;

	/**
	 * The post node
	 *
	 * @var string
	 */
	protected $postNodeIdentifier;

	/**
	 * The created Date
	 *
	 * @var \DateTime
	 */
	protected $createdDate;

	/**
	 * The Constructor for Author
	 */
	public function __construct() {
		$this->createdDate = new \DateTime();
	}

	/**
	 * Gets the ip address
	 *
	 * @return string
	 */
	public function getIpAddress() {
		return $this->ipAddress;
	}

	/**
	 * Sets the ip address
	 *
	 * @param string $ipAddress
	 * @return void
	 */
	public function setIpAddress($ipAddress) {
		$this->ipAddress = $ipAddress;
	}

	/**
	 * Gets session identfier
	 *
	 * @return string
	 */
	public function getSessionIdentifier() {
		return $this->sessionIdentifier;
	}

	/**
	 * Sets session identifier
	 *
	 * @param string $sessionIdentifier
	 * @return void
	 */
	public function setSessionIdentifier($sessionIdentifier) {
		$this->sessionIdentifier = $sessionIdentifier;
	}

	/**
	 * Gets post node identifier
	 *
	 * @return string
	 */
	public function getPostNodeIdentifier() {
		return $this->postNodeIdentifier;
	}

	/**
	 * Sets post node identifier
	 *
	 * @param string $postNodeIdentifier
	 * @return void
	 */
	public function setPostNodeIdentifier($postNodeIdentifier) {
		$this->postNodeIdentifier = $postNodeIdentifier;
	}

	/**
	 * Gets created node
	 *
	 * @return \DateTime
	 */
	public function getCreatedDate() {
		return $this->createdDate;
	}

	/**
	 * Sets created date
	 *
	 * @param \DateTime $createdDate
	 * @return void
	 */
	public function setCreatedDate($createdDate) {
		$this->createdDate = $createdDate;
	}

}

?>