<?php


namespace App\Domain\FormManager;


use App\Domain\FormPreloadInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractFormManager
{
    /**
     * @var \Symfony\Component\Form\FormInterface
     */
    protected $form;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct(FormFactoryInterface $formFactory,
                                Request $request,
                                ObjectManager $objectManager,
                                string $formTypeClass
    )
    {
        $this->form = $formFactory->create($formTypeClass);
        $this->request = $request;
        $this->objectManager = $objectManager;
    }

    abstract public function handle();

    public function execute(): self
    {
        if ($this instanceof FormPreloadInterface) {
            $this->preload();
        }
        $form = $this->form;
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handle();
        } else {
            throw $this->createNotFoundException();
        }
        return $this;
    }
}