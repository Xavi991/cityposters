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
        //STRING_AGG(o.group_code, '/')  GROUP_CONCAT(o.group_code)
        // $this->call(UsersTableSeeder::class);
    	/*$products= [
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
                'barcode' =>'7840037014334',
                'description' => 'YOGHURT KISSI GURT '
            ],

            [
                'id'    =>70,
                'barcode' =>'7840037014365',
                'description' => 'YOGHURT KISSI GURT  DURAZNO SACHET 1 LT'
            ],
            [
                'id'    =>80,
                'barcode' =>'7840037014372',
                'description' => 'YOGHURT KISSI GURT  BANANA SACHET 1 LT'
            ],
            [
                'id'    =>90,
                'barcode' =>'7897736409848',
                'description' => 'VODKA MIKS ICE LIMON/JENGIBRE'
            ],
            [
                'id'    =>100,
                'barcode' =>'7897736409800',
                'description' => 'VODKA MIKS ICE FRUTILLA/KIWI Y'
            ],
            [
                'id'    =>110,
                'barcode' =>'7840821000956',
                'description' => 'EXTRACTO DE TOMATE BON GUSTO 70 GR'
            ],
            [
                'id'    =>120,
                'barcode' =>'7840024005239',
                'description' => 'FIDEOS TALLARIN AMARILLO GRUESO FEDERAL 400 GR'
            ],


    	];

        $users=[
            [
                'id'        =>1,
                'user'      =>'admin',
                'password'  =>'admin',
                'full_name' =>'Ernesto Rojas',
                'identity_number'  =>9999999,
                'role'      =>'admin',
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

        $sites=[
            [
                'id'            =>1,
                'code'          =>'SLO',
                'description'   =>'San Lorenzo',
                'address'       =>'Ortiz Guerrero'
            ],
            [
                'id'            =>2,
                'code'          =>'CPA',
                'description'   =>'Capiatá',
                'address'       =>'km 23'
            ],
            [
                'id'            =>3,
                'code'          =>'ARE',
                'description'   =>'Aregua',
                'address'       =>'Pindolo'
            ],
        ];*/


        Product::create([ //CASO NO ESXISTA EAN PRODUCTO
        	'id'           =>0,
            'barcode'      =>'XXX',
            'description'  => 'NO EXISTE EN LA BD'
        ]);

        /*foreach($sites as $site){
            Site::create($site);
        }

        foreach($users as $user){
             User::create($user);
        }
        
        foreach($products as $product){
        	Product::create($product);
        }*/

    }
}
