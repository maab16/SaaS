<?php
/*
|--------------------------------------------------------------------------
| Prohect Name: SaaS App for mulitiple company
| Author Name: Created By Md Abu Ahsan Basir
| Zend Certified PHP Engineer
| Authour link: http://www.zend.com/en/yellow-pages/ZEND030936
|--------------------------------------------------------------------------
|
|
*/
use App\Map;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Map::create([
        	'latitude' 			=> 40.72807182,
        	'longitude' 		=> -73.85735035,
        	'featured' 			=> 1,
        	'title' 			=> "Marky's Restaurant",
        	'location' 			=> "63 Birch Street",
        	'city' 				=> 1,
        	'phone' 			=> "361-492-2356",
        	'email' 			=> "hello@markys.com",
        	'website' 			=> "http://www.markys.com",
        	'category' 			=> "Restaurant",
        	'rating' 			=> "4",
        	'reviews_number' 	=> "6",
        	'marker_color' 		=> "#000000",
        	'marker_image' 		=> "assets/img/items/1.jpg",
        	'gallery' 			=> 'assets/img/items/1.jpg,assets/img/items/2.jpg,assets/img/items/12.jpg',
        	'tags' 				=> 'Wi-Fi,Parking,TV,Vegetarian',
        	'additional_info' 	=> "Average price $30",
        	'url' 				=> "detail.html",
        	'description' 		=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis, arcu non hendrerit imperdiet, metus odio scelerisque elit, sed lacinia odio est ac felis. Nam ullamcorper hendrerit ullamcorper. Praesent quis arcu quis leo posuere ornare eu in purus. Nulla ornare rutrum condimentum. Praesent eu pulvinar velit. Quisque non finibus purus, eu auctor ipsum.",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

        Map::create([
        	'latitude' 			=> 40.73925841,
        	'longitude' 		=> -73.85348797,
        	'featured' 			=> 0,
        	'title' 			=> "Ironapple",
        	'location' 			=> "4209 Glenview Drive",
        	'city' 				=> 1,
        	'phone' 			=> "989-410-0777",
        	'email' 			=> "",
        	'website' 			=> "",
        	'category' 			=> "Restaurant",
        	'rating' 			=> "3",
        	'reviews_number' 	=> "12",
        	'marker_color' 		=> "",
        	'marker_image' 		=> "assets/img/items/2.jpg",
        	'gallery' 			=> 'assets/img/items/2.jpg,assets/img/items/4.jpg,assets/img/items/12.jpg',
        	'tags' 				=> '',
        	'additional_info' 	=> "",
        	'url' 				=> "detail.html",
        	'description' 		=> "Aliquam vel turpis sagittis, semper tellus eget, aliquam turpis. Cras aliquam, arcu",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

        Map::create([
        	'featured' 			=> 0,
        	'title' 			=> "Food Festival",
        	'location' 			=> "23 Hillhaven Drive",
        	'city' 				=> 1,
        	'phone' 			=> "323-843-4729",
        	'category' 			=> "Event",
        	'rating' 			=> "5",
        	'reviews_number' 	=> "15",
        	'marker_image' 		=> "assets/img/items/4.jpg",
        	'gallery' 			=> 'assets/img/items/4.jpg,assets/img/items/2.jpg,assets/img/items/12.jpg',
        	'tags' 				=> 'Wi-Fi, Parking,TV,Vegetarian',
        	'additional_info' 	=> "Starts at 19:00",
        	'url' 				=> "detail.html",
        	'description' 		=> "Sed ac dolor auctor, elementum lacus vitae, efficitur magna. Quisque sed semper tellus",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

         Map::create([
        	'latitude' 			=> 40.709016,
        	'longitude' 		=> -73.844969,
        	'featured' 			=> 0,
        	'title' 			=> "Cosmopolit",
        	'location' 			=> "4209 Glenview Drive",
        	'city' 				=> 1,
        	'phone' 			=> "323-843-4729",
        	'category' 			=> "Wellness",
        	'rating' 			=> "5",
        	'reviews_number' 	=> "28",
        	'marker_image' 		=> "assets/img/items/5.jpg",
        	'gallery' 			=> 'assets/img/items/5.jpg,assets/img/items/2.jpg,assets/img/items/12.jpg',
        	'tags' 				=> 'Wi-Fi, Parking, TV, Vegetarian',
        	'url' 				=> "detail.html",
        	'description' 		=> "Sed ac dolor auctor, elementum lacus vitae, efficitur magna. Quisque sed semper tellus",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

          Map::create([
        	'latitude' 			=> 47.8043117,
        	'longitude' 		=> 13.0356014,
        	'featured' 			=> 0,
        	'title' 			=> "Enjoy a small meal",
        	'location' 			=> "Monchstein",
        	'city' 				=> 2,
        	'category' 			=> "Restaurant",
        	'marker_image' 		=> "assets/img/items/6.jpg",
        	'gallery' 			=> 'https://experio.at/monchstein.jpg, https://experio.at/monchstein.jpg, https://experio.at/monchstein.jpg ',
        	'tags' 				=> 'Romantic, Scenic, Culinary, Partners',
        	'url' 				=> "detail.html",
        	'description' 		=> "The smallest restaurant in the world.  Enjoz a romatic gourmet pakage for 2.  This package includes a panoram view over Salzburg with a welcome Prosecco drink, followed by a 5 course menu-of-the-day accompanied by wine, and coffee and pralines to conclude.",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);


           Map::create([
        	'featured' 			=> 1,
        	'title' 			=> "Stand Up Show",
        	'location' 			=> "534 Sycamore Road",
        	'city' 				=> 2,
        	'phone' 			=> "352-383-7435",
        	'category' 			=> "Sport",
        	'rating' 			=> "4",
        	'reviews_number' 	=> "8",
        	'marker_image' 		=> "assets/img/items/6.jpg",
        	'gallery' 			=> 'assets/img/items/6.jpg, assets/img/items/12.jpg, assets/img/items/5.jpg',
        	'tags' 				=> 'Wi-Fi, Parking, TV, Vegetarian',
        	'additional_info' 	=> "Free entry",
        	'url' 				=> "detail.html",
        	'description' 		=> "Phasellus at facilisis est. Sed dignissim porttitor aliquam. Quisque fermentum mollis diam id porttitor. Maecenas pulvinar, lacus non egestas finibus, nibh lectus ornare massa, id lacinia est nunc quis ante. Cras non nisl enim. Sed sodales volutpat nisl. Phasellus dictum lacus eu volutpat venenatis. Ut commodo massa ac sagittis finibus. ",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

        Map::create([
        	'latitude' 			=> 40.75408424,
        	'longitude' 		=> -73.87666225,
        	'featured' 			=> 0,
        	'title' 			=> "University Day",
        	'location' 			=> "Central Town University",
        	'city' 				=> 1,
        	'phone' 			=> "925-585-2459",
        	'category' 			=> "Relax",
        	'rating' 			=> "5",
        	'reviews_number' 	=> "10",
        	'marker_image' 		=> "assets/img/items/12.jpg",
        	'gallery' 			=> 'assets/img/items/12.jpg, assets/img/items/9.jpg, assets/img/items/11.jpg',
        	'description' 		=> "Duis nec lobortis massa. Mauris tempus vitae augue eu tempus",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

        Map::create([
        	'latitude' 			=> 40.75479944,
        	'longitude' 		=> -73.89786243,
        	'featured' 			=> 0,
        	'title' 			=> "City Tour",
        	'location' 			=> "Downtown center",
        	'city' 				=> 1,
        	'website' 			=> "reservation@citytours.com",
        	'category' 			=> "Sport",
        	'rating' 			=> "5",
        	'reviews_number' 	=> "17",
        	'marker_image' 		=> "assets/img/items/10.jpg",
        	'gallery' 			=> 'assets/img/items/10.jpg, assets/img/items/4.jpg, assets/img/items/8.jpg',
        	'additional_info' 	=> "Get to know your city!",
        	'description' 		=> "Integer mattis nibh ante, vel vulputate tortor iaculis a. Aenean iaculis aliquam magna eget fermentum. Nulla euismod, arcu in aliquet vestibulum, justo quam ultricies mauris, eget elementum ex odio ut nulla. Suspendisse neque tellus, varius nec tortor consectetur, gravida ullamcorper magna. Sed ut enim dui.",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

          Map::create([
        	'latitude' 			=> 40.74654168,
        	'longitude' 		=> -73.90515804,
        	'featured' 			=> 1,
        	'title' 			=> "High Mountain Trip",
        	'location' 			=> "East Alps",
        	'city' 				=> 1,
        	'website' 			=> "hello@mountaintrip.com",
        	'category' 			=> "Sport",
        	'rating' 			=> "4",
        	'reviews_number' 	=> "9",
        	'marker_image' 		=> "assets/img/items/13.jpg",
        	'gallery' 			=> 'assets/img/items/13.jpg,  assets/img/items/2.jpg, assets/img/items/12.jpg',
        	'description' 		=> "Duis sed consectetur sem. Nam vitae laoreet mi. Praesent vel quam massa. Nulla vitae nisi leo.",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);
        
        Map::create([
        	'latitude' 			=> 40.73203937,
        	'longitude' 		=> -73.8216877,
        	'featured' 			=> 1,
        	'title' 			=> "Hyundai i30",
        	'location' 			=> "580 Briarhill Lane",
        	'city' 				=> 1,
        	'phone' 			=> "325-990-8452",
        	'category' 			=> "Car Rental",
        	'marker_image' 		=> "assets/img/items/29.jpg",
        	'gallery' 			=> 'assets/img/items/29.jpg, assets/img/items/11.jpg, assets/img/items/12.jpg',
        	'tags' 				=> 'Diesel, First Owner, 4x4, Air Conditioning',
        	'url' 				=> "detail.html",
        	'description' 		=> "Vivamus vitae lacus accumsan, gravida orci sit amet, convallis erat. Sed at porttitor quam. Proin faucibus lacus et massa tempus, sed mattis justo elementum. Proin mauris felis, laoreet quis lacus non, mattis venenatis massa. ",
        	'opening_hours' 	=> '
        		08:00am - 11:00pm,
        		12:00am - 11:00pm,
        		03:00pm - 02:00am,
        		Closed
        	',
        ]);

         


    }
}
