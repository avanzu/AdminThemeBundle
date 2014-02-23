<?php
/**
 * MessageInterface.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Model;


interface MessageInterface {
    public function getFrom();
    public function getSentAt();
    public function getSubject();
    public function getIdentifier();
}