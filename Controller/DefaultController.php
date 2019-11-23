<?php

namespace Avanzu\AdminThemeBundle\Controller;

use Avanzu\AdminThemeBundle\Form\FormDemoModelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 *
 * @package Avanzu\AdminThemeBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('@AvanzuAdminTheme/Default/index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction() {
        return $this->render('@AvanzuAdminTheme/Default/index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uiGeneralAction() {
        return $this->render('@AvanzuAdminTheme/Default/index.html.twig');
    }

    public function uiIconsAction() {
        return $this->render('@AvanzuAdminTheme/Default/index.html.twig');
    }

    public function formAction() {
        $form = $this->createForm(FormDemoModelType::class);

        return $this->render('@AvanzuAdminTheme/Default/form.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    public function loginAction() {
        return $this->render('@AvanzuAdminTheme/Default/login.html.twig');
    }
}
