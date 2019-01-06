<?php

namespace WebSocketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BookAdminController
 * @package BookBundle\Controller
 *
 * @Route(path="cms/chat")
 */
class ChatController extends Controller
{
    /**
     * @return Response
     *
     * @Route(path="/", name="chat_index_users")
     */
    public function usersAction(): Response
    {
        return $this->render('CMS/Chat/index.html.twig');
    }
}
