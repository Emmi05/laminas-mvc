<?php

declare(strict_types=1);

namespace Album\Controller;

// Add the following import:
use Album\Form\AlbumForm;
use Album\Model\Album;
use Album\Model\AlbumTable;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{

    /**
     * @var Request
     */
    protected $request;

     // Add this constructor:
    public function __construct(
        private AlbumTable $table,
        private AlbumForm $form,
    ) {
    }

    public function indexAction()
    {
        return new ViewModel([
            'albums' => $this->table->fetchAll(),
        ]);
    }

    /* Update the following method to read as follows: */
    public function addAction()
    {
        $this->form->get('submit')->setValue('Add');

        if (! $this->request->isPost()) {
             return new ViewModel(['form' => $this->form]);
        }

        $album = new Album();
        $this->form->setData($this->request->getPost());

        if (! $this->form->isValid()) {
          return ['form' => $this->form];
        }

        $album->exchangeArray($this->form->getData());
        $this->table->saveAlbum($album);
        return $this->redirect()->toRoute('album');
    }


    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $viewData = ['id' => $id, 'form' => $this->form];

        if (! $this->request->isPost()) {
            return $viewData;
        }

        $this->form->setData($this->request->getPost());

        if (! $this->form->isValid()) {
            return $viewData;
        }

        try {
<<<<<<< HEAD
            $this->table->saveAlbum((new Album())->exchangeArray($this->form->getData()));
=======
            $this->table->saveAlbum( (new Album() )->exchangeArray( $this->form->getData() ) );
>>>>>>> a63e674f0b7c9481ecd0c3d150fdb47e0522aad9
        } catch (\Exception $e) {
        }

        // Redirect to album list
        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }

   // Add content to the following method:
   public function deleteAction()
   {
       $id = (int) $this->params()->fromRoute('id', 0);
       if (!$id) {
           return $this->redirect()->toRoute('album');
       }

       if ($this->request->isPost()) {
           $del = $this->request->getPost('del', 'No');

           if ($del == 'Yes') {
               $id = (int) $this->request->getPost('id');
               $this->table->deleteAlbum($id);
           }

           // Redirect to list of albums
           return $this->redirect()->toRoute('album');
       }

       return [
           'id'    => $id,
           'album' => $this->table->getAlbum($id),
       ];
   }
}
