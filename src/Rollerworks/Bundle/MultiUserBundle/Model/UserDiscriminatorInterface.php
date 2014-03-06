<?php

/*
 * This file is part of the RollerworksMultiUserBundle package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rollerworks\Bundle\MultiUserBundle\Model;

use Rollerworks\Bundle\MultiUserBundle\Exception\NoActiveUserSystemException;

/**
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
interface UserDiscriminatorInterface
{
    /**
     * Adds a new user to the discriminator.
     *
     * @param string     $name
     * @param UserConfig $user
     * @return void
     */
    public function addUser($name, UserConfig $user);

    /**
     * Set the current user.
     *
     * @param string $name
     * @return void
     */
    public function setCurrentUser($name);

    /**
     * Returns the name of the current user.
     *
     * @return string|null
     */
    public function getCurrentUser();

    /**
     * Returns the configuration of the current user.
     *
     * This must throw an NoActiveUserSystemException when there is no user-system active.
     *
     * @return UserConfig
     *
     * @throws NoActiveUserSystemException when there is no user-system active
     */
    public function getCurrentUserConfig();
}
