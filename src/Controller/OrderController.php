<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Service\Order\OrderManager;
use App\Service\Order\PaymentService;
use App\Service\Payment\Seb;
use App\Service\Payment\Swedbank;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\SingleCommandApplication;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order/pay/{orderId}', name: 'order_pay', methods: ['GET'])]
    public function pay(int $orderId, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $paymentMethod = $data['paymentMethod'];

        $repository = new OrderRepository();
        $orderManager = new OrderManager($repository);

        if ($data['idType'] === 'external_id') {
            $order = $orderManager->getByExternalId($orderId);
        } else {
            $order = $orderManager->getById($orderId);
        }

        $paymentService = new PaymentService();
        if ($paymentMethod === 'swedbank') {
            $paymentService->setPaymentProvider(new Swedbank());
        } else {
            $paymentService->setPaymentProvider(new Seb());
        }

        $paymentService->pay($order->getTotal());

        return new Response('Payment successful');
    }
}