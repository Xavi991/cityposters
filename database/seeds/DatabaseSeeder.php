<?php

use Illuminate\Database\Seeder;

use App\Site;
use App\User;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	$products= [
    		[
        		'id'	=>10,
        		'barcode' =>'2003059000000',
        		'description' => 'COLITA DE CUADRIL X KG'

        	],
        	[
        		'id'	=>20,
        		'barcode' =>'2003062000000',
        		'description' => 'TAPA DE CUADRIL X KG'

        	],
        	[
        		'id'	=>30,
        		'barcode' =>'2004560000000',
        		'description' => 'QUESO SANDWICH TREBOL X KG.'

        	],
        	[
        		'id'	=>40,
        		'barcode' =>'2004562000000',
        		'description' => 'CHORIZO CALABRESA CON QUESO UPISA X KG'

        	],
        	[
        		'id'	=>50,
        		'barcode' =>'2004031000000',
        		'description' => 'PAPA NEGRA X KG'

        	],    

            [
                'id'    =>60,
                'barcode' =>'2004081000000',
                'description' => 'YOGOURT SACHET 500ML VAINILLA'
            ],

            [
                'id'    =>70,
                'barcode' =>'2004082000000',
                'description' => 'YOGOURT SACHET 500ML FRUTILLA'
            ]

    	];

        $users=[
            [
                'id'        =>1,
                'user'      =>'admin',
                'password'  =>'admin',
                'full_name' =>'Ernesto Rojas',
                'identity_number'  =>9999999,
                'site_id'   =>1
            ],

            [
                'id'        =>2,
                'user'      =>'pepe',
                'password'  =>'pepe',
                'full_name' =>'Pepe Gonzales',
                'identity_number'  =>1234567,
                'site_id'   =>1
            ]

        ];

        Site::create([
        	'id'		=>1,
        	'code'		=>'SLO',
        	'description' =>'San Lorenzo',
        	'address'	  =>'Ortiz Guerrero'
        ]);

        foreach($users as $user){
             User::create($user);
        }
        
        foreach($products as $product){
        	Product::create($product);
        }



    }
}
