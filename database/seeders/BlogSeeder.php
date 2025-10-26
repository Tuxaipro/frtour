<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Top 10 Places to Visit in India',
                'slug' => 'top-10-places-to-visit-in-india',
                'excerpt' => 'Discover the most incredible destinations India has to offer, from iconic monuments to stunning natural wonders.',
                'featured_image' => null,
                'content' => '<p>India is a land of diverse cultures, breathtaking landscapes, and rich history. From the snow-capped peaks of the Himalayas to the pristine beaches of the south, India offers a plethora of experiences for every traveler. Here are the top 10 places you must visit in India:</p>
                
                <h2>1. Taj Mahal, Agra</h2>
                <p>The iconic symbol of love, the Taj Mahal is a UNESCO World Heritage Site and one of the New Seven Wonders of the World. This magnificent white marble mausoleum was built by Emperor Shah Jahan in memory of his beloved wife Mumtaz Mahal.</p>
                
                <h2>2. Jaipur, Rajasthan</h2>
                <p>Known as the "Pink City," Jaipur is famous for its royal palaces, vibrant markets, and rich Rajasthani culture. Don\'t miss the Amber Fort, City Palace, and Hawa Mahal.</p>
                
                <h2>3. Kerala Backwaters</h2>
                <p>Experience the tranquil beauty of Kerala\'s backwaters on a houseboat cruise. Glide through palm-fringed waterways and witness the unique lifestyle of the locals.</p>
                
                <h2>4. Goa Beaches</h2>
                <p>Goa is renowned for its stunning beaches, vibrant nightlife, and Portuguese heritage. Whether you\'re looking for relaxation or adventure, Goa has something for everyone.</p>
                
                <h2>5. Varanasi, Uttar Pradesh</h2>
                <p>One of the oldest continuously inhabited cities in the world, Varanasi is a spiritual hub on the banks of the sacred River Ganges. Experience the mesmerizing Ganga Aarti ceremony at the ghats.</p>
                
                <h2>6. Leh-Ladakh</h2>
                <p>Known as "Little Tibet," Leh-Ladakh offers breathtaking landscapes, ancient monasteries, and thrilling adventure activities. The region is especially popular for trekking and mountain biking.</p>
                
                <h2>7. Hampi, Karnataka</h2>
                <p>A UNESCO World Heritage Site, Hampi is home to the magnificent ruins of the Vijayanagara Empire. Explore the ancient temples, royal enclosures, and stunning architecture.</p>
                
                <h2>8. Andaman and Nicobar Islands</h2>
                <p>These pristine islands in the Bay of Bengal offer crystal-clear waters, white sand beaches, and vibrant coral reefs. Perfect for snorkeling, scuba diving, and water sports.</p>
                
                <h2>9. Darjeeling, West Bengal</h2>
                <p>Famous for its tea gardens and the stunning view of the Kanchenjunga range, Darjeeling is a charming hill station that offers a pleasant respite from the heat.</p>
                
                <h2>10. Rishikesh and Haridwar, Uttarakhand</h2>
                <p>Known as the "Yoga Capital of the World," Rishikesh is the perfect place to rejuvenate your mind, body, and soul. Combine your visit with Haridwar to experience the spiritual side of India.</p>',
                'meta_description' => 'Discover the top 10 must-visit destinations in India, from the Taj Mahal to Kerala backwaters.',
                'is_published' => true,
            ],
            [
                'title' => 'Indian Cuisine: A Culinary Journey',
                'slug' => 'indian-cuisine-a-culinary-journey',
                'excerpt' => 'Explore the rich and diverse flavors of Indian cuisine, from regional specialties to street food culture.',
                'featured_image' => null,
                'content' => '<p>Indian cuisine is as diverse as the country itself, with each region offering its own unique flavors, ingredients, and cooking techniques. From the spicy curries of the south to the rich gravies of the north, Indian food is a true delight for the senses.</p>
                
                <h2>Regional Varieties</h2>
                <p>Indian cuisine can be broadly classified into several regional categories:</p>
                
                <h3>North Indian Cuisine</h3>
                <p>Characterized by its use of dairy products like ghee, paneer, and yogurt, North Indian cuisine features rich gravies and breads like naan and roti. Popular dishes include butter chicken, dal makhani, and biryani.</p>
                
                <h3>South Indian Cuisine</h3>
                <p>Known for its liberal use of spices, rice, and lentils, South Indian cuisine offers a variety of vegetarian dishes. Must-try items include dosa, idli, sambar, and rasam.</p>
                
                <h3>East Indian Cuisine</h3>
                <p>Famous for its sweets and use of mustard oil, East Indian cuisine, particularly Bengali cuisine, is known for its delicate flavors and emphasis on fish and rice.</p>
                
                <h3>West Indian Cuisine</h3>
                <p>From the spicy vindaloo of Goa to the vegetarian thalis of Gujarat, West Indian cuisine offers a wide range of flavors and textures.</p>
                
                <h2>Street Food Culture</h2>
                <p>Indian street food is an integral part of the culinary experience. From chaat in Delhi to vada pav in Mumbai, street food offers an authentic taste of local flavors at affordable prices.</p>
                
                <h2>Tea Culture</h2>
                <p>India is one of the largest tea producers in the world. Whether it\'s the strong Assam tea or the delicate Darjeeling tea, Indian tea culture is an essential part of daily life.</p>',
                'meta_description' => 'Explore the diverse flavors of Indian cuisine, from regional specialties to street food culture.',
                'is_published' => true,
            ],
            [
                'title' => 'Tips for Traveling in India',
                'slug' => 'tips-for-traveling-in-india',
                'excerpt' => 'Essential travel tips and advice for visiting India, covering everything from visas to cultural sensitivity.',
                'featured_image' => null,
                'content' => '<p>Traveling in India can be an incredibly rewarding experience, but it\'s also important to be prepared. Here are some essential tips to make your journey smooth and enjoyable:</p>
                
                <h2>Visa and Documentation</h2>
                <p>Most foreign nationals require a visa to enter India. Make sure to apply well in advance and carry multiple copies of your passport and visa.</p>
                
                <h2>Best Time to Visit</h2>
                <p>India\'s climate varies greatly by region. Generally, the best time to visit most parts of India is during the winter months (October to March) when the weather is pleasant.</p>
                
                <h2>Cultural Sensitivity</h2>
                <p>India is a culturally diverse country with various customs and traditions. Dress modestly, especially when visiting religious sites, and always ask for permission before taking photos of people.</p>
                
                <h2>Health and Safety</h2>
                <p>Drink bottled or purified water, and be cautious with street food until you\'re sure of its hygiene. Get necessary vaccinations before your trip and carry a basic first aid kit.</p>
                
                <h2>Transportation</h2>
                <p>India has a vast transportation network including trains, buses, and domestic flights. Trains are a popular and affordable way to travel long distances, but book tickets in advance.</p>
                
                <h2>Local Currency</h2>
                <p>The Indian Rupee (INR) is the local currency. While credit cards are accepted in major hotels and cities, it\'s advisable to carry cash for smaller establishments.</p>',
                'meta_description' => 'Essential travel tips for visiting India, covering visas, best times to visit, cultural sensitivity, and more.',
                'is_published' => true,
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::updateOrCreate(
                ['slug' => $blogData['slug']],
                $blogData
            );
        }
    }
}