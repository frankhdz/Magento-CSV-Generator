<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Setconfig Controller
 *
 * @property \App\Model\Table\SetconfigTable $Setconfig
 */
class SetconfigController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('setconfig', $this->paginate($this->Setconfig));
        $this->set('_serialize', ['setconfig']);
    }

    /**
     * View method
     *
     * @param string|null $id Setconfig id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setconfig = $this->Setconfig->get($id, [
            'contain' => []
        ]);
        $this->set('setconfig', $setconfig);
        $this->set('_serialize', ['setconfig']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setconfig = $this->Setconfig->newEntity();
        if ($this->request->is('post')) {
            $setconfig = $this->Setconfig->patchEntity($setconfig, $this->request->data);
            if ($this->Setconfig->save($setconfig)) {
                $this->Flash->success('The setconfig has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The setconfig could not be saved. Please, try again.');
            }
        }
        $this->set(compact('setconfig'));
        $this->set('_serialize', ['setconfig']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Setconfig id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $setconfig = $this->Setconfig->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setconfig = $this->Setconfig->patchEntity($setconfig, $this->request->data);
            if ($this->Setconfig->save($setconfig)) {
                $this->Flash->success('The setconfig has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The setconfig could not be saved. Please, try again.');
            }
        }
        $this->set(compact('setconfig'));
        $this->set('_serialize', ['setconfig']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Setconfig id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setconfig = $this->Setconfig->get($id);
        if ($this->Setconfig->delete($setconfig)) {
            $this->Flash->success('The setconfig has been deleted.');
        } else {
            $this->Flash->error('The setconfig could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
