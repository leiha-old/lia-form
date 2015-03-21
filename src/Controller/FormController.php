<?php

namespace Lia\Bundle\FormBundle\Controller;

use Lia\Library\Asset\AssetInterface;
use Lia\Library\Controller\Controller;

class FormController
    extends Controller
    implements AssetInterface
{
    public function indexAction($name) {
        return $this->render('LiaFormBundle:Default:index', array(
            'name' => $name
        ));
    }

    public function buildResourcesFooter() {
        return $this->renderView('LiaFormBundle::resourceFooter', array(), true);
    }

    public function buildResourcesHeader() {
        //return $this->renderView('LiaFormBundle::resourceHeader.html', array(), true);
    }
}
