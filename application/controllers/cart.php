<?php
 
class Cart extends CI_Controller { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('cart_model');

    }

    public function index()
	{
		

 
        $data['products'] = $this->cart_model->retrieve_products(); 
         $data['content'] = 'cart/products';

         $this->load->view('index', $data);




	}
	function add_cart_item()
	{
     
        if($this->cart_model->validate_add_cart_item() == TRUE)
        {
         
        
            if($this->input->post('ajax') != '1')
            {
                redirect('cart'); 
            }else
            {
            echo 'true'; 
            }
       }
     
    }

    function show_cart()
    {
    $this->load->view('cart/cart');
    }

    function update_cart()
    {
          $this->cart_model->validate_update_cart();
          redirect('cart');
    }
    function empty_cart(){
    $this->cart->destroy(); // Destroy all cart data
    redirect('cart'); // Refresh te page
    }
 
}