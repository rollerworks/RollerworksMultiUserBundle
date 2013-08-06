<?php

/*
 * This file is part of the RollerworksMultiUserBundle package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rollerworks\Bundle\MultiUserBundle\Tests\Functional\Bundle\AdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Rollerworks\Bundle\MultiUserBundle\DependencyInjection\Factory\UserServicesFactory;

class AcmeAdminExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $factory = new UserServicesFactory($container);
        $factory->create('acme_admin', array(
            array(
                'path' => '^/admin', // make this configurable
                'user_class' => 'Rollerworks\Bundle\MultiUserBundle\Tests\Functional\Bundle\AdminBundle\Entity\Admin',
                'services_prefix' => 'acme_admin',
                'routes_prefix' => 'acme_admin',
                'firewall_name' => 'admin',

                'group' => false,

                'security' => array(
                    'login' => array(
                        'template' => 'AcmeAdminBundle:Security:login.html.twig',
                    )
                ),

                'profile' => array(
                    'template' => array(
                        'edit' => 'AcmeAdminBundle:Profile:edit.html.twig',
                        'show' => 'AcmeAdminBundle:Profile:show.html.twig',
                    )
                ),

                'registration' => array(
                    'template' => array(
                        'register' => 'AcmeAdminBundle:Registration:register.html.twig',
                        'check_email' => 'AcmeAdminBundle:Registration:checkEmail.html.twig',
                    )
                ),

                'resetting' => array(
                    'template' => array(
                        'check_email' => 'AcmeAdminBundle:Resetting:checkEmail.html.twig',
                        'email' => 'AcmeAdminBundle:Resetting:email.txt.twig',
                        'password_already_requested' => 'AcmeAdminBundle:Resetting:passwordAlreadyRequested.html.twig',
                        'request' => 'AcmeAdminBundle:Resetting:request.html.twig',
                        'reset' => 'AcmeAdminBundle:Resetting:reset.html.twig',
                    )
                ),

                'change_password' => array(
                    'template' => array(
                        'change_password' => 'AcmeAdminBundle:changePassword:changePassword.html.twig',
                    )
                ),
            )
        ));
    }
}
