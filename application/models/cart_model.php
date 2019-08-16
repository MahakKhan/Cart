<?php 
 
    class Cart_model extends CI_Model 
    { 
        function retrieve_products()
        {
            $query = $this->db->get('products'); 
            return $query->result_array(); 
        }   

        
        function validate_add_cart_item()
        {
     
              $id = $this->input->post('product_id'); 
              $cty = $this->input->post('quantity'); 
     
              $this->db->where('id', $id); 
              $query = $this->db->get('products', 1); 
     
             
              if($query->num_rows > 0)
              {
     
               
                  foreach ($query->result() as $row)
                  {
                       
                      $data = array(
                      'id'      => $id,
                      'qty'     => $cty,
                      'price'   => $row->price,
                      'name'    => $row->name
                      );
 
                      
                      $this->cart->insert($data); 
             
                       return TRUE; 
                  }
     
                }
                else
                {
                  
                    return FALSE;
                }
        } 
        function validate_update_cart()
        {
     
             
              $total = $this->cart->total_items();
     
              
              $item = $this->input->post('rowid');
              $qty = $this->input->post('qty');
 
            
               for($i=0;$i < $total;$i++)
               {
                   
                    $data = array(
                    'rowid' => $item[$i],
                     'qty'   => $qty[$i]
                    );
         
        
                     $this->cart->update($data);
                }
 
        }       
     
    }