<?php

$config = array(
    'create_user' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'pass1',
	    'label' => 'Password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]|matches[pass2]'
	),
	array(
	    'field' => 'pass2',
	    'label' => 'Password again',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'update_user' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'pass1',
	    'label' => 'Password',
	    'rules' => 'trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]|matches[pass2]'
	),
	array(
	    'field' => 'pass2',
	    'label' => 'Password again',
	    'rules' => 'trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	),
	array(
	    'field' => 'user_id',
	    'label' => 'User ID',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|numeric|callback__check_user_id'
	)
    ),
    'login_user' => array(
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'password',
	    'label' => 'Password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'lostpassword' => array(
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|valid_email'
	)
    ),
    'change_password' => array(
	array(
	    'field' => 'currentpass',
	    'label' => 'Current password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	),
	array(
	    'field' => 'pass1',
	    'label' => 'New password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]|matches[pass2]'
	),
	array(
	    'field' => 'pass2',
	    'label' => 'New password again',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'change_profile' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[20]|valid_email'
	)
    ),
    'upload_settings' => array(
	array(
	    'field' => 'allowed_extensions',
	    'label' => 'Allowed Extensions',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'max_upload_files',
	    'label' => 'Maximum upload files',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[2]|numeric'
	),
	array(
	    'field' => 'max_upload_file_size',
	    'label' => 'Maximum upload file size',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[5]|numeric'
	)
    ),
    'general_settings' => array(
	array(
	    'field' => 'site_name',
	    'label' => 'Site name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[255]'
	),
	array(
	    'field' => 'site_email',
	    'label' => 'Site E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[60]|valid_email'
	)
    ),
    'add_staff' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'pass1',
	    'label' => 'Password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]|matches[pass2]'
	),
	array(
	    'field' => 'pass2',
	    'label' => 'Password again',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'update_staff' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'pass1',
	    'label' => 'Password',
	    'rules' => 'trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]|matches[pass2]'
	),
	array(
	    'field' => 'pass2',
	    'label' => 'Password again',
	    'rules' => 'trim|xss_clean|htmlspecialchars|min_length[6]|max_length[20]'
	)
    ),
    /* Customers Validation */
    'create_customers' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'pass1',
	    'label' => 'Password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]|matches[pass2]'
	),
	array(
	    'field' => 'pass2',
	    'label' => 'Password again',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'login_customer' => array(
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'password',
	    'label' => 'Password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'customer_lostpassword' => array(
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|valid_email'
	)
    ),
    'customer_change_profile' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'E-mail',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[20]|valid_email'
	)
    ),
    'customer_change_password' => array(
	array(
	    'field' => 'currentpass',
	    'label' => 'Current password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	),
	array(
	    'field' => 'pass1',
	    'label' => 'New password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]|matches[pass2]'
	),
	array(
	    'field' => 'pass2',
	    'label' => 'Repeat password again',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'admin_create_customers' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'Email',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'password',
	    'label' => 'Password',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[2]|max_length[20]'
	)
    ),
    'admin_update_customers' => array(
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'Email',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	)
    ),
    'admin_create_company' => array(
	array(
	    'field' => 'name',
	    'label' => 'Company Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'address',
	    'label' => 'Street # and Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'city',
	    'label' => 'City',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'state_id',
	    'label' => 'State',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'phone',
	    'label' => 'Phone',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'fax',
	    'label' => 'Fax',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'Email',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'regions',
	    'label' => 'Region',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'vertical',
	    'label' => 'Vertical',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'subverticals',
	    'label' => 'Subvertical',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'main_contact_person',
	    'label' => 'Main Contact Person',
	    'rules' => 'required'
	),
	array(
	    'field' => 'contact_person',
	    'label' => 'Contact Person',
	    'rules' => 'required'
	)
    ),
    'admin_update_company' => array(
	array(
	    'field' => 'name',
	    'label' => 'Company Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'address',
	    'label' => 'Street # and Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'city',
	    'label' => 'City',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'state_id',
	    'label' => 'State',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'phone',
	    'label' => 'Phone',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'fax',
	    'label' => 'Fax',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'Email',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'regions',
	    'label' => 'Region',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'vertical',
	    'label' => 'Vertical',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'subverticals',
	    'label' => 'Subvertical',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'main_contact_person',
	    'label' => 'Main Contact Person',
	    'rules' => 'required'
	),
	array(
	    'field' => 'contact_person',
	    'label' => 'Contact Person',
	    'rules' => 'required'
	)
    ),
    'admin_create_contact_person' => array(
	array(
	    'field' => 'title',
	    'label' => 'Title',
	    'rules' => 'required'
	),
	array(
	    'field' => 'first_name',
	    'label' => 'First Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'last_name',
	    'label' => 'Last Name',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|min_length[3]|max_length[50]'
	),
	array(
	    'field' => 'email',
	    'label' => 'Email',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email'
	),
	array(
	    'field' => 'job_position',
	    'label' => 'Job Position',
	    'rules' => 'required|trim|xss_clean|htmlspecialchars|max_length[50]'
	),
	array(
	    'field' => 'company',
	    'label' => 'Company',
	    'rules' => 'required'
	)
    ),
);
?>