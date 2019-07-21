<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item Settings Class
 * 
 * @property M_Item $mi of Item Model Class
 */
class Item extends MY_Controller {

    /**
     * Sidebar active menu slug
     * @var string 
     */
    protected $activeMenu;

    public function __construct() {
        parent::__construct();

        $this->activeMenu = 'it';

        // Load required database models
        $this->load->model('M_Item', 'mi');
    }

    /**
     * Redirects to Item List view method
     */
    public function index() {
        $this->show();
    }

    /**
     * View Item in Tabular List
     */
    public function show() {
        $this->load->library('table');
        $this->data['itemList'] = $this->mi->getTableData();

        /**
         * Load list view page
         */
        $this->processViewData('admin/item/list', 'Item Settings | Admin', $this->activeMenu);
    }

    /**
     * View Item Add Form
     */
    public function add() {

        // Load list view page
        $this->processViewData('admin/item/add', 'Item Settings | Admin', $this->activeMenu);
    }

    /**
     * Process and Insert Item Data from Form Post
     */
    public function insert() {

        $itemName = trim($this->input->post('itemName', true));

        /**
         * Check unique item
         */
        $this->mi->condition['name'] = $itemName;
        if ($this->mi->checkUnique() == false) {
            // Error message in session
            $this->session->set_flashdata('error', 'Error! Item already exist!');
            goto methodEnd;
        }

        /**
         * Upload Item Image
         */
        $itemImage = $this->processFileUpload('itemImage', FCPATH . IMAGE_STORAGE_PATH . 'item');

        if (empty($itemImage)) {
            // Error occured while file uploading
            goto methodEnd;
        }

        /**
         * Insert Content Data
         */
        $this->mi->data = [
            'name' => $itemName,
            'description' => $this->input->post('itemDescription', true),
            'image' => $itemImage
        ];

        if ($this->mi->insertIntoTable() == false) {
            // Error message in session
            $this->session->set_flashdata('error', 'Error! Failed to add new item!');
        } else {
            // Success message in session
            $this->session->set_flashdata('success', 'Success! New item is added!');
        }

        // Jump code to here
        methodEnd:

        // Redirect to Item add form
        redirect('admin/item/add');
    }

    /**
     * Method for item edit form view
     * 
     * @param int $id Item Id
     */
    public function edit($id = 0) {

        if ($this->input->post('update')) {
            $id = intval($this->input->post('itemId'));

            $itemInfo = $this->mi->getTableRowById($id);

            if (empty($itemInfo)) {
                // Error message in session
                $this->session->set_flashdata('error', 'Error! Requested item not found!');
                redirect('admin/item/list');
            }

            $itemName = trim($this->input->post('itemName', true));

            /**
             * Check unique item
             */
            $this->mi->condition = [
                'name' => $itemName,
                'id !=' => $id
            ];
            if ($this->mi->checkUnique() == false) {
                // Error message in session
                $this->session->set_flashdata('error', 'Error! Item already exist!');
            } else {

                /**
                 * Update item information
                 */
                $this->mi->data['name'] = $itemName;
                $this->mi->data['description'] = trim($this->input->post('itemDescription', true));

                if (file_exists($_FILES['itemImage']['tmp_name']) || is_uploaded_file($_FILES['itemImage']['tmp_name'])) {
                    /**
                     * Upload item image
                     */
                    $itemImage = $this->processFileUpload('itemImage', FCPATH . IMAGE_STORAGE_PATH . 'item');
                    if (!empty($itemImage)) {
                        $this->mi->data['image'] = $itemImage;

                        // delete old image file
                        unlink(FCPATH . IMAGE_STORAGE_PATH . 'item/' . $itemInfo->image);
                    } else {
                        // Error message in session
                        $this->session->set_flashdata('error', 'Error! Image upload failed!');
                    }
                }

                $this->mi->updateTableById($id);
            }
        } else {
            $id = intval($id);
        }

        /**
         * Get Item Information from database table
         */
        $this->data['itemInfo'] = $this->mi->getTableRowById($id);
        $this->data['itemId'] = $id;

        if (empty($this->data['itemInfo'])) {
            $this->session->set_flashdata('error', 'Error! Requested item not exist!');
            redirect('admin/item/list');
        }

        /**
         * Load list view page
         */
        $this->processViewData('admin/item/edit', 'Item Settings | Admin', $this->activeMenu);
    }

    public function delete($id = 0) {
        $id = intval($id);
        if ($this->mi->deleteTableRowById($id) > 0) {
            // Success message in session
            $this->session->set_flashdata('success', 'Success! Item has been deleted!');
        } else {
            // Error message in session
            $this->session->set_flashdata('error', 'Error! Failed to delete item!');
        }
        
        redirect('admin/item/list');
    }

}
