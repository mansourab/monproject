<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemFormType;
use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ItemController extends AbstractController
{

    /**
     * @Route("/items", name="item.index")
     */
    public function allItem(ItemRepository $itemRepository): Response
    {
        $items = $itemRepository->findAll();
        return $this->render('item/index.html.twig', [
            'items' => $items
        ]);
    }

    /**
     * @Route("/item/create", name="item.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function createItem(Request $request, EntityManagerInterface $em)
    {
        $item = new Item();

        $form = $this->createForm(ItemFormType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($item);
            $em->flush();
            return $this->redirectToRoute('item.index');
        }
        return $this->render('item/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/item/edit/{slug}", name="item.edit")
     * @param Item $item
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function editItem(Item $item, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ItemFormType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($item);
            $em->flush();
            return $this->redirectToRoute('item.index');
        }

        return $this->render('item/edit.html.twig', [
            'item' => $item,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/item/delete/{slug}", name="item.delete", methods="DELETE")
     * @param Item $item
     * @param Request $request
     * @param EntityManagerInterface $em
     */
    public function deleteItem(Item $item, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete'. $item->getId(), $request->get('_token'))) {
            $em->remove($item);
            $em->flush();
        }
        return $this->redirectToRoute('item.index');
    }

    /**
     * @Route("/item/show/{slug}", name="item.show")
     * @param Item $item
     * @return Response
     */
    public function showItem(Item $item): Response
    {
        if (!$item) {
            throw $this->createNotFoundException('No item found');
        }
        return $this->render('item/show.html.twig', [
            'item' => $item
        ]);
    }
}
