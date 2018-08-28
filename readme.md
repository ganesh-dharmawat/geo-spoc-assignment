Project Setup Guidelines
1. To clone repository use git clone https://github.com/ganesh-dharmawat/geo-spoc-assignment.git

2. 2 Main branches - master & develop. Always pull develop branch on local.

3. Pull code from develop for local development.

4. Create .env file in root directory and copy all content from .env.example to .env file and 
    make changes according to requirement like database and other required passwords according to your local environment.

5. Install composer [It's dependency manager for php]

    	$ curl -sS https://getcomposer.org/installer | php

    	$ sudo mv composer.phar /usr/local/bin/composer

6.  Goto root path of project directory and run following command
	
	composer install

7.  Give recursive permission [777 -R] to following folders

	* bootstrap/cache

        * storage

        * public/uploads

8.  Run following command to generate DB [ Change database settings in .env file first ]

   	 $ php artisan key:generate
   	 
     $ php artisan migrate

9.  Create a virtual host and point it to public directory of Project
	Setup virtual host nginx 

