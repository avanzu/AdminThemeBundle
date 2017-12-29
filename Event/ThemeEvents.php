<?php
/**
 * ThemeEvents.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;

/**
 * Holds all events used by the theme
 *
 */
class ThemeEvents
{
    /**
     * Used to receive notification data
     */
    const THEME_NOTIFICATIONS = 'theme.notifications';
    /**
     * Used to receive message data
     */
    const THEME_MESSAGES = 'theme.messages';
    /**
     * Used to receive task data
     */
    const THEME_TASKS = 'theme.tasks';

    const THEME_NAVBAR_USER = 'theme.navbar_user';
    /**
     * used to receive breadcrumb data
     */
    const THEME_BREADCRUMB = 'theme.breadcrumb';
    /**
     * used to receive the current user for the sidebar
     * 
     * macro: avanzu_sidebar_user
     * template: AvanzuAdminThemeBundle:Sidebar:user-panel.html.twig
     */
    const THEME_SIDEBAR_USER = 'theme.sidebar_user';

    /**
     * Used to receive the sidebar menu data
     */
    const THEME_SIDEBAR_SETUP_MENU = 'theme.sidebar_setup_menu';
    /**
     * used for the knp menu mechanics
     */
    const THEME_SIDEBAR_SETUP_KNP_MENU = 'theme.sidebar_setup_knp_menu';
}
