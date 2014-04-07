<?php

namespace Lelesys\Plugin\Forum\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Lelesys.Plugin.Forum".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * The Preferences model
 *
 * @Flow\Entity
 */
class Preferences {

	/**
	 * The object type
	 *
	 * @var string
	 */
	protected $objectType;

	/**
	 * The object identifier
	 *
	 * @var string
	 */
	protected $objectIdentifier;

	/**
	 * The user
	 *
	 * @var \TYPO3\Party\Domain\Model\AbstractParty
	 * @ORM\ManyToOne
	 * @ORM\Column(nullable=true)
	 */
	protected $user;

	/**
	 * Gets the object type
	 *
	 * @return string
	 */
	public function getObjectType() {
		return $this->objectType;
	}

	/**
	 * Sets the object type
	 *
	 * @param string $objectType
	 * @return void
	 */
	public function setObjectType($objectType) {
		$this->objectType = $objectType;
	}

	/**
	 * Gets the object identifier
	 *
	 * @return string
	 */
	public function getObjectIdentifier() {
		return $this->objectIdentifier;
	}

	/**
	 * Sets the object identifier
	 *
	 * @param string $objectIdentifier
	 * @return void
	 */
	public function setObjectIdentifier($objectIdentifier) {
		$this->objectIdentifier = $objectIdentifier;
	}

	/**
	 * Get the user
	 *
	 * @return \Lelesys\Plugin\Forum\Domain\Model\AbstractParty The user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 *
	 * @param \Lelesys\Plugin\Forum\Domain\Model\AbstractParty $user The user
	 * @return void
	 */
	public function setUser($user) {
		$this->user = $user;
	}

}

?>