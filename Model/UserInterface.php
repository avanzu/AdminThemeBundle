<?php
/**
 * UserInterface.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Model;

interface UserInterface
{
    public function getAvatar();

    public function getUsername();

    public function getName();

    public function getMemberSince();

    public function isOnline();

    public function getIdentifier();

    public function getTitle();
}
