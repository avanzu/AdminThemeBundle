<?php
/**
 * BreadcrumbController.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Controller;


use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Event\ThemeEvents;
use Avanzu\AdminThemeBundle\Model\MenuItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BreadcrumbController extends Controller {


    public function breadcrumbAction(Request $request, $title = '') {

        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_BREADCRUMB)) {
            return new Response();
        }

        $active = $this->getDispatcher()->dispatch(ThemeEvents::THEME_BREADCRUMB,new SidebarMenuEvent($request))->getActive();
        /** @var $active MenuItemInterface */
        $list = array();
        if($active) {

            $list[] = $active;
            while(null !== ($item = $active->getActiveChild())) {
                $list[] = $item;
                $active = $item;
            }
        }


        return $this->render('AvanzuAdminThemeBundle:Breadcrumb:breadcrumb.html.twig', array(
                'active' => $list,
                'title'  => $title
            ));
    }


    /**
     * @return EventDispatcher
     */
    protected function getDispatcher()
    {
        return $this->get('event_dispatcher');
    }

}