<?php
/**
 * NotificationInterface.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Model;

interface NotificationInterface
{
    public function getMessage();

    public function getType();

    public function getIcon();

    public function getIdentifier();
}
