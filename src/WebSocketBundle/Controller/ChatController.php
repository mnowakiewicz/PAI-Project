<?php

namespace WebSocketBundle\Controller;

use OperatorBundle\Entity\Operator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WebSocketBundle\Entity\Message;

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
        return $this->render('CMS/Chat/index.html.twig', [
            'users' => $users = $this->get('fos_user.user_manager')->findUsers()
        ]);
    }

    /**
     * @Route(path="/api/messages/{id}", name="api_chat_messages")
     * @param Operator $operator
     * @return JsonResponse
     * @throws \Exception
     */
    public function apiMessagesAction(Operator $operator): JsonResponse
    {
        /** @var Operator $from */
        $from = $this->getUser();
        $to = $this->getDoctrine()
            ->getRepository('OperatorBundle:Operator')
            ->findOneBy([
                'id' => $operator->getId()
            ]);

        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findAllLastMessagesByUsers($from, $to);

        return new JsonResponse(json_encode($this->toMessagesDTO($messages)));
    }


    /**
     *  @Route(path="/api/is-user-offline/{id}", name="api_chat_is_offline")
     *
     * @param Operator $operator
     * @return JsonResponse
     */
    public function isUserOfflineAction(Operator $operator): JsonResponse
    {
        return new JsonResponse(!$operator->getIsActiveNow());
    }

    /**
     * @param Message[] $messages
     * @return array
     * @throws \Exception
     */
    private function toMessagesDTO(array $messages): array
    {
        $messages = array_reverse($messages);
        $messagesDTO = [];
        $now = new \DateTime('now');
        foreach ($messages as $i => $msg) {

            if ($i > 0 &&
                $msg->getCreationDate()->diff($messages[$i - 1]->getCreationDate())->i < 3) {
                $time = null;
            } else if ($now->diff($msg->getCreationDate())->h > 12) {
                $time = $msg->getCreationDate()->format('d/M');
            } else {
                $time = $msg->getCreationDate()->format('H:i');
            }

            if ($msg->getFrom() === $this->getUser()){
                $side = 'right';
            } else {
                $side = 'left';
            }

            $messagesDTO[] = [
                'from' => $msg->getFrom()->getUsername(),
                'to' => $msg->getTo()->getUsername(),
                'message' => $msg->getText(),
                'time' => $time,
                'side'=> $side
            ];
        }

        return $messagesDTO;
    }
}
