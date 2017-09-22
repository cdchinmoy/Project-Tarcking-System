<?php 

class common_model extends CI_Model {

    var $test   = '';

    function __construct()
    {

        // Call the Model constructor

        parent::__construct();

    }

	public function get_data( $table, $where = '', $order_by = '', $limit = '', $select='*', $join = '', $join_type = 'inner', $group_by = '')
    {

		$this->db->select($select);

		$this->db->from($table);

		if(!empty($where))
		{

			$this->db->where($where); 
		}

		

		if(!empty($join))
		{

			if(is_array($join))
			{

				foreach($join as $table=>$on)
				{

                     $this->db->join($table,$on,$join_type);

				} 

			}

		}

		

		if(!empty($order_by))
		{

			if( is_array($order_by) ){

				foreach($order_by as $okey=>$oval){

                      $this->db->order_by($okey, $oval); 

				}

			}

		}

		

		if(!empty($limit))
		{
			
			//echo $limit['count']; die;

			if( is_array($limit) ){

				$this->db->limit($limit['count'], $limit['start']);
				//$query = $this->db->get();
				//echo $this->db->last_query(); die;
				
			}else if( $limit!='' ){

				$this->db->limit($limit);

			}


		}

		

		$this->db->group_by($group_by);


		$query = $this->db->get();

		//echo $this->db->last_query()."<br>";

		//exit;


		return $query->result();

    }

    public function insert( $table, $data )
    {

		$this->db->insert( $table, $data );

		return $this->db->insert_id();

    }

    public function update( $table, $where, $data)
    { 

		if(!empty($where))
		{
			$this->db->where($where); 
		}

		return $this->db->update( $table, $data );

		echo $this->db->last_query();

		exit;

    }

  	

    public function delete( $table, $where )
    {

		$this->db->where( $where );

		$this->db->delete($table);

		return true;

    }

	public function get_count($table,$where = NULL)
	{

		if(!empty($where))
		{

			$this->db->where($where); 

		}

		$query = $this->db->get($table);

		//echo $this->db->last_query();

		return $query->num_rows();

	}

}