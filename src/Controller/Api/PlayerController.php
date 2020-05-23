<?php
declare(strict_types=1);

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use App\Classes\DTO\GetPlayerRequest;
use App\Form\PlayerType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends AbstractFOSRestController {

    /**
     * @param Request $request
     *
     * @Rest\Get("/players")
     * @Rest\View()
     *
     * @return FormInterface|View
     */
    public function getPlayer(Request $request) {

        $getPlayerRequest = new GetPlayerRequest();
        $form = $this->createForm(PlayerType::class, $getPlayerRequest);
        $form->submit($request->query->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $form;
        }

        dd($getPlayerRequest->getPlayer());

//        return View::create(, Response::HTTP_OK);
    }
}