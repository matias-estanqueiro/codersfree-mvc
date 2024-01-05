<?php
    // STEP 1G : Controllers
    namespace App\Controllers;

    use App\Models\Contact;

    class HomeController extends Controller {
        // METHODS
        public function index() {
            // STEP 1I
            $contactModel = new Contact();
            
            // STEP 1J
            // Without method concatenation
            // $contactModel->query("SELECT * FROM contacts");
            // return $contactModel->get_first();

            // With method concatenation
            
            // CRUD : Create ----------------
            // return $contactModel->insert([
            //     'name' => 'Mike Smith',
            //     'email' => 'mike@me.com',
            //     'phone' => '66666666'
            // ]);

            // CRUD : Read -------------------
            // return $contactModel->select_all();
            // return $contactModel->find_by_id(2);
            

            // CRUD : Update ----------------
            // return $contactModel->update(6, [
            //     'name' => 'Mike Smith',
            //     'email' => 'mike@me.com',
            //     'phone' => '77777777'
            // ]);

            // CRUD : Delete ----------------
            // return $contactModel->delete(6);

            // STEP 1H
            // return $this->view('{folder}.home');
            return $this->view('home', [
                'title' => 'Home',
                'description' => 'Home page'
            ]);
        }
    }