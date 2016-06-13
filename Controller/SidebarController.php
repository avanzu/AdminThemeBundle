<?php
/**
 * SidebarController.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Controller;


use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Event\ThemeEvents;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SidebarController extends EmitterController
{

    /**
     * @return Response
     */
    public function userPanelAction()
    {

        if (!$this->hasListener(ThemeEvents::THEME_SIDEBAR_USER)) {
            return new Response();
        }

        $userEvent = $this->triggerMethod(ThemeEvents::THEME_SIDEBAR_USER, new ShowUserEvent());

        return $this->render('AvanzuAdminThemeBundle:Sidebar:user-panel.html.twig',array( 'user' => $userEvent->getUser() ));
    }


    /**
     * @return Response
     */
    public function searchFormAction()
    {
        return $this->render('AvanzuAdminThemeBundle:Sidebar:search-form.html.twig', array());
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function menuAction(Request $request)
    {
        if( $this->container->getParameter('avanzu_admin_theme.use_knp_menu') ) {
            return $this->buildKnpMenu($request);
        }

        return $this->buildGenericMenu($request);

    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    protected function buildGenericMenu(Request $request)
    {
        if (!$this->hasListener(ThemeEvents::THEME_SIDEBAR_SETUP_MENU)) {
            return new Response();
        }

        $event   = $this->triggerMethod(ThemeEvents::THEME_SIDEBAR_SETUP_MENU,new SidebarMenuEvent($request));

        return $this->render('AvanzuAdminThemeBundle:Sidebar:menu.html.twig', array('menu' => $event->getItems()) );
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    protected  function buildKnpMenu(Request $request)
    {
        return $this->render('AvanzuAdminThemeBundle:Sidebar:knp-menu.html.twig', array('menu' => 'main') );
    }
}