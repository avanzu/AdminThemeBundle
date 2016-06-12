<?php
/**
 * SidebarController.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Controller;


use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Event\SidebarKnpMenuEvent;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Event\ThemeEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SidebarController extends Controller
{

    public function userPanelAction()
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_SIDEBAR_USER)) {
            return new Response();
        }
        $userEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_SIDEBAR_USER, new ShowUserEvent());

        return $this->render('AvanzuAdminThemeBundle:Sidebar:user-panel.html.twig',array( 'user' => $userEvent->getUser() ));
    }

    /**
     * @return EventDispatcher
     */
    protected function getDispatcher()
    {
        return $this->get('event_dispatcher');
    }

    public function searchFormAction()
    {
        return $this->render('AvanzuAdminThemeBundle:Sidebar:search-form.html.twig', array());
    }


    public function menuAction(Request $request)
    {
        if( $this->container->getParameter('avanzu_admin_theme.use_knp_menu') ) {
            return $this->buildKnpMenu($request);
        }

        return $this->buildGenericMenu($request);

    }

    protected function buildGenericMenu(Request $request)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_SIDEBAR_SETUP_MENU)) {
            return new Response();
        }

        $event   = $this->getDispatcher()->dispatch(
            ThemeEvents::THEME_SIDEBAR_SETUP_MENU,
            new SidebarMenuEvent($request)
        );

        return $this->render('AvanzuAdminThemeBundle:Sidebar:menu.html.twig', array('menu' => $event->getItems()) );
    }

    protected  function buildKnpMenu(Request $request)
    {
        return $this->render('AvanzuAdminThemeBundle:Sidebar:knp-menu.html.twig', array('menu' => 'main') );
    }
}